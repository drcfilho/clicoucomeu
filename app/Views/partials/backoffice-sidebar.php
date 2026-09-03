<?php
$backofficeSection = (string) ($backofficeSection ?? 'painel');
$backofficeNav = [
    'painel' => ['label' => 'Painel', 'href' => '/painel'],
    'cozinha' => ['label' => 'Cozinha', 'href' => '/cozinha'],
    'admin' => ['label' => 'Superadmin', 'href' => '/admin'],
    'tenants' => ['label' => 'Tenants', 'href' => '/admin/tenants'],
];
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
