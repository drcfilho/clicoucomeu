<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'admin'; require __DIR__ . '/../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
        <section class="backoffice-topbar">
            <div class="backoffice-brand">
                <span class="backoffice-kicker">Superadmin</span>
                <h1 class="backoffice-title">Area administrativa</h1>
                <p class="backoffice-subtitle">Usuario autenticado: <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <div class="backoffice-actions">
                <a class="bo-link bo-link-primary" href="/admin/tenants">Ir para tenants</a>
                <a class="bo-link bo-link-secondary" href="/painel">Voltar ao painel</a>
            </div>
        </section>

        <section class="bo-cards-grid">
            <article class="bo-card">
                <h2 class="bo-card-title">Controle por tenant</h2>
                <p class="bo-card-text">Crie, edite, ative, bloqueie e acompanhe o status operacional de cada tenant em um fluxo adaptado ao mobile.</p>
            </article>
            <article class="bo-card">
                <h2 class="bo-card-title">Acesso administrativo</h2>
                <p class="bo-card-text">Cada tenant pode receber um usuario admin proprio com credencial separada e permissao limitada ao contexto dele.</p>
            </article>
            <article class="bo-card">
                <h2 class="bo-card-title">Planos e status</h2>
                <p class="bo-card-text">O backoffice agora organiza informacoes essenciais do tenant em cards e formularios empilhados para telas pequenas.</p>
            </article>
        </section>
            </div>
        </div>
    </main>
</body>
</html>
