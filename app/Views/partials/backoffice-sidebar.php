<?php
$sessionPerfil = $_SESSION['perfil'] ?? null;
$tenantSlug = $_SESSION['tenant_slug'] ?? '';
$tenantPrefix = !empty($tenantSlug) ? '/' . $tenantSlug : '';
$menuUrl = $tenantPrefix !== '' ? $tenantPrefix : '/';
$backofficeSection = (string) ($backofficeSection ?? 'painel');

$backofficeNav = [
    'painel' => ['label' => 'Painel', 'href' => $tenantPrefix . '/painel', 'target' => '_self'],
    'pedidos' => ['label' => 'Pedidos 🚨', 'href' => $tenantPrefix . '/painel/pedidos', 'target' => '_blank'],
    'categorias' => ['label' => 'Categorias', 'href' => $tenantPrefix . '/painel/categorias', 'target' => '_self'],
    'produtos' => ['label' => 'Produtos', 'href' => $tenantPrefix . '/painel/produtos', 'target' => '_self'],
    'adicionais' => ['label' => 'Adicionais', 'href' => $tenantPrefix . '/painel/adicionais', 'target' => '_self'],
    'bairros' => ['label' => 'Bairros / Taxas', 'href' => $tenantPrefix . '/painel/bairros', 'target' => '_self'],
    'pagamentos' => ['label' => 'Pagamentos', 'href' => $tenantPrefix . '/painel/pagamentos', 'target' => '_self'],
    'cupons' => ['label' => 'Cupons 🎟️', 'href' => $tenantPrefix . '/painel/cupons', 'target' => '_self'],
    'horarios' => ['label' => 'Horários', 'href' => $tenantPrefix . '/painel/horarios', 'target' => '_self'],
    'configuracoes' => ['label' => 'Configurações ⚙️', 'href' => $tenantPrefix . '/painel/configuracoes', 'target' => '_self'],
    'cozinha' => ['label' => 'Cozinha 🍳', 'href' => $tenantPrefix . '/cozinha', 'target' => '_blank'],
];

if ($sessionPerfil === 'superadmin') {
    $backofficeNav['admin'] = ['label' => 'Superadmin', 'href' => '/admin', 'target' => '_self'];
    $backofficeNav['tenants'] = ['label' => 'Tenants', 'href' => '/admin/tenants', 'target' => '_self'];
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
    
    <div style="padding: 12px; margin-bottom: 12px; background: rgba(255,255,255,0.05); border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);">
        <div style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 700; margin-bottom: 6px; letter-spacing: 0.5px;">Seu Cardápio</div>
        <div style="display: flex; gap: 6px;">
            <a href="<?= htmlspecialchars($menuUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" class="bo-btn bo-btn-primary" style="flex: 1; padding: 6px 10px; font-size: 12px; text-align: center; text-decoration: none;" title="Abrir cardápio em nova aba">
                🔗 Abrir Cardápio
            </a>
            <button type="button" onclick="copyMenuUrl('<?= htmlspecialchars($menuUrl, ENT_QUOTES, 'UTF-8') ?>', this)" class="bo-btn bo-btn-secondary" style="padding: 6px 10px; font-size: 12px;" title="Copiar link do cardápio">
                📋
            </button>
        </div>
    </div>

    <nav class="backoffice-sidebar-nav">
        <?php foreach ($backofficeNav as $key => $item): ?>
            <a class="backoffice-sidebar-link<?= $backofficeSection === $key ? ' is-active' : '' ?>" 
               href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') ?>" 
               target="<?= $item['target'] ?>"
               <?= $backofficeSection === $key ? ' aria-current="page"' : '' ?>>
                <?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?>
                <?php if ($item['target'] === '_blank'): ?>
                    <span style="font-size: 10px; opacity: 0.7; margin-left: auto;">↗</span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </nav>
</aside>

<script>
function copyMenuUrl(path, btn) {
    const fullUrl = window.location.origin + path;
    navigator.clipboard.writeText(fullUrl).then(() => {
        const originalText = btn.innerText;
        btn.innerText = '✓';
        btn.style.color = '#22c55e';
        setTimeout(() => {
            btn.innerText = originalText;
            btn.style.color = '';
        }, 2000);
    }).catch(err => {
        alert('Endereço: ' + fullUrl);
    });
}
</script>
