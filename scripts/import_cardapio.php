<?php

declare(strict_types=1);

use App\Config;
use App\Helpers\Database;

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

require BASE_PATH . '/app/Helpers/functions.php';
require BASE_PATH . '/app/Config/env.php';
require BASE_PATH . '/app/Config/database.php';
require BASE_PATH . '/app/Helpers/Database.php';

final class CardapioImporter
{
    private array $options;
    private array $configConstants = [];

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function run(): int
    {
        $baseUrl = rtrim((string) ($this->options['base-url'] ?? ''), '/');
        $tenantSlug = trim((string) ($this->options['tenant-slug'] ?? ''));
        $dryRun = array_key_exists('dry-run', $this->options);

        if ($baseUrl === '' || $tenantSlug === '') {
            fwrite(STDERR, "Uso: php scripts/import_cardapio.php --base-url=https://clicoucomeu.com.br/cardapios/piemonte --tenant-slug=piemonte [--dry-run]\n");
            return 1;
        }

        $this->configConstants = $this->loadConfigConstants($baseUrl);
        $dataset = $this->buildDataset($tenantSlug);

        $this->printSummary($dataset, $dryRun);

        if ($dryRun) {
            return 0;
        }

        Config\loadEnv(BASE_PATH . '/.env');
        $db = Database::connect(Config\databaseConfig());

        if ($db === null) {
            fwrite(STDERR, "Banco indisponivel. Crie .env a partir de .env.example e tente novamente.\n");
            return 2;
        }

        $db->beginTransaction();

        try {
            $tenantId = $this->upsertTenant($db, $dataset['tenant']);
            $this->ensureSafeToResetTenant($db, $tenantId);
            $this->resetTenantCatalog($db, $tenantId);
            $this->importConfiguracoes($db, $tenantId, $dataset['config_rows']);
            $categoryMap = $this->importCategorias($db, $tenantId, $dataset['categories']);
            $groupMap = [];
            $this->importProdutos($db, $tenantId, $dataset['products'], $categoryMap, $groupMap);
            $this->importFormasPagamento($db, $tenantId, $dataset['payment_methods']);
            $this->importBairros($db, $tenantId, $dataset['neighborhoods']);
            $this->importHorarios($db, $tenantId, $dataset['hours']);
            $this->importCupons($db, $tenantId, $dataset['coupons']);
            $db->commit();
        } catch (Throwable $exception) {
            $db->rollBack();
            fwrite(STDERR, "Falha na importacao: {$exception->getMessage()}\n");
            return 3;
        }

        fwrite(STDOUT, "Importacao concluida para tenant {$tenantSlug}.\n");
        return 0;
    }

    private function loadConfigConstants(string $baseUrl): array
    {
        $configJs = $this->readSource(
            (string) ($this->options['config-js'] ?? ''),
            $baseUrl . '/config.js'
        );

        preg_match_all("/const\\s+([A-Z0-9_]+)\\s*=\\s*'([^']*)';/", $configJs, $matches, PREG_SET_ORDER);

        $constants = [];
        foreach ($matches as $match) {
            $constants[$match[1]] = $match[2];
        }

        return $constants;
    }

    private function buildDataset(string $tenantSlug): array
    {
        $configRows = $this->parseCsvRows('config-csv', 'CONFIG_CSV_URL');
        $categoryRows = $this->parseCsvRows('categories-csv', 'CATEGORIES_CSV_URL');
        $menuRows = $this->parseCsvRows('menu-csv', 'MENU_CSV_URL');
        $hourRows = $this->parseCsvRows('hours-csv', 'HOURS_CSV_URL');
        $neighborhoodRows = $this->parseCsvRows('neighborhoods-csv', 'NEIGHBORHOODS_CSV_URL');
        $couponRows = $this->parseCsvRows('coupons-csv', 'COUPONS_CSV_URL');

        $configMap = [];
        foreach ($configRows as $row) {
            $section = trim((string) ($row['section'] ?? ''));
            $key = trim((string) ($row['key'] ?? ''));
            if ($section === '' || $key === '') {
                continue;
            }
            $configMap[$section][$key] = trim((string) ($row['value'] ?? ''));
        }

        $categories = [];
        foreach ($categoryRows as $row) {
            if (!$this->isActive((string) ($row['status'] ?? 'Ativo'))) {
                continue;
            }

            $slug = trim((string) ($row['nome_categoria'] ?? ''));
            if ($slug === '') {
                continue;
            }

            $categories[$slug] = [
                'slug' => $slug,
                'name' => $this->cleanLabel((string) ($row['titulo_exibicao'] ?? $slug)),
                'description' => trim((string) ($row['descricao'] ?? '')),
                'order' => (int) ($row['ordem'] ?? 0),
                'active' => 1,
            ];
        }

        $products = [];
        foreach ($menuRows as $row) {
            if (!$this->isActive((string) ($row['status'] ?? 'Ativo'))) {
                continue;
            }

            $sku = trim((string) ($row['SKU'] ?? $row['sku'] ?? ''));
            $name = trim((string) ($row['item'] ?? ''));
            $categoryList = $this->parseCategories((string) ($row['categoria'] ?? ''));

            if ($name === '' || $categoryList === []) {
                continue;
            }

            $basePrice = $this->parseMoney((string) ($row['preco'] ?? ''));
            $classification = trim((string) ($row['classificacao_adicional'] ?? ''));
            $parsedClassification = $this->parseClassification($classification, $basePrice);

            $products[] = [
                'sku' => $sku,
                'name' => $name,
                'slug' => $this->slugify(($sku !== '' ? $sku . '-' : '') . $name),
                'category_slug' => $categoryList[0],
                'extra_categories' => array_slice($categoryList, 1),
                'description' => trim((string) ($row['descricao'] ?? '')),
                'price' => $basePrice,
                'image' => trim((string) ($row['foto_url'] ?? '')),
                'active' => 1,
                'available' => 1,
                'highlight' => 0,
                'variations' => $parsedClassification['variations'],
                'addon_groups' => $parsedClassification['addon_groups'],
            ];
        }

        $paymentMethods = $this->parsePaymentMethods((string) ($configMap['checkout']['step3_formas_pag'] ?? ''));
        $neighborhoods = $this->parseNeighborhoods($neighborhoodRows);
        $hours = $this->parseHours($hourRows);
        $coupons = $this->parseCoupons($couponRows);
        $timezone = (string) ($this->configConstants['TIMEZONE'] ?? 'America/Sao_Paulo');

        return [
            'tenant' => [
                'slug' => $tenantSlug,
                'nome' => (string) ($configMap['identidade_visual']['nome_empresa'] ?? ucfirst($tenantSlug)),
                'razao_social' => null,
                'telefone' => (string) ($configMap['contato']['telefone'] ?? ''),
                'whatsapp' => (string) ($configMap['contato']['whatsapp'] ?? ''),
                'email' => (string) ($configMap['contato']['email'] ?? ''),
                'logo' => (string) ($configMap['identidade_visual']['logo_url'] ?? ''),
                'cor_primaria' => (string) ($configMap['cores']['cor_primaria'] ?? ''),
                'cor_secundaria' => (string) ($configMap['cores']['cor_secundaria'] ?? ''),
                'endereco' => (string) ($configMap['contato']['endereco_completo'] ?? ''),
                'cidade' => 'Cruz',
                'uf' => 'CE',
                'timezone' => $timezone,
                'status' => 'ativo',
                'plano' => 'mvp',
            ],
            'config_rows' => $configRows,
            'categories' => array_values($categories),
            'products' => $products,
            'payment_methods' => $paymentMethods,
            'neighborhoods' => $neighborhoods,
            'hours' => $hours,
            'coupons' => $coupons,
        ];
    }

    private function upsertTenant(PDO $db, array $tenant): int
    {
        $stmt = $db->prepare('SELECT id FROM tenants WHERE slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $tenant['slug']]);
        $existingId = $stmt->fetchColumn();

        if ($existingId) {
            $update = $db->prepare(
                'UPDATE tenants
                 SET nome = :nome, razao_social = :razao_social, telefone = :telefone, whatsapp = :whatsapp,
                     email = :email, logo = :logo, cor_primaria = :cor_primaria, cor_secundaria = :cor_secundaria,
                     endereco = :endereco, cidade = :cidade, uf = :uf, timezone = :timezone, status = :status, plano = :plano
                 WHERE id = :id'
            );
            $tenant['id'] = (int) $existingId;
            $update->execute($tenant);
            return (int) $existingId;
        }

        $insert = $db->prepare(
            'INSERT INTO tenants
             (nome, slug, razao_social, telefone, whatsapp, email, logo, cor_primaria, cor_secundaria, endereco, cidade, uf, timezone, status, plano)
             VALUES
             (:nome, :slug, :razao_social, :telefone, :whatsapp, :email, :logo, :cor_primaria, :cor_secundaria, :endereco, :cidade, :uf, :timezone, :status, :plano)'
        );
        $insert->execute($tenant);

        return (int) $db->lastInsertId();
    }

    private function ensureSafeToResetTenant(PDO $db, int $tenantId): void
    {
        $stmt = $db->prepare('SELECT COUNT(*) FROM pedidos WHERE tenant_id = :tenant_id');
        $stmt->execute(['tenant_id' => $tenantId]);
        $orderCount = (int) $stmt->fetchColumn();

        if ($orderCount > 0 && !array_key_exists('force-reset', $this->options)) {
            throw new RuntimeException('Tenant possui pedidos historicos. Use --force-reset apenas se quiser recriar o catalogo mesmo assim.');
        }
    }

    private function resetTenantCatalog(PDO $db, int $tenantId): void
    {
        $db->prepare('DELETE pia FROM pedido_item_adicionais pia INNER JOIN pedido_itens pi ON pi.id = pia.pedido_item_id WHERE pia.tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE pi FROM pedido_itens pi WHERE pi.tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE phs FROM pedido_historico_status phs WHERE phs.tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE FROM bairros WHERE tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE FROM horarios_funcionamento WHERE tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE FROM formas_pagamento WHERE tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE FROM cupons WHERE tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE FROM configuracoes WHERE tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);

        $productIdsStmt = $db->prepare('SELECT id FROM produtos WHERE tenant_id = :tenant_id');
        $productIdsStmt->execute(['tenant_id' => $tenantId]);
        $productIds = array_map('intval', $productIdsStmt->fetchAll(PDO::FETCH_COLUMN) ?: []);

        if ($productIds !== []) {
            $idList = implode(',', $productIds);
            $db->exec("DELETE FROM produto_grupos_adicionais WHERE produto_id IN ({$idList})");
            $db->exec("DELETE FROM produto_variacoes WHERE tenant_id = {$tenantId}");
            $db->exec("DELETE FROM produtos WHERE tenant_id = {$tenantId}");
        }

        $db->prepare('DELETE FROM adicionais WHERE tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE FROM grupos_adicionais WHERE tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
        $db->prepare('DELETE FROM categorias WHERE tenant_id = :tenant_id')->execute(['tenant_id' => $tenantId]);
    }

    private function importConfiguracoes(PDO $db, int $tenantId, array $configRows): void
    {
        $stmt = $db->prepare('INSERT INTO configuracoes (tenant_id, chave, valor) VALUES (:tenant_id, :chave, :valor)');

        foreach ($configRows as $row) {
            $section = trim((string) ($row['section'] ?? ''));
            $key = trim((string) ($row['key'] ?? ''));
            if ($section === '' || $key === '') {
                continue;
            }

            $stmt->execute([
                'tenant_id' => $tenantId,
                'chave' => $section . '.' . $key,
                'valor' => (string) ($row['value'] ?? ''),
            ]);
        }
    }

    private function importCategorias(PDO $db, int $tenantId, array $categories): array
    {
        $stmt = $db->prepare(
            'INSERT INTO categorias (tenant_id, nome, descricao, ordem, ativo)
             VALUES (:tenant_id, :nome, :descricao, :ordem, :ativo)'
        );

        $map = [];
        foreach ($categories as $category) {
            $stmt->execute([
                'tenant_id' => $tenantId,
                'nome' => $category['name'],
                'descricao' => $category['description'],
                'ordem' => $category['order'],
                'ativo' => $category['active'],
            ]);
            $map[$category['slug']] = (int) $db->lastInsertId();
        }

        return $map;
    }

    private function importProdutos(PDO $db, int $tenantId, array $products, array $categoryMap, array &$groupMap): void
    {
        $productStmt = $db->prepare(
            'INSERT INTO produtos
             (tenant_id, categoria_id, nome, slug, descricao, preco, imagem, destaque, disponivel, ativo, ordem)
             VALUES
             (:tenant_id, :categoria_id, :nome, :slug, :descricao, :preco, :imagem, :destaque, :disponivel, :ativo, :ordem)'
        );
        $variationStmt = $db->prepare(
            'INSERT INTO produto_variacoes (tenant_id, produto_id, nome, preco, ordem, ativo)
             VALUES (:tenant_id, :produto_id, :nome, :preco, :ordem, :ativo)'
        );
        $groupStmt = $db->prepare(
            'INSERT INTO grupos_adicionais (tenant_id, nome, minimo, maximo, obrigatorio, ordem, ativo)
             VALUES (:tenant_id, :nome, :minimo, :maximo, :obrigatorio, :ordem, :ativo)'
        );
        $addonStmt = $db->prepare(
            'INSERT INTO adicionais (tenant_id, grupo_id, nome, preco, ordem, ativo)
             VALUES (:tenant_id, :grupo_id, :nome, :preco, :ordem, :ativo)'
        );
        $linkStmt = $db->prepare(
            'INSERT INTO produto_grupos_adicionais (produto_id, grupo_id) VALUES (:produto_id, :grupo_id)'
        );

        foreach ($products as $index => $product) {
            $categoryId = $categoryMap[$product['category_slug']] ?? null;

            if ($categoryId === null) {
                throw new RuntimeException("Categoria nao encontrada para produto {$product['name']}: {$product['category_slug']}");
            }

            $productStmt->execute([
                'tenant_id' => $tenantId,
                'categoria_id' => $categoryId,
                'nome' => $product['name'],
                'slug' => $product['slug'],
                'descricao' => $this->buildProductDescription($product),
                'preco' => $product['price'],
                'imagem' => $product['image'] !== '' ? $product['image'] : null,
                'destaque' => $product['highlight'],
                'disponivel' => $product['available'],
                'ativo' => $product['active'],
                'ordem' => $index + 1,
            ]);

            $productId = (int) $db->lastInsertId();

            foreach ($product['variations'] as $variationIndex => $variation) {
                $variationStmt->execute([
                    'tenant_id' => $tenantId,
                    'produto_id' => $productId,
                    'nome' => $variation['name'],
                    'preco' => $variation['price'],
                    'ordem' => $variationIndex + 1,
                    'ativo' => 1,
                ]);
            }

            foreach ($product['addon_groups'] as $groupIndex => $group) {
                $signature = $group['signature'];

                if (!isset($groupMap[$signature])) {
                    $groupStmt->execute([
                        'tenant_id' => $tenantId,
                        'nome' => $group['name'],
                        'minimo' => $group['min'],
                        'maximo' => $group['max'],
                        'obrigatorio' => $group['required'] ? 1 : 0,
                        'ordem' => $groupIndex + 1,
                        'ativo' => 1,
                    ]);

                    $groupId = (int) $db->lastInsertId();

                    foreach ($group['options'] as $optionIndex => $option) {
                        $addonStmt->execute([
                            'tenant_id' => $tenantId,
                            'grupo_id' => $groupId,
                            'nome' => $option['name'],
                            'preco' => $option['price'],
                            'ordem' => $optionIndex + 1,
                            'ativo' => 1,
                        ]);
                    }

                    $groupMap[$signature] = $groupId;
                }

                $linkStmt->execute([
                    'produto_id' => $productId,
                    'grupo_id' => $groupMap[$signature],
                ]);
            }
        }
    }

    private function importFormasPagamento(PDO $db, int $tenantId, array $paymentMethods): void
    {
        $stmt = $db->prepare(
            'INSERT INTO formas_pagamento (tenant_id, nome, tipo, pedir_troco, ordem, ativo)
             VALUES (:tenant_id, :nome, :tipo, :pedir_troco, :ordem, :ativo)'
        );

        foreach ($paymentMethods as $index => $method) {
            $stmt->execute([
                'tenant_id' => $tenantId,
                'nome' => $method['name'],
                'tipo' => $method['type'],
                'pedir_troco' => $method['needs_change'] ? 1 : 0,
                'ordem' => $index + 1,
                'ativo' => 1,
            ]);
        }
    }

    private function importBairros(PDO $db, int $tenantId, array $neighborhoods): void
    {
        $stmt = $db->prepare(
            'INSERT INTO bairros (tenant_id, nome, taxa_entrega, ativo, ordem)
             VALUES (:tenant_id, :nome, :taxa_entrega, 1, :ordem)'
        );

        foreach ($neighborhoods as $index => $neighborhood) {
            $stmt->execute([
                'tenant_id' => $tenantId,
                'nome' => $neighborhood['name'],
                'taxa_entrega' => $neighborhood['fee'],
                'ordem' => $index + 1,
            ]);
        }
    }

    private function importHorarios(PDO $db, int $tenantId, array $hours): void
    {
        $stmt = $db->prepare(
            'INSERT INTO horarios_funcionamento (tenant_id, dia_semana, abertura, fechamento, ativo)
             VALUES (:tenant_id, :dia_semana, :abertura, :fechamento, 1)'
        );

        foreach ($hours as $hour) {
            $stmt->execute([
                'tenant_id' => $tenantId,
                'dia_semana' => $hour['weekday'],
                'abertura' => $hour['start'],
                'fechamento' => $hour['end'],
            ]);
        }
    }

    private function importCupons(PDO $db, int $tenantId, array $coupons): void
    {
        $couponStmt = $db->prepare(
            'INSERT INTO cupons
             (tenant_id, codigo, tipo, valor, data_inicio, data_fim, ativo)
             VALUES
             (:tenant_id, :codigo, :tipo, :valor, :data_inicio, :data_fim, 1)'
        );
        $metaStmt = $db->prepare('INSERT INTO configuracoes (tenant_id, chave, valor) VALUES (:tenant_id, :chave, :valor)');

        foreach ($coupons as $coupon) {
            $couponStmt->execute([
                'tenant_id' => $tenantId,
                'codigo' => $coupon['code'],
                'tipo' => $coupon['type'],
                'valor' => $coupon['value'],
                'data_inicio' => $coupon['start'],
                'data_fim' => $coupon['end'],
            ]);

            $metaStmt->execute([
                'tenant_id' => $tenantId,
                'chave' => 'coupon_meta.' . $coupon['code'],
                'valor' => json_encode($coupon['raw'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            ]);
        }
    }

    private function parsePaymentMethods(string $value): array
    {
        $methods = [];

        foreach (preg_split('/\s*,\s*/', $value, -1, PREG_SPLIT_NO_EMPTY) as $name) {
            $normalized = mb_strtolower($name, 'UTF-8');
            $type = 'outro';

            if (str_contains($normalized, 'pix')) {
                $type = 'pix';
            } elseif (str_contains($normalized, 'dinheiro')) {
                $type = 'dinheiro';
            } elseif (str_contains($normalized, 'credito')) {
                $type = 'credito';
            } elseif (str_contains($normalized, 'debito')) {
                $type = 'debito';
            }

            $methods[] = [
                'name' => trim($name),
                'type' => $type,
                'needs_change' => $type === 'dinheiro',
            ];
        }

        return $methods;
    }

    private function parseNeighborhoods(array $rows): array
    {
        $seen = [];
        $result = [];

        foreach ($rows as $row) {
            $name = trim((string) ($row['nome_bairro'] ?? $row['bairro'] ?? ''));
            if ($name === '') {
                continue;
            }

            $key = $this->normalizeText($name);
            if (isset($seen[$key])) {
                continue;
            }

            $seen[$key] = true;
            $result[] = [
                'name' => $name,
                'fee' => $this->parseMoney((string) ($row['valor_taxa'] ?? '0')),
            ];
        }

        return $result;
    }

    private function parseHours(array $rows): array
    {
        $weekdayMap = [
            'domingo' => 0,
            'segunda-feira' => 1,
            'terca-feira' => 2,
            'terça-feira' => 2,
            'quarta-feira' => 3,
            'quinta-feira' => 4,
            'sexta-feira' => 5,
            'sabado' => 6,
            'sábado' => 6,
        ];

        $result = [];

        foreach ($rows as $row) {
            $weekdayName = $this->normalizeText((string) ($row['Dia da Semana'] ?? ''));
            $weekday = $weekdayMap[$weekdayName] ?? null;

            if ($weekday === null) {
                continue;
            }

            foreach (['PerÃ­odo 1', 'PerÃ­odo 2', 'PerÃ­odo 3', 'Período 1', 'Período 2', 'Período 3'] as $field) {
                $period = trim((string) ($row[$field] ?? ''));

                if ($period === '' || !str_contains($period, '-')) {
                    continue;
                }

                [$start, $end] = array_map('trim', explode('-', $period, 2));
                $result[] = [
                    'weekday' => $weekday,
                    'start' => $start,
                    'end' => $end,
                ];
            }
        }

        return $result;
    }

    private function parseCoupons(array $rows): array
    {
        $result = [];

        foreach ($rows as $row) {
            $code = trim((string) ($row['codigo_cupom'] ?? $row['codigo'] ?? ''));
            if ($code === '') {
                continue;
            }

            $discountType = trim((string) ($row['tipo_desconto'] ?? ''));
            $discountValue = trim((string) ($row['valor_desconto'] ?? '0'));
            $type = 'valor';
            $value = $this->parseMoney($discountValue);

            if ($this->endsWithPercent($discountValue)) {
                $type = 'percentual';
                $value = (float) str_replace('%', '', str_replace(',', '.', $discountValue));
            } elseif ($this->normalizeText($discountType) === 'frete' && $discountValue === '100%') {
                $type = 'frete_gratis';
                $value = 0.0;
            }

            $result[] = [
                'code' => $code,
                'type' => $type,
                'value' => $value,
                'start' => $this->parseDate((string) ($row['data_inicio'] ?? '')),
                'end' => $this->parseDate((string) ($row['data_fim'] ?? '')),
                'raw' => $row,
            ];
        }

        return $result;
    }

    private function parseClassification(string $text, ?float $basePrice): array
    {
        if ($text === '') {
            return ['variations' => [], 'addon_groups' => []];
        }

        $lines = preg_split('/\R/u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $variationRows = [];
        $addonGroups = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            if (!preg_match('/^(#?)(?:(~)Var:\s*|Var:\s*)?([^:]+):(radio|checkbox):(.+?)(?:\s*\[(\d+)(?:-(\d+))?\])?$/u', $line, $match)) {
                continue;
            }

            $required = $match[1] === '#';
            $name = trim($match[3]);
            $type = trim($match[4]);
            $options = $this->parseOptions($match[5]);
            $min = isset($match[6]) && $match[6] !== '' ? (int) $match[6] : ($required ? 1 : 0);
            $max = isset($match[7]) && $match[7] !== '' ? (int) $match[7] : null;

            if ($max === null) {
                foreach ($options as $option) {
                    if (isset($option['max_from_option'])) {
                        $max = (int) $option['max_from_option'];
                        break;
                    }
                }
            }

            $cleanOptions = array_map(static fn (array $option): array => [
                'name' => $option['name'],
                'price' => $option['price'],
            ], $options);

            if ($this->isProductVariationGroup($name, $type, $cleanOptions)) {
                foreach ($cleanOptions as $option) {
                    $variationRows[] = [
                        'name' => $option['name'],
                        'price' => round(($basePrice ?? 0.0) + $option['price'], 2),
                    ];
                }
                continue;
            }

            $groupData = [
                'name' => $name,
                'required' => $required,
                'min' => $min,
                'max' => $max ?? ($type === 'radio' ? 1 : count($cleanOptions)),
                'options' => $cleanOptions,
            ];
            $groupData['signature'] = md5(json_encode($groupData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $addonGroups[] = $groupData;
        }

        return [
            'variations' => $variationRows,
            'addon_groups' => $addonGroups,
        ];
    }

    private function parseOptions(string $text): array
    {
        $result = [];

        foreach (explode('/', $text) as $optionText) {
            $optionText = trim($optionText);
            if ($optionText === '') {
                continue;
            }

            $maxFromOption = null;
            if (preg_match('/maxselect=(\d+):(.+)/u', $optionText, $optionMatch)) {
                $maxFromOption = (int) $optionMatch[1];
                $optionText = trim($optionMatch[2]);
            }

            $price = 0.0;
            if (preg_match('/([+-])(\d+(?:[,.]\d{2})?)$/u', $optionText, $priceMatch, PREG_OFFSET_CAPTURE)) {
                $sign = $priceMatch[1][0];
                $value = (float) str_replace(',', '.', $priceMatch[2][0]);
                $offset = $priceMatch[0][1];
                $optionText = trim(substr($optionText, 0, $offset));
                $price = $sign === '-' ? -$value : $value;
            }

            $result[] = [
                'name' => $optionText,
                'price' => $price,
                'max_from_option' => $maxFromOption,
            ];
        }

        return $result;
    }

    private function isProductVariationGroup(string $name, string $type, array $options): bool
    {
        if ($type !== 'radio' || count($options) < 2) {
            return false;
        }

        $normalizedName = $this->normalizeText($name);
        if (str_contains($normalizedName, 'tamanho') || str_contains($normalizedName, 'tam')) {
            return true;
        }

        $optionNames = array_map(fn (array $option): string => $this->normalizeText($option['name']), $options);
        $sizeWords = ['pequena', 'media', 'grande', 'familia', 'gigante', 'broto'];

        foreach ($optionNames as $optionName) {
            if (in_array($optionName, $sizeWords, true)) {
                return true;
            }
        }

        return false;
    }

    private function buildProductDescription(array $product): string
    {
        $description = $product['description'];

        if ($product['extra_categories'] !== []) {
            $description .= ($description !== '' ? "\n\n" : '') . 'Categorias adicionais no cardapio legado: ' . implode(', ', $product['extra_categories']);
        }

        return $description;
    }

    private function parseCategories(string $value): array
    {
        $parts = preg_split('/\s*[,;]\s*/', $value, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        return array_values(array_filter(array_map('trim', $parts)));
    }

    private function parseDate(string $value): ?string
    {
        $value = trim($value);
        if ($value === '') {
            return null;
        }

        $date = DateTimeImmutable::createFromFormat('d/m/Y', $value);
        if (!$date) {
            return null;
        }

        return $date->format('Y-m-d 00:00:00');
    }

    private function parseMoney(string $value): ?float
    {
        $normalized = trim($value);
        if ($normalized === '') {
            return null;
        }

        if (preg_match('/consult/i', $normalized)) {
            return null;
        }

        $normalized = str_replace(['R$', '.', ' '], '', $normalized);
        $normalized = str_replace(',', '.', $normalized);

        return is_numeric($normalized) ? round((float) $normalized, 2) : null;
    }

    private function parseCsvRows(string $optionKey, string $constantName): array
    {
        $localPath = (string) ($this->options[$optionKey] ?? '');
        $url = (string) ($this->configConstants[$constantName] ?? '');
        $csvText = $this->readSource($localPath, $url);

        $handle = fopen('php://temp', 'r+');
        if ($handle === false) {
            throw new RuntimeException('Nao foi possivel abrir stream temporario para CSV.');
        }

        fwrite($handle, $csvText);
        rewind($handle);

        $rows = [];
        $headers = fgetcsv($handle);

        if ($headers === false) {
            fclose($handle);
            return [];
        }

        $headers = array_map(fn ($header) => trim((string) $header), $headers);

        while (($data = fgetcsv($handle)) !== false) {
            if ($data === [null] || $data === []) {
                continue;
            }

            $row = [];
            foreach ($headers as $index => $header) {
                $row[$header] = isset($data[$index]) ? trim((string) $data[$index]) : '';
            }
            $rows[] = $row;
        }

        fclose($handle);

        return $rows;
    }

    private function readSource(string $localPath, string $url): string
    {
        if ($localPath !== '') {
            $content = @file_get_contents($localPath);
            if ($content === false) {
                throw new RuntimeException("Nao foi possivel ler arquivo local: {$localPath}");
            }
            return $content;
        }

        $content = @file_get_contents($url);
        if ($content === false) {
            throw new RuntimeException("Nao foi possivel baixar: {$url}");
        }

        return $content;
    }

    private function printSummary(array $dataset, bool $dryRun): void
    {
        $lines = [
            'Modo: ' . ($dryRun ? 'dry-run' : 'import'),
            'Tenant: ' . $dataset['tenant']['nome'] . ' (' . $dataset['tenant']['slug'] . ')',
            'Timezone: ' . $dataset['tenant']['timezone'],
            'Categorias ativas: ' . count($dataset['categories']),
            'Produtos ativos: ' . count($dataset['products']),
            'Formas de pagamento: ' . count($dataset['payment_methods']),
            'Bairros: ' . count($dataset['neighborhoods']),
            'Faixas de horario: ' . count($dataset['hours']),
            'Cupons: ' . count($dataset['coupons']),
        ];

        fwrite(STDOUT, implode("\n", $lines) . "\n");
    }

    private function isActive(string $status): bool
    {
        return $this->normalizeText($status) === 'ativo';
    }

    private function cleanLabel(string $value): string
    {
        return trim(preg_replace('/^[^\p{L}\p{N}]+/u', '', $value) ?? $value);
    }

    private function slugify(string $value): string
    {
        $value = $this->normalizeText($value);
        $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? $value;
        return trim($value, '-');
    }

    private function normalizeText(string $value): string
    {
        $value = trim(mb_strtolower($value, 'UTF-8'));
        $transliterated = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
        if ($transliterated !== false) {
            $value = $transliterated;
        }
        return preg_replace('/\s+/', ' ', $value) ?? $value;
    }

    private function endsWithPercent(string $value): bool
    {
        return str_ends_with(trim($value), '%');
    }
}

$options = getopt('', [
    'base-url:',
    'tenant-slug:',
    'config-js::',
    'menu-csv::',
    'categories-csv::',
    'config-csv::',
    'hours-csv::',
    'neighborhoods-csv::',
    'coupons-csv::',
    'dry-run',
    'force-reset',
]);

$importer = new CardapioImporter($options);
exit($importer->run());
