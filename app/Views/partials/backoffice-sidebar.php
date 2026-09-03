<?php
$sessionPerfil = $_SESSION['perfil'] ?? null;
$backofficeSection = (string) ($backofficeSection ?? 'painel');
$backofficeNav = [
    'painel' => ['label' => 'Painel', 'href' => '/painel'],
    'categorias' => ['label' => 'Categorias', 'href' => '/painel/categorias'],
    'produtos' => ['label' => 'Produtos', 'href' => '/painel/produtos'],
    'adicionais' => ['label' => 'Adicionais', 'href' => '/painel/adicionais'],
    'bairros' => ['label' => 'Bairros / Taxas', 'href' => '/painel/bairros'],
    'pagamentos' => ['label' => 'Pagamentos', 'href' => '/painel/pagamentos'],
    'cozinha' => ['label' => 'Cozinha', 'href' => '/cozinha'],
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
