<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\CouponRepository;

class CouponController
{
    private CouponRepository $couponRepo;
    private Session $session;

    public function __construct(private Container $container)
    {
        $this->couponRepo = $container->get(CouponRepository::class);
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $coupons = $this->couponRepo->findAllByTenantId($tenantId);

        $response->view('painel.cupons.index', [
            'coupons' => $coupons,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function store(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $data = $request->getParsedBody();

        $codigo = trim((string) ($data['codigo'] ?? ''));
        $tipo = trim((string) ($data['tipo'] ?? 'percentual'));
        $valorStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['valor'] ?? '0'));
        $valorStr = str_replace(',', '.', $valorStr);
        $valor = (float) $valorStr;

        $minimoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['valor_minimo'] ?? ''));
        $minimoStr = str_replace(',', '.', $minimoStr);
        $valorMinimo = $minimoStr !== '' ? (float) $minimoStr : null;

        if (empty($codigo)) {
            $this->session->setFlash('error', 'O código do cupom é obrigatório.');
            $response->redirect('/painel/cupons');
            return;
        }

        $this->couponRepo->create([
            'tenant_id' => $tenantId,
            'codigo' => $codigo,
            'tipo' => $tipo,
            'valor' => $valor,
            'valor_minimo' => $valorMinimo,
            'data_inicio' => !empty($data['data_inicio']) ? $data['data_inicio'] : null,
            'data_fim' => !empty($data['data_fim']) ? $data['data_fim'] : null,
            'limite_usos' => isset($data['limite_usos']) && $data['limite_usos'] !== '' ? (int) $data['limite_usos'] : null,
        ]);

        $this->session->setFlash('success', 'Cupom criado com sucesso!');
        $response->redirect('/painel/cupons');
    }

    public function update(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();

        $codigo = trim((string) ($data['codigo'] ?? ''));
        $tipo = trim((string) ($data['tipo'] ?? 'percentual'));
        $valorStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['valor'] ?? '0'));
        $valorStr = str_replace(',', '.', $valorStr);
        $valor = (float) $valorStr;

        $minimoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['valor_minimo'] ?? ''));
        $minimoStr = str_replace(',', '.', $minimoStr);
        $valorMinimo = $minimoStr !== '' ? (float) $minimoStr : null;
        $ativo = isset($data['ativo']) ? 1 : 0;

        if (empty($codigo)) {
            $this->session->setFlash('error', 'O código do cupom é obrigatório.');
            $response->redirect('/painel/cupons');
            return;
        }

        $this->couponRepo->update($id, $tenantId, [
            'codigo' => $codigo,
            'tipo' => $tipo,
            'valor' => $valor,
            'valor_minimo' => $valorMinimo,
            'data_inicio' => !empty($data['data_inicio']) ? $data['data_inicio'] : null,
            'data_fim' => !empty($data['data_fim']) ? $data['data_fim'] : null,
            'limite_usos' => isset($data['limite_usos']) && $data['limite_usos'] !== '' ? (int) $data['limite_usos'] : null,
            'ativo' => $ativo,
        ]);

        $this->session->setFlash('success', 'Cupom atualizado com sucesso!');
        $response->redirect('/painel/cupons');
    }

    public function toggle(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->couponRepo->toggleStatus($id, $tenantId)) {
            $this->session->setFlash('success', 'Status do cupom alterado!');
        } else {
            $this->session->setFlash('error', 'Falha ao alterar status.');
        }

        $response->redirect('/painel/cupons');
    }

    public function delete(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->couponRepo->delete($id, $tenantId)) {
            $this->session->setFlash('success', 'Cupom excluído!');
        } else {
            $this->session->setFlash('error', 'Falha ao excluir cupom.');
        }

        $response->redirect('/painel/cupons');
    }
}
