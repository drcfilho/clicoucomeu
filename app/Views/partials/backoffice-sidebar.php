<?php
$sessionPerfil = $_SESSION['perfil'] ?? null;
$tenantPrefix = !empty($_SESSION['tenant_slug']) ? '/' . $_SESSION['tenant_slug'] : '';
$backofficeSection = (string) ($backofficeSection ?? 'painel');
$backofficeNav = [
    'painel' => ['label' => 'Painel', 'href' => $tenantPrefix . '/painel'],
    'pedidos' => ['label' => 'Pedidos 🚨', 'href' => $tenantPrefix . '/painel/pedidos'],
    'categorias' => ['label' => 'Categorias', 'href' => $tenantPrefix . '/painel/categorias'],
    'produtos' => ['label' => 'Produtos', 'href' => $tenantPrefix . '/painel/produtos'],
    'adicionais' => ['label' => 'Adicionais', 'href' => $tenantPrefix . '/painel/adicionais'],
    'bairros' => ['label' => 'Bairros / Taxas', 'href' => $tenantPrefix . '/painel/bairros'],
    'pagamentos' => ['label' => 'Pagamentos', 'href' => $tenantPrefix . '/painel/pagamentos'],
    'cupons' => ['label' => 'Cupons 🎟️', 'href' => $tenantPrefix . '/painel/cupons'],
    'horarios' => ['label' => 'Horários', 'href' => $tenantPrefix . '/painel/horarios'],
    'configuracoes' => ['label' => 'Configurações ⚙️', 'href' => $tenantPrefix . '/painel/configuracoes'],
    'cozinha' => ['label' => 'Cozinha', 'href' => $tenantPrefix . '/cozinha'],
];

if ($sessionPerfil === 'superadmin') {
    $backofficeNav['admin'] = ['label' => 'Superadmin', 'href' => '/admin'];
    $backofficeNav['tenants'] = ['label' => 'Tenants', 'href' => '/admin/tenants'];
}
?>
<aside class="backoffice-sidebar" aria-label="Navegacao principal">
    <div class="backoffice-sidebar-brand">
        <span class="backoffice-sidebar-mark">CC</span>
        <div>
            <strong>Clicou Comeu</strong>
            <span>Backoffice</span>
        </div>
    </div>
    <nav class="backoffice-sidebar-nav">
        <?php foreach ($backofficeNav as $key => $item): ?>
            <a class="backoffice-sidebar-link<?= $backofficeSection === $key ? ' is-active' : '' ?>" href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') ?>"<?= $backofficeSection === $key ? ' aria-current="page"' : '' ?>>
                <?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?>
            </a>
        <?php endforeach; ?>
    </nav>
</aside>
