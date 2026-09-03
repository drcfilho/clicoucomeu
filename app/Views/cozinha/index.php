<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cozinha</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <section class="backoffice-topbar">
            <div class="backoffice-brand">
                <span class="backoffice-kicker">Cozinha</span>
                <h1 class="backoffice-title">Fila de preparo</h1>
                <p class="backoffice-subtitle">Base mobile-first para uma tela de alto contraste e foco na operacao da equipe.</p>
            </div>
            <div class="backoffice-actions">
                <a class="bo-link bo-link-secondary" href="/painel">Voltar ao painel</a>
            </div>
        </section>

        <section class="bo-cards-grid">
            <article class="bo-card">
                <h2 class="bo-card-title">Novos pedidos</h2>
                <p class="bo-card-text">Area reservada para os proximos pedidos que entrarem no polling da cozinha.</p>
            </article>
            <article class="bo-card">
                <h2 class="bo-card-title">Em preparo</h2>
                <p class="bo-card-text">Cards largos e empilhados no mobile para leitura rapida de observacoes e tempo decorrido.</p>
            </article>
            <article class="bo-card">
                <h2 class="bo-card-title">Prontos</h2>
                <p class="bo-card-text">Espaco preparado para marcacao de pronto e transicao de status sem depender de telas densas.</p>
            </article>
        </section>
    </main>
</body>
</html>
