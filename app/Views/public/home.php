<?php
$primary = $tenant['cor_primaria'] ?? '#b47e11';
$secondary = $tenant['cor_secundaria'] ?? '#935711';
$slogan = $settings['identidade_visual.slogan'] ?? 'Sabor, rapidez e praticidade no seu pedido';
$phone = $tenant['whatsapp'] ?? '';
$address = $tenant['endereco'] ?? '';
$currency = static fn ($value): string => $value !== null ? 'R$ ' . number_format((float) $value, 2, ',', '.') : 'Consulte';
$initials = static function (string $name): string {
    $words = preg_split('/\s+/', trim($name)) ?: [];
    $letters = '';
    foreach ($words as $word) {
        if ($word !== '') {
            $letters .= mb_substr($word, 0, 1, 'UTF-8');
        }
        if (mb_strlen($letters, 'UTF-8') >= 2) {
            break;
        }
    }
    return mb_strtoupper($letters !== '' ? $letters : 'CC', 'UTF-8');
};

$flatProducts = [];
foreach ($categories as $category) {
    foreach ($category['produtos'] as $product) {
        $flatProducts[] = $product;
    }
}
$checkoutConfig = [
    'neighborhoods' => $neighborhoods,
    'paymentMethods' => $paymentMethods,
    'tenantSlug' => $slug ?? '',
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($tenant['nome'] ?? $appName, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/app.css'), ENT_QUOTES, 'UTF-8') ?>">
    <style>
        :root {
            --cor-primaria: <?= htmlspecialchars((string) $primary, ENT_QUOTES, 'UTF-8') ?>;
            --cor-secundaria: <?= htmlspecialchars((string) $secondary, ENT_QUOTES, 'UTF-8') ?>;
            --cor-fundo: #f7f0e2;
            --cor-card: #ffffff;
            --cor-borda: #eadfcb;
            --cor-texto: #31261d;
            --cor-texto-secundario: #6e6258;
            --cor-chip: #f6efe7;
            --sombra-card: 0 10px 30px rgba(44, 29, 15, 0.08);
            --sombra-header: 0 6px 20px rgba(44, 29, 15, 0.06);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: system-ui, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.8), transparent 28%),
                linear-gradient(180deg, #fffdfa 0%, var(--cor-fundo) 100%);
            color: var(--cor-texto);
        }
        button, input, textarea { font: inherit; }
        .shell { min-height: 100vh; }
        .container { width: min(1024px, calc(100% - 24px)); margin: 0 auto; }
        .header { position: sticky; top: 0; z-index: 40; backdrop-filter: blur(10px); background: rgba(255,255,255,0.92); box-shadow: var(--sombra-header); border-bottom: 1px solid rgba(234, 223, 203, 0.9); }
        .header-inner { display: flex; align-items: center; justify-content: space-between; gap: 16px; min-height: 88px; padding: 16px 0; }
        .brand { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .brand-logo, .brand-fallback { width: 56px; height: 56px; border-radius: 14px; flex: 0 0 56px; object-fit: cover; box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08); border: 2px solid rgba(255,255,255,0.9); }
        .brand-fallback { display: grid; place-items: center; color: #fff; font-weight: 800; background: linear-gradient(135deg, var(--cor-primaria), var(--cor-secundaria)); }
        .brand-copy { min-width: 0; }
        .brand-title { margin: 0; font-size: clamp(1rem, 3vw, 1.65rem); line-height: 1.05; color: var(--cor-primaria); }
        .brand-slogan { margin: 6px 0 0; color: var(--cor-texto-secundario); font-size: .9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 56vw; }
        .status-box { padding: 10px 14px; border-radius: 14px; background: #fff7ed; border: 1px solid #fed7aa; text-align: right; flex-shrink: 0; }
        .status-label { color: var(--cor-secundaria); font-size: .82rem; font-weight: 700; }
        .status-sub { color: var(--cor-texto-secundario); font-size: .8rem; margin-top: 2px; }
        .category-nav-wrap { position: sticky; top: 88px; z-index: 35; background: rgba(255,255,255,0.94); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(234, 223, 203, 0.9); }
        .category-nav { display: flex; gap: 10px; overflow-x: auto; padding: 14px 0; scrollbar-width: none; }
        .category-nav::-webkit-scrollbar { display: none; }
        .chip { border: 1px solid #ddd1bd; background: var(--cor-chip); color: var(--cor-texto); border-radius: 999px; padding: 10px 14px; font-size: .92rem; font-weight: 600; text-decoration: none; white-space: nowrap; transition: .2s ease; }
        .chip:hover, .chip.is-active { color: #fff; border-color: var(--cor-primaria); background: linear-gradient(135deg, var(--cor-primaria), var(--cor-secundaria)); }
        .main { padding: 22px 0 120px; }
        .search-box { position: sticky; top: 146px; z-index: 30; padding: 10px 0 14px; background: linear-gradient(180deg, rgba(247,240,226,0.96), rgba(247,240,226,0.86)); backdrop-filter: blur(8px); }
        .search-shell { position: relative; }
        .search-input { width: 100%; border: 1px solid var(--cor-borda); border-radius: 18px; padding: 15px 52px 15px 16px; background: rgba(255,255,255,0.96); color: var(--cor-texto); outline: none; box-shadow: 0 8px 24px rgba(43, 28, 16, 0.04); }
        .search-input:focus { border-color: var(--cor-primaria); }
        .search-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: var(--cor-primaria); }
        .section { margin-bottom: 28px; scroll-margin-top: 190px; }
        .section-head { position: sticky; top: 202px; z-index: 20; display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 10px 0 12px; background: linear-gradient(180deg, rgba(247,240,226,0.98), rgba(247,240,226,0.92)); }
        .section-title { margin: 0; font-size: 1.25rem; font-weight: 800; }
        .section-desc { margin: 4px 0 0; color: var(--cor-texto-secundario); font-size: .92rem; }
        .share-mini { display: grid; place-items: center; width: 36px; height: 36px; border-radius: 999px; border: 1px solid var(--cor-borda); background: rgba(255,255,255,0.92); cursor: pointer; color: var(--cor-texto); }
        .menu-list { display: grid; gap: 12px; }
        .food-card { display: flex; gap: 14px; align-items: flex-start; background: var(--cor-card); border: 1px solid rgba(236, 228, 214, 1); border-radius: 18px; padding: 14px; box-shadow: var(--sombra-card); transition: transform .2s ease, box-shadow .2s ease; cursor: pointer; }
        .food-card:hover { transform: translateY(-2px); box-shadow: 0 14px 34px rgba(44, 29, 15, 0.12); }
        .food-media { width: 88px; flex: 0 0 88px; }
        .food-media img, .food-media-placeholder { width: 88px; height: 88px; border-radius: 16px; object-fit: cover; background: linear-gradient(135deg, #fff0d2, #f3ddc0); }
        .food-media-placeholder { display: grid; place-items: center; color: var(--cor-primaria); font-size: 1.5rem; }
        .food-body { min-width: 0; flex: 1; }
        .food-name { margin: 0; font-size: 1rem; font-weight: 750; }
        .food-desc { margin: 6px 0 0; color: var(--cor-texto-secundario); font-size: .92rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .food-foot { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-top: 12px; }
        .food-price { color: var(--cor-primaria); font-size: 1rem; font-weight: 800; }
        .food-cta { border: 0; border-radius: 12px; padding: 10px 14px; background: linear-gradient(135deg, var(--cor-primaria), var(--cor-secundaria)); color: #fff; font-weight: 700; cursor: pointer; }
        .fab-share { position: fixed; left: 16px; bottom: 20px; z-index: 45; display: grid; place-items: center; width: 52px; height: 52px; border-radius: 999px; border: 0; color: #fff; background: linear-gradient(135deg, var(--cor-primaria), var(--cor-secundaria)); box-shadow: 0 12px 24px rgba(0,0,0,.18); cursor: pointer; }
        .fab-cart { position: fixed; right: 16px; bottom: 20px; z-index: 45; display: none; align-items: center; gap: 12px; min-width: 168px; height: 58px; padding: 0 18px; border-radius: 999px; background: #22c55e; color: #fff; box-shadow: 0 12px 24px rgba(34,197,94,.28); cursor: pointer; border: 0; }
        .fab-cart small { display: block; font-size: .72rem; opacity: .92; }
        .fab-cart strong { display: block; font-size: 1rem; }
        .fab-cart-count { width: 30px; height: 30px; border-radius: 999px; display: grid; place-items: center; background: #fff; color: #16a34a; font-weight: 800; flex: 0 0 30px; }
        .empty { padding: 18px; border-radius: 16px; border: 1px dashed var(--cor-borda); color: var(--cor-texto-secundario); background: rgba(255,255,255,0.65); }
        .footer { padding: 28px 0 96px; text-align: center; color: var(--cor-texto-secundario); }
        .footer-card { background: rgba(255,255,255,0.72); border: 1px solid rgba(234, 223, 203, 0.95); border-radius: 24px; padding: 24px; box-shadow: var(--sombra-card); }
        .footer-title { margin: 0 0 8px; font-size: 1.2rem; color: var(--cor-texto); }
        .hidden-by-search { display: none !important; }
        .modal-overlay { position: fixed; inset: 0; z-index: 60; display: none; align-items: flex-start; justify-content: center; padding: 18px 12px; background: rgba(0, 0, 0, 0.55); backdrop-filter: blur(4px); }
        .modal-overlay.is-open { display: flex; }
        .modal-card { width: min(100%, 540px); max-height: calc(100vh - 36px); overflow: auto; background: #fff; border-radius: 24px; box-shadow: 0 24px 80px rgba(0,0,0,.28); position: relative; animation: modalUp .22s ease; }
        .modal-close { position: absolute; top: 12px; right: 12px; width: 40px; height: 40px; border-radius: 999px; border: 0; background: rgba(255,255,255,.94); box-shadow: 0 8px 16px rgba(0,0,0,.12); cursor: pointer; font-size: 20px; z-index: 5; }
        .modal-image { width: 100%; height: 250px; object-fit: cover; display: block; background: linear-gradient(135deg, #fff0d2, #f3ddc0); }
        .modal-body { padding: 18px 18px 24px; }
        .modal-title { margin: 0; font-size: 1.4rem; color: var(--cor-texto); }
        .modal-description { color: var(--cor-texto-secundario); margin: 8px 0 0; line-height: 1.5; }
        .modal-price { margin-top: 14px; color: var(--cor-primaria); font-size: 1.2rem; font-weight: 800; }
        .option-group { margin-top: 22px; padding-top: 18px; border-top: 1px solid #f0e5d7; }
        .option-head { display: flex; align-items: baseline; justify-content: space-between; gap: 12px; margin-bottom: 12px; }
        .option-title { margin: 0; font-size: 1rem; font-weight: 800; }
        .option-meta { font-size: .82rem; color: var(--cor-texto-secundario); }
        .option-list { display: grid; gap: 10px; }
        .option-item { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 12px 14px; border: 1px solid #eadfcb; border-radius: 16px; background: #fffdfa; }
        .option-item-left { display: flex; align-items: center; gap: 10px; min-width: 0; }
        .option-item label { display: flex; align-items: center; gap: 10px; cursor: pointer; min-width: 0; }
        .option-item-name { font-weight: 600; }
        .option-price { font-weight: 700; color: var(--cor-primaria); white-space: nowrap; }
        .notes-box { margin-top: 22px; }
        .notes-box textarea { width: 100%; min-height: 96px; resize: vertical; border: 1px solid #eadfcb; border-radius: 16px; padding: 14px; }
        .modal-footer { position: sticky; bottom: 0; display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 16px 18px; background: rgba(255,255,255,0.97); border-top: 1px solid #f0e5d7; }
        .qty { display: inline-flex; align-items: center; gap: 10px; background: #fff7ed; border-radius: 999px; padding: 8px 12px; }
        .qty button { width: 30px; height: 30px; border-radius: 999px; border: 0; background: #fff; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,.08); }
        .primary-btn { flex: 1; border: 0; border-radius: 16px; min-height: 52px; padding: 0 16px; background: linear-gradient(135deg, var(--cor-primaria), var(--cor-secundaria)); color: #fff; font-weight: 800; cursor: pointer; text-align: left; }
        .primary-btn small { display: block; opacity: .9; font-size: .74rem; }
        .primary-btn strong { display: block; font-size: 1rem; }
        .cart-modal-body { padding: 18px; }
        .cart-items { display: grid; gap: 12px; }
        .cart-item { border: 1px solid #eadfcb; border-radius: 16px; padding: 14px; background: #fffdfa; }
        .cart-item-head { display: flex; justify-content: space-between; gap: 12px; align-items: flex-start; }
        .cart-item-name { margin: 0; font-weight: 800; }
        .cart-item-price { color: var(--cor-primaria); font-weight: 800; white-space: nowrap; }
        .cart-item-meta { margin-top: 8px; color: var(--cor-texto-secundario); font-size: .9rem; line-height: 1.45; }
        .cart-summary { margin-top: 18px; padding-top: 16px; border-top: 1px solid #f0e5d7; display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .cart-summary-total { font-size: 1.1rem; font-weight: 800; color: var(--cor-primaria); }
        .secondary-btn { border: 1px solid var(--cor-borda); background: #fff; color: var(--cor-texto); border-radius: 14px; min-height: 46px; padding: 0 14px; cursor: pointer; font-weight: 700; }
        .checkout-fields { display: grid; gap: 14px; margin-top: 18px; }
        .checkout-fields label { display: grid; gap: 6px; color: var(--cor-texto); font-weight: 700; }
        .checkout-fields input,
        .checkout-fields select,
        .checkout-fields textarea { width: 100%; border: 1px solid #eadfcb; border-radius: 14px; padding: 12px 14px; background: #fff; color: var(--cor-texto); }
        .checkout-fields textarea { min-height: 90px; resize: vertical; }
        .checkout-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .checkout-result { margin-top: 18px; padding: 14px; border-radius: 16px; background: #ecfdf5; color: #166534; border: 1px solid #bbf7d0; display: none; }
        .checkout-error { margin-top: 14px; padding: 12px 14px; border-radius: 14px; background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; display: none; }
        @keyframes modalUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 720px) {
            .container { width: min(100%, calc(100% - 16px)); }
            .header-inner { min-height: 84px; }
            .status-box { padding: 8px 10px; }
            .brand-slogan { max-width: 42vw; font-size: .8rem; }
            .category-nav-wrap { top: 84px; }
            .search-box { top: 141px; }
            .section-head { top: 195px; }
            .food-card { padding: 12px; }
            .food-media, .food-media img, .food-media-placeholder { width: 78px; height: 78px; flex-basis: 78px; }
            .fab-cart { min-width: 152px; padding: 0 14px; }
            .modal-image { height: 220px; }
            .modal-footer { align-items: stretch; flex-direction: column; }
            .primary-btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
    <main class="shell">
        <?php if ($tenant === null): ?>
            <div class="container" style="padding: 40px 0;">
                <h1><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></h1>
                <p>Aplicacao base pronta. Acesse um tenant valido para ver o cardapio.</p>
            </div>
        <?php else: ?>
            <header class="header">
                <div class="container header-inner">
                    <div class="brand">
                        <?php if (!empty($tenant['logo'])): ?>
                            <img class="brand-logo" src="<?= htmlspecialchars((string) $tenant['logo'], ENT_QUOTES, 'UTF-8') ?>" alt="Logo">
                        <?php else: ?>
                            <div class="brand-fallback"><?= htmlspecialchars($initials((string) $tenant['nome']), ENT_QUOTES, 'UTF-8') ?></div>
                        <?php endif; ?>
                        <div class="brand-copy">
                            <h1 class="brand-title"><?= htmlspecialchars((string) $tenant['nome'], ENT_QUOTES, 'UTF-8') ?></h1>
                            <p class="brand-slogan"><?= htmlspecialchars((string) $slogan, ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
                    <?php 
                    $storeIsOpen = $status_loja['is_open'] ?? true;
                    $storeMessage = $status_loja['message'] ?? 'Aberto para pedidos';
                    ?>
                    <div class="status-box" style="<?= !$storeIsOpen ? 'background: #fef2f2; border-color: #fca5a5;' : '' ?>">
                        <div class="status-label" style="<?= !$storeIsOpen ? 'color: #dc2626;' : '' ?>">
                            <?= $storeIsOpen ? 'Aberto Agora' : 'Fechado' ?>
                        </div>
                        <div class="status-sub"><?= htmlspecialchars((string) $storeMessage, ENT_QUOTES, 'UTF-8') ?></div>
                    </div>
                </div>
            </header>

            <div class="category-nav-wrap">
                <div class="container">
                    <nav class="category-nav" id="category-nav">
                        <?php foreach ($categories as $index => $category): ?>
                            <?php $anchor = 'categoria-' . (int) $category['id']; ?>
                            <a class="chip<?= $index === 0 ? ' is-active' : '' ?>" href="#<?= htmlspecialchars($anchor, ENT_QUOTES, 'UTF-8') ?>" data-category-link>
                                <?= htmlspecialchars((string) $category['nome'], ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </div>

            <div class="container main">
                <div class="search-box">
                    <div class="search-shell">
                        <input class="search-input" id="menu-search" type="text" placeholder="Buscar no cardapio..." autocomplete="off">
                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <?php foreach ($categories as $index => $category): ?>
                    <?php $anchor = 'categoria-' . (int) $category['id']; ?>
                    <section class="section" id="<?= htmlspecialchars($anchor, ENT_QUOTES, 'UTF-8') ?>" data-category-section>
                        <div class="section-head">
                            <div>
                                <h2 class="section-title"><?= htmlspecialchars((string) $category['nome'], ENT_QUOTES, 'UTF-8') ?></h2>
                                <?php if (!empty($category['descricao'])): ?>
                                    <p class="section-desc"><?= htmlspecialchars((string) $category['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                                <?php endif; ?>
                            </div>
                            <button class="share-mini" type="button" data-share-category="<?= htmlspecialchars((string) $category['nome'], ENT_QUOTES, 'UTF-8') ?>" title="Compartilhar categoria">↗</button>
                        </div>

                        <?php if ($category['produtos'] === []): ?>
                            <div class="empty">Nenhum produto disponivel nesta categoria.</div>
                        <?php else: ?>
                            <div class="menu-list">
                                <?php foreach ($category['produtos'] as $product): ?>
                                    <article class="food-card" data-product-card data-product-id="<?= (int) $product['id'] ?>" data-searchable="<?= htmlspecialchars(mb_strtolower(($product['nome'] ?? '') . ' ' . ($product['descricao'] ?? ''), 'UTF-8'), ENT_QUOTES, 'UTF-8') ?>">
                                        <div class="food-media">
                                            <?php if (!empty($product['imagem'])): ?>
                                                <img src="<?= htmlspecialchars((string) $product['imagem'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars((string) $product['nome'], ENT_QUOTES, 'UTF-8') ?>">
                                            <?php else: ?>
                                                <div class="food-media-placeholder">🍕</div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="food-body">
                                            <h3 class="food-name"><?= htmlspecialchars((string) $product['nome'], ENT_QUOTES, 'UTF-8') ?></h3>
                                            <?php if (!empty($product['descricao'])): ?>
                                                <p class="food-desc"><?= nl2br(htmlspecialchars((string) $product['descricao'], ENT_QUOTES, 'UTF-8')) ?></p>
                                            <?php endif; ?>
                                            <div class="food-foot">
                                                <div class="food-price"><?= htmlspecialchars($currency($product['preco']), ENT_QUOTES, 'UTF-8') ?></div>
                                                <button class="food-cta" type="button" data-open-product="<?= (int) $product['id'] ?>">Ver opcoes</button>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>

                <footer class="footer">
                    <div class="footer-card">
                        <h3 class="footer-title"><?= htmlspecialchars((string) $tenant['nome'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <?php if ($address !== ''): ?><p><?= htmlspecialchars((string) $address, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
                        <?php if ($phone !== ''): ?><p>WhatsApp: <?= htmlspecialchars((string) $phone, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
                    </div>
                </footer>
            </div>

            <button class="fab-share" type="button" id="share-menu" title="Compartilhar cardapio">↗</button>
            <button class="fab-cart" type="button" id="open-cart">
                <div class="fab-cart-count" id="cart-count">0</div>
                <div><small>Ver carrinho</small><strong id="cart-total">R$ 0,00</strong></div>
            </button>

            <div class="modal-overlay" id="product-modal" aria-hidden="true">
                <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="product-modal-title">
                    <button class="modal-close" type="button" id="close-product-modal">×</button>
                    <img class="modal-image" id="modal-image" alt="">
                    <div class="modal-body">
                        <h2 class="modal-title" id="product-modal-title"></h2>
                        <p class="modal-description" id="modal-description"></p>
                        <div class="modal-price" id="modal-base-price"></div>
                        <div id="modal-options"></div>
                        <div class="notes-box">
                            <label for="modal-notes"><strong>Observacoes</strong></label>
                            <textarea id="modal-notes" placeholder="Ex: sem cebola, assar mais, cortar em 8..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="qty">
                            <button type="button" id="decrease-qty">-</button>
                            <strong id="modal-qty">1</strong>
                            <button type="button" id="increase-qty">+</button>
                        </div>
                        <button class="primary-btn" type="button" id="modal-submit">
                            <small>Total estimado</small>
                            <strong id="modal-total">R$ 0,00</strong>
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal-overlay" id="cart-modal" aria-hidden="true">
                <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="cart-modal-title">
                    <button class="modal-close" type="button" id="close-cart-modal">×</button>
                    <div class="cart-modal-body">
                        <h2 class="modal-title" id="cart-modal-title">Seu carrinho</h2>
                        <p class="modal-description">Resumo local do pedido para testar o fluxo.</p>
                        <div class="cart-items" id="cart-items"></div>
                        <div class="cart-summary">
                            <div>
                                <small>Total estimado</small>
                                <div class="cart-summary-total" id="cart-summary-total">R$ 0,00</div>
                            </div>
                            <div style="display:flex; gap:10px;">
                                <button class="secondary-btn" type="button" id="clear-cart">Limpar</button>
                                <button class="food-cta" type="button" id="go-checkout">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-overlay" id="checkout-modal" aria-hidden="true">
                <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="checkout-modal-title">
                    <button class="modal-close" type="button" id="close-checkout-modal">×</button>
                    <div class="cart-modal-body">
                        <h2 class="modal-title" id="checkout-modal-title">Finalizar pedido</h2>
                        <p class="modal-description">Os valores finais sao recalculados no servidor.</p>
                        <form class="checkout-fields" id="checkout-form">
                            <div class="checkout-grid">
                                <label>
                                    Nome
                                    <input type="text" id="checkout-name" required>
                                </label>
                                <label>
                                    WhatsApp
                                    <input type="text" id="checkout-whatsapp" required>
                                </label>
                            </div>
                            <div class="checkout-grid">
                                <label>
                                    Entrega
                                    <select id="checkout-type">
                                        <option value="retirada">Retirada</option>
                                        <option value="delivery">Delivery</option>
                                    </select>
                                </label>
                                <label>
                                    Pagamento
                                    <select id="checkout-payment" required></select>
                                </label>
                            </div>
                            <div id="change-field" style="display:none; margin-top: 10px;">
                                <label>
                                    Troco para quanto? (R$)
                                    <input type="text" id="checkout-change" placeholder="Ex: 50,00 ou deixe em branco se nao precisar">
                                </label>
                            </div>
                            <div id="delivery-fields" style="display:none;">
                                <div class="checkout-grid">
                                    <label>
                                        Bairro
                                        <select id="checkout-neighborhood"></select>
                                    </label>
                                    <label>
                                        Numero
                                        <input type="text" id="checkout-number">
                                    </label>
                                </div>
                                <label>
                                    Endereco
                                    <input type="text" id="checkout-address">
                                </label>
                                <div class="checkout-grid">
                                    <label>
                                        Complemento
                                        <input type="text" id="checkout-complement">
                                    </label>
                                    <label>
                                        Referencia
                                        <input type="text" id="checkout-reference">
                                    </label>
                                </div>
                            </div>
                            <div class="checkout-grid">
                                <label>
                                    Cupom de Desconto
                                    <input type="text" id="checkout-coupon" placeholder="Codigo do cupom (opcional)">
                                </label>
                            </div>
                            <label>
                                Observacoes gerais
                                <textarea id="checkout-notes" placeholder="Ex: tocar campainha, entregar na portaria..."></textarea>
                            </label>
                            <div class="checkout-error" id="checkout-error"></div>
                            <div class="checkout-result" id="checkout-result"></div>
                            <button class="primary-btn" type="submit" id="submit-checkout">
                                <small>Enviar pedido</small>
                                <strong id="submit-checkout-total">R$ 0,00</strong>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <script>
        (function () {
            const products = <?= json_encode($flatProducts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
            const checkoutConfig = <?= json_encode($checkoutConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
            const storageKey = 'clicoucomeu_cart_piemonte_v1';
            const productMap = new Map(products.map((product) => [String(product.id), product]));
            const searchInput = document.getElementById('menu-search');
            const cards = Array.from(document.querySelectorAll('[data-product-card]'));
            const sections = Array.from(document.querySelectorAll('[data-category-section]'));
            const links = Array.from(document.querySelectorAll('[data-category-link]'));
            const shareMenu = document.getElementById('share-menu');
            const shareCategoryButtons = Array.from(document.querySelectorAll('[data-share-category]'));
            const modal = document.getElementById('product-modal');
            const modalImage = document.getElementById('modal-image');
            const modalTitle = document.getElementById('product-modal-title');
            const modalDescription = document.getElementById('modal-description');
            const modalBasePrice = document.getElementById('modal-base-price');
            const modalOptions = document.getElementById('modal-options');
            const modalQty = document.getElementById('modal-qty');
            const modalTotal = document.getElementById('modal-total');
            const modalSubmit = document.getElementById('modal-submit');
            const closeModalButton = document.getElementById('close-product-modal');
            const decreaseQty = document.getElementById('decrease-qty');
            const increaseQty = document.getElementById('increase-qty');
            const modalNotes = document.getElementById('modal-notes');
            const openCartButton = document.getElementById('open-cart');
            const cartModal = document.getElementById('cart-modal');
            const closeCartModalButton = document.getElementById('close-cart-modal');
            const cartItems = document.getElementById('cart-items');
            const cartCount = document.getElementById('cart-count');
            const cartTotal = document.getElementById('cart-total');
            const cartSummaryTotal = document.getElementById('cart-summary-total');
            const clearCartButton = document.getElementById('clear-cart');
            const goCheckoutButton = document.getElementById('go-checkout');
            const checkoutModal = document.getElementById('checkout-modal');
            const closeCheckoutModalButton = document.getElementById('close-checkout-modal');
            const checkoutForm = document.getElementById('checkout-form');
            const checkoutType = document.getElementById('checkout-type');
            const checkoutPayment = document.getElementById('checkout-payment');
            const checkoutNeighborhood = document.getElementById('checkout-neighborhood');
            const checkoutName = document.getElementById('checkout-name');
            const checkoutWhatsapp = document.getElementById('checkout-whatsapp');
            const checkoutAddress = document.getElementById('checkout-address');
            const checkoutNumber = document.getElementById('checkout-number');
            const checkoutComplement = document.getElementById('checkout-complement');
            const checkoutReference = document.getElementById('checkout-reference');
            const checkoutNotes = document.getElementById('checkout-notes');
            const deliveryFields = document.getElementById('delivery-fields');
            const checkoutError = document.getElementById('checkout-error');
            const checkoutResult = document.getElementById('checkout-result');
            const submitCheckout = document.getElementById('submit-checkout');
            const submitCheckoutTotal = document.getElementById('submit-checkout-total');

            let currentProduct = null;
            let quantity = 1;
            let cart = [];

            const formatCurrency = (value) => {
                if (value === null || Number.isNaN(Number(value))) {
                    return 'Consulte';
                }
                return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(Number(value));
            };

            const saveCart = () => {
                localStorage.setItem(storageKey, JSON.stringify(cart));
            };

            const loadCart = () => {
                try {
                    const raw = localStorage.getItem(storageKey);
                    cart = raw ? JSON.parse(raw) : [];
                    if (!Array.isArray(cart)) {
                        cart = [];
                    }
                } catch (error) {
                    cart = [];
                }
            };

            const getSelectedVariationPrice = () => {
                const selected = modalOptions.querySelector('input[name="product_variation"]:checked');
                if (!selected) {
                    return null;
                }

                return Number(selected.dataset.price || 0);
            };

            const getBasePrice = (product) => {
                if (!product) {
                    return 0;
                }

                const selectedVariationPrice = getSelectedVariationPrice();
                if (selectedVariationPrice !== null) {
                    return selectedVariationPrice;
                }

                if (Array.isArray(product.variacoes) && product.variacoes.length > 0) {
                    return Number(product.variacoes[0].preco || 0);
                }

                return Number(product.preco || 0);
            };

            const getSelectedExtras = () => {
                if (!currentProduct) {
                    return 0;
                }

                return calculateAddonsTotal(getSelectedAddons());
            };

            const calculateAddonsTotal = (addons) => {
                let total = 0;
                const flavorPrices = [];

                addons.forEach((addon) => {
                    const isTwoFlavorGroup = Number(addon.groupMax || 0) === 2
                        && String(addon.groupName || '').toLowerCase().includes('sabor');
                    if (isTwoFlavorGroup) {
                        flavorPrices.push(Number(addon.price || 0));
                        return;
                    }
                    total += Number(addon.price || 0);
                });

                return total + (flavorPrices.length ? Math.max(...flavorPrices) : 0);
            };

            const updateModalTotal = () => {
                const base = getBasePrice(currentProduct);
                const total = (base + getSelectedExtras()) * quantity;
                modalQty.textContent = String(quantity);
                modalTotal.textContent = formatCurrency(total);
            };

            const getCartTotals = () => {
                return cart.reduce((acc, item) => {
                    acc.count += Number(item.quantity || 0);
                    acc.total += Number(item.total || 0);
                    return acc;
                }, { count: 0, total: 0 });
            };

            const renderCartFab = () => {
                const totals = getCartTotals();
                if (!openCartButton || !cartCount || !cartTotal) {
                    return;
                }

                cartCount.textContent = String(totals.count);
                cartTotal.textContent = formatCurrency(totals.total);
                openCartButton.style.display = totals.count > 0 ? 'flex' : 'none';
            };

            const renderCartModal = () => {
                if (!cartItems || !cartSummaryTotal) {
                    return;
                }

                if (cart.length === 0) {
                    cartItems.innerHTML = '<div class="empty">Seu carrinho esta vazio.</div>';
                    cartSummaryTotal.textContent = formatCurrency(0);
                    return;
                }

                cartItems.innerHTML = cart.map((item, index) => `
                    <article class="cart-item">
                        <div class="cart-item-head">
                            <div>
                                <h3 class="cart-item-name">${item.productName}</h3>
                            </div>
                            <div class="cart-item-price">${formatCurrency(item.total)}</div>
                        </div>
                        <div class="cart-item-meta">
                            ${item.variationName ? `Tamanho: ${item.variationName}<br>` : ''}
                            ${item.addons.length ? `Adicionais: ${item.addons.map((addon) => addon.groupName + ': ' + addon.name).join(', ')}<br>` : ''}
                            ${item.notes ? `Obs: ${item.notes}` : ''}
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 12px;">
                            <div class="qty">
                                <button type="button" data-decrease-cart-item="${index}">-</button>
                                <span>${item.quantity}</span>
                                <button type="button" data-increase-cart-item="${index}">+</button>
                            </div>
                            <button class="secondary-btn" type="button" data-remove-cart-item="${index}" style="color: #dc2626;">Remover</button>
                        </div>
                    </article>
                `).join('');

                cartSummaryTotal.textContent = formatCurrency(getCartTotals().total);
            };

            const renderCheckoutOptions = () => {
                if (checkoutPayment) {
                    checkoutPayment.innerHTML = (checkoutConfig.paymentMethods || []).map((method) => `
                        <option value="${method.id}">${method.nome}</option>
                    `).join('');
                }

                if (checkoutNeighborhood) {
                    checkoutNeighborhood.innerHTML = '<option value="">Selecione...</option>' + (checkoutConfig.neighborhoods || []).map((item) => `
                        <option value="${item.id}">${item.nome} - ${formatCurrency(item.taxa_entrega)}</option>
                    `).join('');
                }
            };

            const syncCheckoutVisibility = () => {
                if (!checkoutType || !deliveryFields) {
                    return;
                }
                const isDelivery = checkoutType.value === 'delivery';
                deliveryFields.style.display = isDelivery ? 'block' : 'none';
                if (checkoutNeighborhood) {
                    checkoutNeighborhood.required = isDelivery;
                }
                if (checkoutAddress) {
                    checkoutAddress.required = isDelivery;
                }

                const changeField = document.getElementById('change-field');
                if (changeField && checkoutPayment) {
                    const selectedMethodId = checkoutPayment.value;
                    const method = (checkoutConfig.paymentMethods || []).find((m) => String(m.id) === String(selectedMethodId));
                    const isMoney = method && (method.tipo === 'dinheiro' || method.pedir_troco);
                    changeField.style.display = isMoney ? 'block' : 'none';
                }
            };

            const openCheckoutModal = () => {
                if (!checkoutModal) {
                    return;
                }
                renderCheckoutOptions();
                syncCheckoutVisibility();
                checkoutError.style.display = 'none';
                checkoutResult.style.display = 'none';
                submitCheckoutTotal.textContent = formatCurrency(getCartTotals().total);
                checkoutModal.classList.add('is-open');
                checkoutModal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const closeCheckoutModal = () => {
                if (!checkoutModal) {
                    return;
                }
                checkoutModal.classList.remove('is-open');
                checkoutModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            const openCartModal = () => {
                if (!cartModal) {
                    return;
                }
                renderCartModal();
                cartModal.classList.add('is-open');
                cartModal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const closeCartModal = () => {
                if (!cartModal) {
                    return;
                }
                cartModal.classList.remove('is-open');
                cartModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            const getSelectedVariation = () => {
                const selected = modalOptions.querySelector('input[name="product_variation"]:checked');
                if (!selected || !currentProduct || !Array.isArray(currentProduct.variacoes)) {
                    return null;
                }

                return currentProduct.variacoes.find((variation) => String(variation.id) === selected.value) || null;
            };

            const getSelectedAddons = () => {
                if (!currentProduct || !Array.isArray(currentProduct.grupos_adicionais)) {
                    return [];
                }

                const addons = [];
                currentProduct.grupos_adicionais.forEach((group, groupIndex) => {
                    modalOptions.querySelectorAll(`input[name="addon_group_${groupIndex}"]:checked`).forEach((input) => {
                        const option = group.opcoes.find((item) => String(item.id) === input.value);
                        if (option) {
                            addons.push({
                                groupId: group.id,
                                groupName: group.nome,
                                groupMax: Number(group.maximo || 0),
                                id: option.id,
                                name: option.nome,
                                price: Number(option.preco || 0),
                            });
                        }
                    });
                });

                return addons;
            };

            const validateSelections = () => {
                if (!currentProduct) {
                    return false;
                }

                if (Array.isArray(currentProduct.variacoes) && currentProduct.variacoes.length > 0) {
                    const selectedVariation = getSelectedVariation();
                    if (!selectedVariation) {
                        return false;
                    }
                }

                if (Array.isArray(currentProduct.grupos_adicionais)) {
                    for (let index = 0; index < currentProduct.grupos_adicionais.length; index += 1) {
                        const group = currentProduct.grupos_adicionais[index];
                        const checked = modalOptions.querySelectorAll(`input[name="addon_group_${index}"]:checked`);
                        if (group.obrigatorio && checked.length < Math.max(1, Number(group.minimo || 0))) {
                            return false;
                        }
                    }
                }

                return true;
            };

            const addCurrentProductToCart = () => {
                if (!currentProduct || !validateSelections()) {
                    modalSubmit.querySelector('small').textContent = 'Selecione as opcoes obrigatorias';
                    return;
                }

                const variation = getSelectedVariation();
                const addons = getSelectedAddons();
                const basePrice = variation ? Number(variation.preco || 0) : Number(currentProduct.preco || 0);
                const addonsTotal = calculateAddonsTotal(addons);
                const lineTotal = (basePrice + addonsTotal) * quantity;
                const notes = (modalNotes.value || '').trim();

                cart.push({
                    productId: currentProduct.id,
                    productName: currentProduct.nome,
                    quantity,
                    variationId: variation ? variation.id : null,
                    variationName: variation ? variation.nome : null,
                    addons,
                    notes,
                    unitBasePrice: basePrice,
                    addonsTotal,
                    total: lineTotal,
                });

                saveCart();
                renderCartFab();
                renderCartModal();
                closeProductModal();
            };

            const openProductModal = (productId) => {
                const product = productMap.get(String(productId));
                if (!product || !modal) {
                    return;
                }

                currentProduct = product;
                quantity = 1;
                modalNotes.value = '';
                modalTitle.textContent = product.nome || '';
                modalDescription.textContent = product.descricao || '';
                modalBasePrice.textContent = Array.isArray(product.variacoes) && product.variacoes.length > 0
                    ? 'Escolha o tamanho'
                    : formatCurrency(product.preco);
                modalImage.src = product.imagem || '';
                modalImage.alt = product.nome || '';

                const sectionsHtml = [];

                if (Array.isArray(product.variacoes) && product.variacoes.length > 0) {
                    sectionsHtml.push(`
                        <section class="option-group">
                            <div class="option-head">
                                <h3 class="option-title">Tamanho</h3>
                                <span class="option-meta">Escolha 1 opcao</span>
                            </div>
                            <div class="option-list">
                                ${product.variacoes.map((variation, index) => `
                                    <div class="option-item">
                                        <label>
                                            <input type="radio" name="product_variation" value="${variation.id}" data-price="${Number(variation.preco || 0)}" ${index === 0 ? 'checked' : ''}>
                                            <span class="option-item-name">${variation.nome}</span>
                                        </label>
                                        <span class="option-price">${formatCurrency(variation.preco)}</span>
                                    </div>
                                `).join('')}
                            </div>
                        </section>
                    `);
                }

                if (Array.isArray(product.grupos_adicionais)) {
                    product.grupos_adicionais.forEach((group, groupIndex) => {
                        const inputType = Number(group.maximo || 0) === 1 ? 'radio' : 'checkbox';
                        const inputName = `addon_group_${groupIndex}`;
                        sectionsHtml.push(`
                            <section class="option-group">
                                <div class="option-head">
                                    <h3 class="option-title">${group.nome}</h3>
                                    <span class="option-meta">${group.obrigatorio ? 'Obrigatorio' : 'Opcional'}${group.maximo ? ' • max ' + group.maximo : ''}</span>
                                </div>
                                <div class="option-list">
                                    ${group.opcoes.map((option) => `
                                        <div class="option-item">
                                            <label>
                                                <input type="${inputType}" name="${inputName}" value="${option.id}" data-price="${Number(option.preco || 0)}">
                                                <span class="option-item-name">${option.nome}</span>
                                            </label>
                                            <span class="option-price">${option.preco > 0 ? '+' + formatCurrency(option.preco) : 'Gratis'}</span>
                                        </div>
                                    `).join('')}
                                </div>
                            </section>
                        `);
                    });
                }

                modalOptions.innerHTML = sectionsHtml.join('');
                modalOptions.querySelectorAll('input').forEach((input) => {
                    input.addEventListener('change', () => {
                        if (input.type === 'checkbox') {
                            const name = input.getAttribute('name');
                            const max = Number((currentProduct.grupos_adicionais || []).find((group, index) => `addon_group_${index}` === name)?.maximo || 0);
                            if (max > 0) {
                                const checked = modalOptions.querySelectorAll(`input[name="${name}"]:checked`);
                                if (checked.length > max) {
                                    input.checked = false;
                                }
                            }
                        }
                        updateModalTotal();
                    });
                });

                updateModalTotal();
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const closeProductModal = () => {
                if (!modal) {
                    return;
                }
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const query = this.value.trim().toLowerCase();
                    cards.forEach((card) => {
                        const haystack = (card.getAttribute('data-searchable') || '').toLowerCase();
                        card.classList.toggle('hidden-by-search', query !== '' && !haystack.includes(query));
                    });
                    sections.forEach((section) => {
                        const visible = section.querySelector('[data-product-card]:not(.hidden-by-search)');
                        section.classList.toggle('hidden-by-search', !visible);
                    });
                });
            }

            const sectionObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }
                    const id = entry.target.getAttribute('id');
                    links.forEach((link) => {
                        const active = link.getAttribute('href') === '#' + id;
                        link.classList.toggle('is-active', active);
                    });
                });
            }, { rootMargin: '-38% 0px -52% 0px', threshold: 0 });
            sections.forEach((section) => sectionObserver.observe(section));

            cards.forEach((card) => {
                card.addEventListener('click', (event) => {
                    const button = event.target.closest('[data-open-product]');
                    const productId = button ? button.getAttribute('data-open-product') : card.getAttribute('data-product-id');
                    openProductModal(productId);
                });
            });

            if (closeModalButton) {
                closeModalButton.addEventListener('click', closeProductModal);
            }
            if (modal) {
                modal.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        closeProductModal();
                    }
                });
            }
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeProductModal();
                }
            });
            if (decreaseQty) {
                decreaseQty.addEventListener('click', () => {
                    quantity = Math.max(1, quantity - 1);
                    updateModalTotal();
                });
            }
            if (increaseQty) {
                increaseQty.addEventListener('click', () => {
                    quantity += 1;
                    updateModalTotal();
                });
            }
            if (modalSubmit) {
                modalSubmit.addEventListener('click', addCurrentProductToCart);
            }

            if (openCartButton) {
                openCartButton.addEventListener('click', openCartModal);
            }

            if (closeCartModalButton) {
                closeCartModalButton.addEventListener('click', closeCartModal);
            }

            if (cartModal) {
                cartModal.addEventListener('click', (event) => {
                    if (event.target === cartModal) {
                        closeCartModal();
                    }
                });
            }

            if (cartItems) {
                cartItems.addEventListener('click', (event) => {
                    const removeBtn = event.target.closest('[data-remove-cart-item]');
                    const increaseBtn = event.target.closest('[data-increase-cart-item]');
                    const decreaseBtn = event.target.closest('[data-decrease-cart-item]');

                    if (removeBtn) {
                        const index = Number(removeBtn.getAttribute('data-remove-cart-item'));
                        if (!Number.isNaN(index)) {
                            cart.splice(index, 1);
                            saveCart();
                            renderCartFab();
                            renderCartModal();
                        }
                        return;
                    }

                    if (increaseBtn) {
                        const index = Number(increaseBtn.getAttribute('data-increase-cart-item'));
                        if (!Number.isNaN(index) && cart[index]) {
                            cart[index].quantity += 1;
                            const unitPrice = cart[index].unitBasePrice + cart[index].addonsTotal;
                            cart[index].total = unitPrice * cart[index].quantity;
                            saveCart();
                            renderCartFab();
                            renderCartModal();
                        }
                        return;
                    }

                    if (decreaseBtn) {
                        const index = Number(decreaseBtn.getAttribute('data-decrease-cart-item'));
                        if (!Number.isNaN(index) && cart[index]) {
                            if (cart[index].quantity > 1) {
                                cart[index].quantity -= 1;
                                const unitPrice = cart[index].unitBasePrice + cart[index].addonsTotal;
                                cart[index].total = unitPrice * cart[index].quantity;
                            } else {
                                cart.splice(index, 1);
                            }
                            saveCart();
                            renderCartFab();
                            renderCartModal();
                        }
                    }
                });
            }

            if (clearCartButton) {
                clearCartButton.addEventListener('click', () => {
                    cart = [];
                    saveCart();
                    renderCartFab();
                    renderCartModal();
                });
            }

            if (goCheckoutButton) {
                goCheckoutButton.addEventListener('click', () => {
                    closeCartModal();
                    openCheckoutModal();
                });
            }

            if (checkoutType) {
                checkoutType.addEventListener('change', syncCheckoutVisibility);
            }

            if (checkoutPayment) {
                checkoutPayment.addEventListener('change', syncCheckoutVisibility);
            }

            if (closeCheckoutModalButton) {
                closeCheckoutModalButton.addEventListener('click', closeCheckoutModal);
            }

            if (checkoutModal) {
                checkoutModal.addEventListener('click', (event) => {
                    if (event.target === checkoutModal) {
                        closeCheckoutModal();
                    }
                });
            }

            if (checkoutForm) {
                checkoutForm.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    checkoutError.style.display = 'none';
                    checkoutResult.style.display = 'none';

                    if (cart.length === 0) {
                        checkoutError.textContent = 'Carrinho vazio.';
                        checkoutError.style.display = 'block';
                        return;
                    }

                    const checkoutChange = document.getElementById('checkout-change');
                    const checkoutCoupon = document.getElementById('checkout-coupon');

                    const payload = {
                        customer: {
                            name: checkoutName.value.trim(),
                            whatsapp: checkoutWhatsapp.value.trim(),
                        },
                        fulfillment: {
                            type: checkoutType.value,
                            bairro_id: checkoutType.value === 'delivery' ? Number(checkoutNeighborhood.value || 0) : null,
                            address: checkoutAddress.value.trim(),
                            number: checkoutNumber.value.trim(),
                            complement: checkoutComplement.value.trim(),
                            reference: checkoutReference.value.trim(),
                        },
                        payment: {
                            payment_method_id: Number(checkoutPayment.value || 0),
                            change_for: checkoutChange ? checkoutChange.value.trim() : null,
                        },
                        coupon_code: checkoutCoupon ? checkoutCoupon.value.trim() : null,
                        items: cart.map((item) => ({
                            product_id: Number(item.productId),
                            variation_id: item.variationId ? Number(item.variationId) : null,
                            quantity: Number(item.quantity),
                            notes: item.notes || '',
                            addons: item.addons.map((addon) => Number(addon.id)),
                        })),
                        notes: checkoutNotes.value.trim(),
                    };

                    submitCheckout.disabled = true;
                    submitCheckout.querySelector('small').textContent = 'Enviando...';

                    try {
                        const response = await fetch(`/api/v1/public/${checkoutConfig.tenantSlug}/orders`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(payload)
                        });

                        const result = await response.json();

                        if (!response.ok || !result.success) {
                            throw new Error(result?.error?.message || 'Falha ao enviar pedido');
                        }

                        cart = [];
                        saveCart();
                        renderCartFab();
                        renderCartModal();

                        checkoutResult.innerHTML = `Pedido <strong>#${result.data.order_number}</strong> criado com sucesso.<br>Total: <strong>${formatCurrency(result.data.total)}</strong><br>Status: <strong>${result.data.status}</strong>`;
                        checkoutResult.style.display = 'block';
                        checkoutForm.reset();
                        syncCheckoutVisibility();
                        submitCheckoutTotal.textContent = formatCurrency(0);
                    } catch (error) {
                        checkoutError.textContent = error.message || 'Falha ao enviar pedido';
                        checkoutError.style.display = 'block';
                    } finally {
                        submitCheckout.disabled = false;
                        submitCheckout.querySelector('small').textContent = 'Enviar pedido';
                    }
                });
            }

            const shareText = <?= json_encode('Confira o cardapio de ' . ($tenant['nome'] ?? $appName), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
            if (shareMenu) {
                shareMenu.addEventListener('click', async () => {
                    if (navigator.share) {
                        try {
                            await navigator.share({ title: document.title, text: shareText, url: window.location.href });
                            return;
                        } catch (error) {
                        }
                    }
                    await navigator.clipboard.writeText(window.location.href);
                });
            }

            shareCategoryButtons.forEach((button) => {
                button.addEventListener('click', async () => {
                    const section = button.closest('[data-category-section]');
                    if (!section) {
                        return;
                    }
                    const url = window.location.origin + window.location.pathname + '#' + section.id;
                    if (navigator.share) {
                        try {
                            await navigator.share({ title: document.title, text: 'Confira a categoria ' + (button.getAttribute('data-share-category') || ''), url });
                            return;
                        } catch (error) {
                        }
                    }
                    await navigator.clipboard.writeText(url);
                });
            });

            loadCart();
            renderCartFab();
            renderCheckoutOptions();
            syncCheckoutVisibility();
        })();
    </script>
</body>
</html>
