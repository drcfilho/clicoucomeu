<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\ConfigurationRepository;
use App\Repositories\TenantRepository;

class SettingsController
{
    public function __construct(private Container $container)
    {
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) ($_SESSION['tenant_id'] ?? 0);
        
        /** @var TenantRepository $tenantRepo */
        $tenantRepo = $this->container->get(TenantRepository::class);
        /** @var ConfigurationRepository $configRepo */
        $configRepo = $this->container->get(ConfigurationRepository::class);

        $tenant = $tenantRepo->findById($tenantId);
        $configs = $configRepo->findByTenantId($tenantId);

        $response->view('painel.configuracoes.index', [
            'tenant' => $tenant,
            'configs' => $configs,
            'csrfToken' => $request->getAttribute('csrf_token'),
        ]);
    }

    public function save(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) ($_SESSION['tenant_id'] ?? 0);
        /** @var Session $session */
        $session = $this->container->get(Session::class);

        /** @var TenantRepository $tenantRepo */
        $tenantRepo = $this->container->get(TenantRepository::class);
        /** @var ConfigurationRepository $configRepo */
        $configRepo = $this->container->get(ConfigurationRepository::class);

        $tenant = $tenantRepo->findById($tenantId);
        if (!$tenant) {
            $session->setFlash('error', 'Tenant não encontrado');
            $response->redirect('/painel');
            return;
        }

        $post = $request->getParsedBody();

        // Atualizar dados principais do tenant
        $tenantData = [
            'nome' => trim((string) ($post['nome'] ?? $tenant['nome'])),
            'slug' => (string) $tenant['slug'],
            'whatsapp' => preg_replace('/\D+/', '', (string) ($post['whatsapp'] ?? '')),
            'cidade' => trim((string) ($post['cidade'] ?? '')),
            'uf' => strtoupper(trim((string) ($post['uf'] ?? ''))),
            'timezone' => trim((string) ($post['timezone'] ?? $tenant['timezone'])),
            'status' => (string) $tenant['status'],
            'plano' => (string) ($tenant['plano'] ?? ''),
        ];

        $tenantRepo->update($tenantId, $tenantData);

        // Upload da logo do estabelecimento se houver
        $files = $_FILES['logo'] ?? null;
        if (is_array($files) && ($files['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
            $tmp = (string) $files['tmp_name'];
            $name = (string) $files['name'];
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (in_array($ext, ['png', 'jpg', 'jpeg', 'webp', 'svg'], true)) {
                $dir = BASE_PATH . '/public/uploads/tenants';
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                $targetFile = $dir . '/logo_' . $tenantId . '_' . time() . '.' . $ext;
                if (move_uploaded_file($tmp, $targetFile)) {
                    $logoPath = '/uploads/tenants/' . basename($targetFile);
                    $configRepo->saveConfig($tenantId, 'logo_url', $logoPath);
                }
            }
        }

        // Salvar configurações chave-valor adicionais
        $configKeys = [
            'cor_primaria',
            'impressora_formato',
            'mensagem_loja_fechada',
            'endereco_completo',
            'taxa_entrega_padrao',
        ];

        foreach ($configKeys as $key) {
            if (isset($post[$key])) {
                $configRepo->saveConfig($tenantId, $key, trim((string) $post[$key]));
            }
        }

        $session->setFlash('success', 'Configurações atualizadas com sucesso!');
        $response->redirect('/painel/configuracoes');
    }
}
