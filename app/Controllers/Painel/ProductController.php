<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class ProductController
{
    private ProductRepository $productRepo;
    private CategoryRepository $categoryRepo;
    private Session $session;

    public function __construct(private Container $container)
    {
        $this->productRepo = $container->get(ProductRepository::class);
        $this->categoryRepo = $container->get(CategoryRepository::class);
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $queryParams = $request->getQueryParams();

        $categoryId = isset($queryParams['categoria_id']) ? (int) $queryParams['categoria_id'] : null;
        $search = isset($queryParams['q']) ? trim((string) $queryParams['q']) : null;

        $products = $this->productRepo->findAllByTenantId($tenantId, $categoryId, $search);
        $categories = $this->categoryRepo->findAllByTenantId($tenantId);

        $response->view('painel.produtos.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategoryId' => $categoryId,
            'searchQuery' => $search,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function store(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $categoriaId = (int) ($data['categoria_id'] ?? 0);
        $precoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['preco'] ?? '0'));
        $precoStr = str_replace(',', '.', $precoStr);
        $preco = (float) $precoStr;
        $descricao = trim((string) ($data['descricao'] ?? ''));
        $destaque = isset($data['destaque']) ? 1 : 0;
        $disponivel = isset($data['disponivel']) ? 1 : 0;

        if (empty($nome) || $categoriaId <= 0) {
            $this->session->setFlash('error', 'Nome e categoria são obrigatórios.');
            $response->redirect('/painel/produtos');
            return;
        }

        // Processar upload de imagem se enviado
        $imagemPath = $this->handleImageUpload($request);

        $this->productRepo->create([
            'tenant_id' => $tenantId,
            'categoria_id' => $categoriaId,
            'nome' => $nome,
            'descricao' => $descricao ?: null,
            'preco' => $preco,
            'imagem' => $imagemPath,
            'destaque' => $destaque,
            'disponivel' => $disponivel,
            'ativo' => 1,
        ]);

        $this->session->setFlash('success', 'Produto criado com sucesso!');
        $response->redirect('/painel/produtos');
    }

    public function update(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();

        $product = $this->productRepo->findById($id, $tenantId);
        if (!$product) {
            $this->session->setFlash('error', 'Produto não encontrado.');
            $response->redirect('/painel/produtos');
            return;
        }

        $nome = trim((string) ($data['nome'] ?? ''));
        $categoriaId = (int) ($data['categoria_id'] ?? 0);
        $precoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['preco'] ?? '0'));
        $precoStr = str_replace(',', '.', $precoStr);
        $preco = (float) $precoStr;
        $descricao = trim((string) ($data['descricao'] ?? ''));
        $destaque = isset($data['destaque']) ? 1 : 0;
        $disponivel = isset($data['disponivel']) ? 1 : 0;
        $ordem = (int) ($data['ordem'] ?? $product['ordem']);

        if (empty($nome) || $categoriaId <= 0) {
            $this->session->setFlash('error', 'Nome e categoria são obrigatórios.');
            $response->redirect('/painel/produtos');
            return;
        }

        $imagemPath = $this->handleImageUpload($request) ?? $product['imagem'];

        $this->productRepo->update($id, $tenantId, [
            'categoria_id' => $categoriaId,
            'nome' => $nome,
            'descricao' => $descricao ?: null,
            'preco' => $preco,
            'imagem' => $imagemPath,
            'destaque' => $destaque,
            'disponivel' => $disponivel,
            'ordem' => $ordem,
        ]);

        $this->session->setFlash('success', 'Produto atualizado com sucesso!');
        $response->redirect('/painel/produtos');
    }

    public function toggleAvailability(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->productRepo->toggleAvailability($id, $tenantId)) {
            $this->session->setFlash('success', 'Disponibilidade do produto alterada!');
        } else {
            $this->session->setFlash('error', 'Falha ao alterar disponibilidade do produto.');
        }

        $response->redirect('/painel/produtos');
    }

    public function duplicate(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        $newId = $this->productRepo->duplicate($id, $tenantId);
        if ($newId) {
            $this->session->setFlash('success', 'Produto duplicado com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao duplicar o produto.');
        }

        $response->redirect('/painel/produtos');
    }

    public function delete(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->productRepo->softDelete($id, $tenantId)) {
            $this->session->setFlash('success', 'Produto excluído com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao excluir o produto.');
        }

        $response->redirect('/painel/produtos');
    }

    /* Variações do Produto (ex: Broto, Média, Grande, 500ml, 1L) */
    public function variations(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $productId = (int) ($params['id'] ?? 0);

        $product = $this->productRepo->findById($productId, $tenantId);
        if (!$product) {
            $this->session->setFlash('error', 'Produto não encontrado.');
            $response->redirect('/painel/produtos');
            return;
        }

        $variations = $this->productRepo->findVariationsByProductId($productId, $tenantId);

        $response->view('painel.produtos.variacoes', [
            'product' => $product,
            'variations' => $variations,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function storeVariation(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $productId = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $precoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['preco'] ?? ''));
        $precoStr = str_replace(',', '.', $precoStr);
        $preco = $precoStr !== '' ? (float) $precoStr : null;

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome da variação é obrigatório.');
            $response->redirect("/painel/produtos/{$productId}/variacoes");
            return;
        }

        $this->productRepo->createVariation([
            'tenant_id' => $tenantId,
            'produto_id' => $productId,
            'nome' => $nome,
            'preco' => $preco,
            'ordem' => isset($data['ordem']) && $data['ordem'] !== '' ? (int) $data['ordem'] : null,
            'ativo' => 1,
        ]);

        $this->session->setFlash('success', 'Variação adicionada com sucesso!');
        $response->redirect("/painel/produtos/{$productId}/variacoes");
    }

    public function updateVariation(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $productId = (int) ($params['id'] ?? 0);
        $varId = (int) ($params['varId'] ?? 0);
        $data = $request->getParsedBody();

        $nome = trim((string) ($data['nome'] ?? ''));
        $precoStr = str_replace(['R$', ' ', '.'], ['', '', ''], (string) ($data['preco'] ?? ''));
        $precoStr = str_replace(',', '.', $precoStr);
        $preco = $precoStr !== '' ? (float) $precoStr : null;
        $ordem = (int) ($data['ordem'] ?? 0);

        if (empty($nome)) {
            $this->session->setFlash('error', 'O nome da variação é obrigatório.');
            $response->redirect("/painel/produtos/{$productId}/variacoes");
            return;
        }

        $this->productRepo->updateVariation($varId, $tenantId, [
            'nome' => $nome,
            'preco' => $preco,
            'ordem' => $ordem,
        ]);

        $this->session->setFlash('success', 'Variação atualizada com sucesso!');
        $response->redirect("/painel/produtos/{$productId}/variacoes");
    }

    public function deleteVariation(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $productId = (int) ($params['id'] ?? 0);
        $varId = (int) ($params['varId'] ?? 0);

        if ($this->productRepo->deleteVariation($varId, $tenantId)) {
            $this->session->setFlash('success', 'Variação excluída com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao excluir variação.');
        }

        $response->redirect("/painel/produtos/{$productId}/variacoes");
    }

    private function handleImageUpload(Request $request): ?string
    {
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $file = $_FILES['imagem'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        
        // Validação de tamanho (máximo 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            return null;
        }

        // Validação MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes, true)) {
            return null;
        }

        $extension = match ($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
            default => 'jpg'
        };

        $uploadDir = BASE_PATH . '/public/uploads/produtos';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = 'prod_' + uniqid() + '.' + $extension;
        $filename = 'prod_' . uniqid() . '.' . $extension;
        $targetPath = $uploadDir . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return '/uploads/produtos/' . $filename;
        }

        return null;
    }
}
