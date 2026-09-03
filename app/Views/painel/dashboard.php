<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <section class="backoffice-topbar">
            <div class="backoffice-brand">
                <span class="backoffice-kicker">Painel</span>
                <h1 class="backoffice-title">Visao geral</h1>
                <p class="backoffice-subtitle">Dashboard inicial em layout mobile-first para acompanhar a operacao do tenant.</p>
            </div>
            <div class="backoffice-actions">
                <a class="bo-link bo-link-secondary" href="/cozinha">Ir para cozinha</a>
                <a class="bo-link bo-link-primary" href="/admin">Superadmin</a>
            </div>
        </section>

        <section class="bo-stats-grid">
            <article class="bo-stat">
                <strong>Pedidos hoje</strong>
                <span><?= htmlspecialchars((string) ($metrics['orders_today'] ?? 0), ENT_QUOTES, 'UTF-8') ?></span>
            </article>
            <article class="bo-stat">
                <strong>Faturamento hoje</strong>
                <span>R$ <?= number_format((float) ($metrics['revenue_today'] ?? 0), 2, ',', '.') ?></span>
            </article>
            <article class="bo-stat">
                <strong>Ticket medio</strong>
                <span>R$ <?= number_format((float) ($metrics['average_ticket'] ?? 0), 2, ',', '.') ?></span>
            </article>
            <article class="bo-stat">
                <strong>Pedidos abertos</strong>
                <span><?= htmlspecialchars((string) ($metrics['open_orders'] ?? 0), ENT_QUOTES, 'UTF-8') ?></span>
            </article>
        </section>

        <section class="bo-panel" style="margin-top: 18px;">
            <h2 class="bo-section-title">Payload atual</h2>
            <p class="bo-section-text">Enquanto as proximas tasks do dashboard nao entram, esta area expõe os dados atuais em um bloco legivel no celular.</p>
            <pre class="bo-code"><?= htmlspecialchars(json_encode($metrics, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?></pre>
        </section>
    </main>
</body>
</html>
