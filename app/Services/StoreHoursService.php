<?php

declare(strict_types=1);

namespace App\Services;

use DateTime;
use DateTimeZone;
use PDO;

class StoreHoursService
{
    public function __construct(
        private ?PDO $db,
        private string $timezone = 'America/Sao_Paulo',
        private bool $bypassHours = false
    ) {
    }

    public function getWeeklySchedule(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT dia_semana, abertura, fechamento, ativo
             FROM horarios_funcionamento
             WHERE tenant_id = :tenant_id
             ORDER BY dia_semana ASC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);
        $rows = $stmt->fetchAll() ?: [];

        $indexed = [];
        foreach ($rows as $row) {
            $indexed[(int) $row['dia_semana']] = $row;
        }

        // Dias 0=Domingo, 1=Segunda, ..., 6=Sábado
        $daysName = [
            0 => 'Domingo',
            1 => 'Segunda-feira',
            2 => 'Terça-feira',
            3 => 'Quarta-feira',
            4 => 'Quinta-feira',
            5 => 'Sexta-feira',
            6 => 'Sábado',
        ];

        $schedule = [];
        for ($day = 0; $day <= 6; $day++) {
            $schedule[$day] = [
                'dia_semana' => $day,
                'nome_dia' => $daysName[$day],
                'abertura' => isset($indexed[$day]['abertura']) ? substr($indexed[$day]['abertura'], 0, 5) : '18:00',
                'fechamento' => isset($indexed[$day]['fechamento']) ? substr($indexed[$day]['fechamento'], 0, 5) : '23:00',
                'ativo' => isset($indexed[$day]['ativo']) ? (int) $indexed[$day]['ativo'] : 1,
            ];
        }

        return $schedule;
    }

    public function saveWeeklySchedule(int $tenantId, array $scheduleData): bool
    {
        if ($this->db === null) {
            return false;
        }

        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare(
                'INSERT INTO horarios_funcionamento (tenant_id, dia_semana, abertura, fechamento, ativo)
                 VALUES (:tenant_id, :dia_semana, :abertura, :fechamento, :ativo)
                 ON DUPLICATE KEY UPDATE abertura = VALUES(abertura), fechamento = VALUES(fechamento), ativo = VALUES(ativo)'
            );

            for ($day = 0; $day <= 6; $day++) {
                $dayData = $scheduleData[$day] ?? [];
                $ativo = isset($dayData['ativo']) ? 1 : 0;
                $abertura = !empty($dayData['abertura']) ? $dayData['abertura'] . ':00' : '18:00:00';
                $fechamento = !empty($dayData['fechamento']) ? $dayData['fechamento'] . ':00' : '23:00:00';

                $stmt->execute([
                    'tenant_id' => $tenantId,
                    'dia_semana' => $day,
                    'abertura' => $abertura,
                    'fechamento' => $fechamento,
                    'ativo' => $ativo,
                ]);
            }

            $this->db->commit();
            return true;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * Verifica se a loja esta aberta no momento atual
     */
    public function isOpen(int $tenantId): array
    {
        if ($this->bypassHours) {
            return [
                'is_open' => true,
                'message' => 'Loja Aberta (Modo Dev/Bypass)',
                'manual_override' => false,
            ];
        }

        if ($this->db === null) {
            return ['is_open' => true, 'message' => 'Loja Aberta'];
        }

        // Checa se ha fechamento manual/forçado na tabela configuracoes
        $stmtCfg = $this->db->prepare("SELECT chave, valor FROM configuracoes WHERE tenant_id = :tenant_id AND chave IN ('forcar_fechamento', 'fechado_mensagem')");
        $stmtCfg->execute(['tenant_id' => $tenantId]);
        $configs = $stmtCfg->fetchAll(PDO::FETCH_KEY_PAIR) ?: [];

        if (isset($configs['forcar_fechamento']) && $configs['forcar_fechamento'] === '1') {
            return [
                'is_open' => false,
                'message' => $configs['fechado_mensagem'] ?? 'Estação temporariamente fechada para novos pedidos.',
                'manual_override' => true,
            ];
        }

        $now = new DateTime('now', new DateTimeZone($this->timezone));
        $currentDay = (int) $now->format('w'); // 0 (Domingo) a 6 (Sábado)
        $currentTime = $now->format('H:i:s');

        $stmt = $this->db->prepare(
            'SELECT abertura, fechamento, ativo
             FROM horarios_funcionamento
             WHERE tenant_id = :tenant_id AND dia_semana = :dia_semana AND ativo = 1
             LIMIT 1'
        );
        $stmt->execute(['tenant_id' => $tenantId, 'dia_semana' => $currentDay]);
        $today = $stmt->fetch();

        if (!$today) {
            return [
                'is_open' => false,
                'message' => 'Fechado hoje.',
                'manual_override' => false,
            ];
        }

        $abertura = $today['abertura'];
        $fechamento = $today['fechamento'];

        // Se fechamento for menor que abertura (ex: abre 18:00 e fecha 02:00 da madrugada seguinte)
        if ($fechamento < $abertura) {
            $isOpen = ($currentTime >= $abertura || $currentTime <= $fechamento);
        } else {
            $isOpen = ($currentTime >= $abertura && $currentTime <= $fechamento);
        }

        return [
            'is_open' => $isOpen,
            'message' => $isOpen ? 'Loja Aberta' : sprintf('Fechado. Horário de funcionamento hoje: %s às %s', substr($abertura, 0, 5), substr($fechamento, 0, 5)),
            'manual_override' => false,
        ];
    }

    public function toggleManualClose(int $tenantId, bool $forceClose, ?string $message = null): void
    {
        if ($this->db === null) {
            return;
        }

        $stmt = $this->db->prepare(
            'INSERT INTO configuracoes (tenant_id, chave, valor)
             VALUES (:tenant_id, :chave, :valor)
             ON DUPLICATE KEY UPDATE valor = VALUES(valor)'
        );

        $stmt->execute([
            'tenant_id' => $tenantId,
            'chave' => 'forcar_fechamento',
            'valor' => $forceClose ? '1' : '0',
        ]);

        if ($message !== null) {
            $stmt->execute([
                'tenant_id' => $tenantId,
                'chave' => 'fechado_mensagem',
                'valor' => $message,
            ]);
        }
    }
}
