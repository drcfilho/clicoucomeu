<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\CategoryRepository;

class CategoryController
{
    private CategoryRepository $categoryRepo;
    private Session $session;

    public function __construct(private Container $container)
    {
        $this->categoryRepo = $container->get(CategoryRepository::class);
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $categories = $this->categoryRepo->findAllByTenantId($tenantId);

        $response->view('painel.categorias.index', [
            'categories' => $categories,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function store(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $descricao = trim((string) ($data['descricao'] ?? ''));
        $ordem = isset($data['ordem']) && $data['ordem'] !== '' ? (int) $data['ordem'] : null;

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome da categoria é obrigatório.');
            $response->redirect('/painel/categorias');
            return;
        }

        $this->categoryRepo->create([
            'tenant_id' => $tenantId,
            'nome' => $nome,
            'descricao' => $descricao ?: null,
            'ordem' => $ordem,
            'ativo' => 1,
        ]);

        $this->session->setFlash('success', 'Categoria criada com sucesso!');
        $response->redirect('/painel/categorias');
    }

    public function update(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();

        $category = $this->categoryRepo->findById($id, $tenantId);
        if (!$category) {
            $this->session->setFlash('error', 'Categoria não encontrada.');
            $response->redirect('/painel/categorias');
            return;
        }

        $nome = trim((string) ($data['nome'] ?? ''));
        $descricao = trim((string) ($data['descricao'] ?? ''));
        $ordem = (int) ($data['ordem'] ?? 0);
        $ativo = isset($data['ativo']) ? (int) $data['ativo'] : 1;

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome da categoria é obrigatório.');
            $response->redirect('/painel/categorias');
            return;
        }

        $this->categoryRepo->update($id, $tenantId, [
            'nome' => $nome,
            'descricao' => $descricao ?: null,
            'ordem' => $ordem,
            'ativo' => $ativo,
        ]);

        $this->session->setFlash('success', 'Categoria atualizada com sucesso!');
        $response->redirect('/painel/categorias');
    }

    public function toggle(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->categoryRepo->toggleStatus($id, $tenantId)) {
            $this->session->setFlash('success', 'Status da categoria alterado com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao alterar o status da categoria.');
        }

        $response->redirect('/painel/categorias');
    }

    public function delete(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->categoryRepo->delete($id, $tenantId)) {
            $this->session->setFlash('success', 'Categoria excluída com sucesso!');
        } else {
            $this->session->setFlash('error', 'Não foi possível excluir a categoria.');
        }

        $response->redirect('/painel/categorias');
    }
}
