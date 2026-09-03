<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\AddonRepository;
use App\Repositories\ProductRepository;

class AddonController
{
    private AddonRepository $addonRepo;
    private ProductRepository $productRepo;
    private Session $session;

    public function __construct(private Container $container)
    {
        $this->addonRepo = $container->get(AddonRepository::class);
        $this->productRepo = $container->get(ProductRepository::class);
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $groups = $this->addonRepo->findAllGroupsByTenantId($tenantId);
        $products = $this->productRepo->findAllByTenantId($tenantId);

        $response->view('painel.adicionais.index', [
            'groups' => $groups,
            'products' => $products,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function storeGroup(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $minimo = (int) ($data['minimo'] ?? 0);
        $maximo = (int) ($data['maximo'] ?? 1);
        $obrigatorio = isset($data['obrigatorio']) ? 1 : 0;
        $productIds = (array) ($data['produtos'] ?? []);

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome do grupo é obrigatório.');
            $response->redirect('/painel/adicionais');
            return;
        }

        $groupId = $this->addonRepo->createGroup([
            'tenant_id' => $tenantId,
            'nome' => $nome,
            'minimo' => $minimo,
            'maximo' => $maximo,
            'obrigatorio' => $obrigatorio,
            'ordem' => isset($data['ordem']) && $data['ordem'] !== '' ? (int) $data['ordem'] : null,
        ]);

        if ($groupId > 0 && !empty($productIds)) {
            $this->addonRepo->syncProductGroups($groupId, $productIds);
        }

        $this->session->setFlash('success', 'Grupo de adicionais criado com sucesso!');
        $response->redirect('/painel/adicionais');
    }

    public function updateGroup(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $minimo = (int) ($data['minimo'] ?? 0);
        $maximo = (int) ($data['maximo'] ?? 1);
        $obrigatorio = isset($data['obrigatorio']) ? 1 : 0;
        $ordem = (int) ($data['ordem'] ?? 0);
        $productIds = (array) ($data['produtos'] ?? []);

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome do grupo é obrigatório.');
            $response->redirect('/painel/adicionais');
            return;
        }

        $this->addonRepo->updateGroup($id, $tenantId, [
            'nome' => $nome,
            'minimo' => $minimo,
            'maximo' => $maximo,
            'obrigatorio' => $obrigatorio,
            'ordem' => $ordem,
        ]);

        $this->addonRepo->syncProductGroups($id, $productIds);

        $this->session->setFlash('success', 'Grupo atualizado com sucesso!');
        $response->redirect('/painel/adicionais');
    }

    public function deleteGroup(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->addonRepo->deleteGroup($id, $tenantId)) {
            $this->session->setFlash('success', 'Grupo excluído com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao excluir o grupo.');
        }

        $response->redirect('/painel/adicionais');
    }

    /* --- ITENS ADICIONAIS DO GRUPO --- */

    public function items(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $groupId = (int) ($params['id'] ?? 0);

        $group = $this->addonRepo->findGroupById($groupId, $tenantId);
        if (!$group) {
            $this->session->setFlash('error', 'Grupo de adicionais não encontrado.');
            $response->redirect('/painel/adicionais');
            return;
        }

        $items = $this->addonRepo->findAddonsByGroupId($groupId, $tenantId);

        $response->view('painel.adicionais.itens', [
            'group' => $group,
            'items' => $items,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function storeItem(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $groupId = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $precoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['preco'] ?? '0'));
        $precoStr = str_replace(',', '.', $precoStr);
        $preco = (float) $precoStr;

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome do adicional é obrigatório.');
            $response->redirect("/painel/adicionais/{$groupId}/itens");
            return;
        }

        $this->addonRepo->createAddon([
            'tenant_id' => $tenantId,
            'grupo_id' => $groupId,
            'nome' => $nome,
            'preco' => $preco,
            'ordem' => isset($data['ordem']) && $data['ordem'] !== '' ? (int) $data['ordem'] : null,
        ]);

        $this->session->setFlash('success', 'Adicional cadastrado com sucesso!');
        $response->redirect("/painel/adicionais/{$groupId}/itens");
    }

    public function updateItem(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $groupId = (int) ($params['id'] ?? 0);
        $itemId = (int) ($params['itemId'] ?? 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $precoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['preco'] ?? '0'));
        $precoStr = str_replace(',', '.', $precoStr);
        $preco = (float) $precoStr;
        $ordem = (int) ($data['ordem'] ?? 0);

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome do adicional é obrigatório.');
            $response->redirect("/painel/adicionais/{$groupId}/itens");
            return;
        }

        $this->addonRepo->updateAddon($itemId, $tenantId, [
            'nome' => $nome,
            'preco' => $preco,
            'ordem' => $ordem,
        ]);

        $this->session->setFlash('success', 'Adicional atualizado com sucesso!');
        $response->redirect("/painel/adicionais/{$groupId}/itens");
    }

    public function deleteItem(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $groupId = (int) ($params['id'] ?? 0);
        $itemId = (int) ($params['itemId'] ?? 0);

        if ($this->addonRepo->deleteAddon($itemId, $tenantId)) {
            $this->session->setFlash('success', 'Adicional excluído com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao excluir adicional.');
        }

        $response->redirect("/painel/adicionais/{$groupId}/itens");
    }
}
