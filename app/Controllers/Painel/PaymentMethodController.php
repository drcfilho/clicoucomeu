<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\PaymentMethodRepository;

class PaymentMethodController
{
    private PaymentMethodRepository $paymentRepo;
    private Session $session;

    public function __construct(private Container $container)
    {
        $this->paymentRepo = $container->get(PaymentMethodRepository::class);
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $methods = $this->paymentRepo->findAllByTenantId($tenantId);

        $response->view('painel.pagamentos.index', [
            'methods' => $methods,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function store(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $tipo = trim((string) ($data['tipo'] ?? 'dinheiro'));
        $pedirTroco = isset($data['pedir_troco']) ? 1 : 0;
        $dadosPix = trim((string) ($data['dados_pix'] ?? ''));

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome da forma de pagamento é obrigatório.');
            $response->redirect('/painel/pagamentos');
            return;
        }

        $this->paymentRepo->create([
            'tenant_id' => $tenantId,
            'nome' => $nome,
            'tipo' => $tipo,
            'pedir_troco' => $pedirTroco,
            'dados_pix' => $dadosPix ?: null,
            'ordem' => isset($data['ordem']) && $data['ordem'] !== '' ? (int) $data['ordem'] : null,
            'ativo' => 1,
        ]);

        $this->session->setFlash('success', 'Forma de pagamento cadastrada com sucesso!');
        $response->redirect('/painel/pagamentos');
    }

    public function update(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $tipo = trim((string) ($data['tipo'] ?? 'dinheiro'));
        $pedirTroco = isset($data['pedir_troco']) ? 1 : 0;
        $dadosPix = trim((string) ($data['dados_pix'] ?? ''));
        $ordem = (int) ($data['ordem'] ?? 0);
        $ativo = isset($data['ativo']) ? 1 : 0;

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome da forma de pagamento é obrigatório.');
            $response->redirect('/painel/pagamentos');
            return;
        }

        $this->paymentRepo->update($id, $tenantId, [
            'nome' => $nome,
            'tipo' => $tipo,
            'pedir_troco' => $pedirTroco,
            'dados_pix' => $dadosPix ?: null,
            'ordem' => $ordem,
            'ativo' => $ativo,
        ]);

        $this->session->setFlash('success', 'Forma de pagamento atualizada!');
        $response->redirect('/painel/pagamentos');
    }

    public function toggle(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->paymentRepo->toggleStatus($id, $tenantId)) {
            $this->session->setFlash('success', 'Status da forma de pagamento alterado!');
        } else {
            $this->session->setFlash('error', 'Falha ao alterar status.');
        }

        $response->redirect('/painel/pagamentos');
    }

    public function delete(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->paymentRepo->delete($id, $tenantId)) {
            $this->session->setFlash('success', 'Forma de pagamento excluída com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao excluir forma de pagamento.');
        }

        $response->redirect('/painel/pagamentos');
    }
}
