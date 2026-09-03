<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\NeighborhoodRepository;

class NeighborhoodController
{
    private NeighborhoodRepository $neighborhoodRepo;
    private Session $session;

    public function __construct(private Container $container)
    {
        $this->neighborhoodRepo = $container->get(NeighborhoodRepository::class);
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $neighborhoods = $this->neighborhoodRepo->findAllByTenantId($tenantId);

        $response->view('painel.bairros.index', [
            'neighborhoods' => $neighborhoods,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function store(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $taxaStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['taxa_entrega'] ?? '0'));
        $taxaStr = str_replace(',', '.', $taxaStr);
        $taxaEntrega = (float) $taxaStr;

        $minimoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['pedido_minimo'] ?? '0'));
        $minimoStr = str_replace(',', '.', $minimoStr);
        $pedidoMinimo = (float) $minimoStr;

        $tempo = isset($data['tempo_estimado_min']) && $data['tempo_estimado_min'] !== '' ? (int) $data['tempo_estimado_min'] : null;

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome do bairro é obrigatório.');
            $response->redirect('/painel/bairros');
            return;
        }

        $this->neighborhoodRepo->create([
            'tenant_id' => $tenantId,
            'nome' => $nome,
            'taxa_entrega' => $taxaEntrega,
            'pedido_minimo' => $pedidoMinimo,
            'tempo_estimado_min' => $tempo,
            'ordem' => isset($data['ordem']) && $data['ordem'] !== '' ? (int) $data['ordem'] : null,
            'ativo' => 1,
        ]);

        $this->session->setFlash('success', 'Bairro cadastrado com sucesso!');
        $response->redirect('/painel/bairros');
    }

    public function update(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $taxaStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['taxa_entrega'] ?? '0'));
        $taxaStr = str_replace(',', '.', $taxaStr);
        $taxaEntrega = (float) $taxaStr;

        $minimoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['pedido_minimo'] ?? '0'));
        $minimoStr = str_replace(',', '.', $minimoStr);
        $pedidoMinimo = (float) $minimoStr;

        $tempo = isset($data['tempo_estimado_min']) && $data['tempo_estimado_min'] !== '' ? (int) $data['tempo_estimado_min'] : null;
        $ordem = (int) ($data['ordem'] ?? 0);
        $ativo = isset($data['ativo']) ? 1 : 0;

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome do bairro é obrigatório.');
            $response->redirect('/painel/bairros');
            return;
        }

        $this->neighborhoodRepo->update($id, $tenantId, [
            'nome' => $nome,
            'taxa_entrega' => $taxaEntrega,
            'pedido_minimo' => $pedidoMinimo,
            'tempo_estimado_min' => $tempo,
            'ordem' => $ordem,
            'ativo' => $ativo,
        ]);

        $this->session->setFlash('success', 'Bairro atualizado com sucesso!');
        $response->redirect('/painel/bairros');
    }

    public function toggle(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->neighborhoodRepo->toggleStatus($id, $tenantId)) {
            $this->session->setFlash('success', 'Status do bairro alterado!');
        } else {
            $this->session->setFlash('error', 'Falha ao alterar status do bairro.');
        }

        $response->redirect('/painel/bairros');
    }

    public function delete(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->neighborhoodRepo->delete($id, $tenantId)) {
            $this->session->setFlash('success', 'Bairro excluído com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao excluir o bairro.');
        }

        $response->redirect('/painel/bairros');
    }
}
