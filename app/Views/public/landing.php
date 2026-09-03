<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root {
            --bg: #f4efe7;
            --paper: rgba(255, 252, 247, 0.82);
            --ink: #1f1b18;
            --muted: #6c6259;
            --line: rgba(79, 57, 31, 0.12);
            --accent: #b3471f;
            --accent-2: #df9d39;
            --accent-3: #2f6b52;
            --shadow: 0 24px 70px rgba(61, 39, 14, 0.12);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            font-family: Georgia, "Times New Roman", serif;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.92), transparent 24%),
                radial-gradient(circle at 80% 20%, rgba(223, 157, 57, 0.18), transparent 22%),
                linear-gradient(180deg, #fffaf4 0%, var(--bg) 100%);
        }

        a { color: inherit; text-decoration: none; }
        .shell { min-height: 100vh; overflow: hidden; }
        .container { width: min(1180px, calc(100% - 28px)); margin: 0 auto; }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(18px);
        }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-weight: 800;
            color: #fffaf4;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            box-shadow: 0 18px 34px rgba(179, 71, 31, 0.24);
        }
        .brand-copy strong { display: block; font-size: 1rem; letter-spacing: 0.02em; }
        .brand-copy span { display: block; color: var(--muted); font-size: 0.88rem; }
        .nav { display: flex; gap: 10px; flex-wrap: wrap; }
        .nav a, .cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 18px;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.64);
        }
        .nav .primary, .cta.primary {
            color: #fffaf4;
            border-color: transparent;
            background: linear-gradient(135deg, var(--accent), #8e2d15);
            box-shadow: 0 16px 30px rgba(179, 71, 31, 0.24);
        }
        .hero {
            padding: 42px 0 34px;
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            gap: 26px;
            align-items: stretch;
        }
        .hero-copy, .hero-card, .feature, .flow-card, .cta-band {
            background: var(--paper);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }
        .hero-copy {
            border-radius: 34px;
            padding: clamp(28px, 5vw, 52px);
            position: relative;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 36px;
            padding: 0 14px;
            border-radius: 999px;
            background: rgba(223, 157, 57, 0.16);
            color: #7f4f08;
            font-size: 0.86rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        .hero h1 {
            margin: 18px 0 16px;
            font-size: clamp(2.6rem, 6vw, 5.6rem);
            line-height: 0.96;
            font-weight: 700;
            letter-spacing: -0.04em;
        }
        .hero p {
            margin: 0;
            font-size: 1.08rem;
            line-height: 1.7;
            color: var(--muted);
            max-width: 56ch;
        }
        .hero-actions {
            margin-top: 28px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .hero-meta {
            margin-top: 28px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }
        .metric {
            border-radius: 22px;
            padding: 18px;
            background: rgba(255,255,255,0.7);
            border: 1px solid rgba(79, 57, 31, 0.08);
        }
        .metric strong { display: block; font-size: 1.5rem; }
        .metric span { display: block; color: var(--muted); margin-top: 4px; font-size: 0.94rem; }
        .hero-card {
            border-radius: 34px;
            padding: 24px;
            display: grid;
            gap: 18px;
            align-content: start;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.84), rgba(255,250,242,0.92)),
                radial-gradient(circle at top right, rgba(223,157,57,0.2), transparent 35%);
        }
        .device {
            position: relative;
            border-radius: 30px;
            padding: 14px;
            background: #1f1b18;
        }
        .device-screen {
            border-radius: 22px;
            overflow: hidden;
            background: linear-gradient(180deg, #fff9f1 0%, #f7eddd 100%);
            padding: 16px;
        }
        .device-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }
        .device-pill {
            min-height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            background: rgba(179, 71, 31, 0.12);
            color: var(--accent);
            font-size: 0.82rem;
            font-weight: 700;
        }
        .device-list { display: grid; gap: 10px; }
        .device-item {
            display: grid;
            grid-template-columns: 60px 1fr auto;
            gap: 12px;
            align-items: center;
            border-radius: 18px;
            padding: 10px;
            background: rgba(255,255,255,0.88);
            border: 1px solid rgba(79, 57, 31, 0.08);
        }
        .device-thumb {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #f2c063, #b3471f);
        }
        .device-item strong { display: block; font-size: 0.96rem; }
        .device-item span { display: block; color: var(--muted); font-size: 0.84rem; margin-top: 4px; }
        .device-item b { color: var(--accent); font-size: 0.95rem; }
        .feature-grid, .flow {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            padding: 6px 0 0;
        }
        .feature {
            border-radius: 26px;
            padding: 24px;
        }
        .feature small {
            display: inline-block;
            margin-bottom: 14px;
            color: var(--accent-3);
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .feature h2 {
            margin: 0 0 12px;
            font-size: 1.35rem;
            line-height: 1.1;
        }
        .feature p {
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }
        .section-title {
            margin: 26px 0 16px;
            font-size: clamp(1.8rem, 4vw, 3rem);
            letter-spacing: -0.03em;
        }
        .flow-card {
            border-radius: 28px;
            padding: 24px;
        }
        .flow-card strong {
            display: inline-grid;
            place-items: center;
            width: 42px;
            height: 42px;
            border-radius: 14px;
            margin-bottom: 14px;
            background: linear-gradient(135deg, rgba(179,71,31,0.14), rgba(223,157,57,0.22));
            color: var(--accent);
        }
        .flow-card h3 {
            margin: 0 0 10px;
            font-size: 1.14rem;
        }
        .flow-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }
        .cta-band {
            margin: 28px 0 44px;
            border-radius: 34px;
            padding: 28px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
        }
        .cta-band h2 {
            margin: 0 0 8px;
            font-size: clamp(1.6rem, 4vw, 2.8rem);
            letter-spacing: -0.03em;
        }
        .cta-band p {
            margin: 0;
            color: var(--muted);
            max-width: 54ch;
            line-height: 1.65;
        }
        .cta-stack { display: flex; gap: 12px; flex-wrap: wrap; }
        @media (max-width: 980px) {
            .hero, .feature-grid, .flow { grid-template-columns: 1fr; }
            .cta-band { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 720px) {
            .topbar { position: static; padding-top: 16px; }
            .hero { padding-top: 12px; }
            .hero-meta { grid-template-columns: 1fr; }
            .nav { width: 100%; }
            .nav a { flex: 1 1 auto; }
            .container { width: min(100%, calc(100% - 18px)); }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="container">
            <header class="topbar">
                <div class="brand">
                    <div class="brand-mark">CC</div>
                    <div class="brand-copy">
                        <strong><?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?></strong>
                        <span>Sistema para cardapio, pedido e operacao</span>
                    </div>
                </div>
                <nav class="nav">
                    <a href="#recursos">Recursos</a>
                    <a href="#fluxo">Fluxo</a>
                    <a href="/login">Entrar</a>
                    <a class="primary" href="/<?= htmlspecialchars((string) ($realTestTenant['slug'] ?? 'piemonte'), ENT_QUOTES, 'UTF-8') ?>">Ver cardapio</a>
                </nav>
            </header>

            <section class="hero">
                <div class="hero-copy">
                    <div class="eyebrow">Delivery, retirada e gestao</div>
                    <h1>Seu restaurante vendendo online com uma operacao mais simples.</h1>
                    <p>
                        O <?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?> organiza cardapio, checkout,
                        pedidos e acompanhamento em um fluxo direto. O cliente pede no celular e a equipe recebe tudo pronto
                        para produzir e entregar.
                    </p>
                    <div class="hero-actions">
                        <a class="cta primary" href="/<?= htmlspecialchars((string) ($realTestTenant['slug'] ?? 'piemonte'), ENT_QUOTES, 'UTF-8') ?>">Abrir cardapio real</a>
                        <a class="cta" href="/admin">Area administrativa</a>
                        <a class="cta" href="/login">Login do sistema</a>
                    </div>
                    <div class="hero-meta">
                        <div class="metric">
                            <strong>Cardapio vivo</strong>
                            <span>Categorias, variacoes e adicionais no mesmo fluxo.</span>
                        </div>
                        <div class="metric">
                            <strong>Pedido rastreavel</strong>
                            <span>Checkout com token publico e pagina de acompanhamento.</span>
                        </div>
                        <div class="metric">
                            <strong>Multi-tenant</strong>
                            <span>Cada operacao isolada por slug, tenant e configuracao.</span>
                        </div>
                    </div>
                </div>

                <aside class="hero-card">
                    <div>
                        <div class="eyebrow">Tenant real de testes</div>
                        <h2 style="margin:16px 0 10px; font-size:2rem; line-height:1.02;">
                            <?= htmlspecialchars((string) ($realTestTenant['name'] ?? 'Tenant real'), ENT_QUOTES, 'UTF-8') ?>
                        </h2>
                        <p style="margin:0; color:var(--muted); line-height:1.65;">
                            A Piemonte nao e demo. Ela e um tenant real que sera usado nos testes operacionais e de cardapio.
                            O cardapio demo do sistema sera criado depois, em separado.
                        </p>
                    </div>
                    <div class="device">
                        <div class="device-screen">
                            <div class="device-bar">
                                <strong>Cardapio</strong>
                                <span class="device-pill">Aberto para pedidos</span>
                            </div>
                            <div class="device-list">
                                <div class="device-item">
                                    <div class="device-thumb"></div>
                                    <div>
                                        <strong>Pizza grande</strong>
                                        <span>Borda, adicionais e observacao</span>
                                    </div>
                                    <b>R$ 59,90</b>
                                </div>
                                <div class="device-item">
                                    <div class="device-thumb" style="background:linear-gradient(135deg,#f8dfa5,#2f6b52);"></div>
                                    <div>
                                        <strong>Combo delivery</strong>
                                        <span>Checkout com bairro e pagamento</span>
                                    </div>
                                    <b>R$ 74,90</b>
                                </div>
                                <div class="device-item">
                                    <div class="device-thumb" style="background:linear-gradient(135deg,#ffd3c1,#a13b2f);"></div>
                                    <div>
                                        <strong>Status do pedido</strong>
                                        <span>Pagina publica com token randomizado</span>
                                    </div>
                                    <b>Ao vivo</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </section>

            <h2 class="section-title" id="recursos">Recursos centrais</h2>
            <section class="feature-grid">
                <article class="feature">
                    <small>Menu</small>
                    <h2>Cardapio com estrutura comercial real</h2>
                    <p>Produtos, categorias, tamanhos e grupos adicionais montados para vender sem depender de atendimento manual no WhatsApp.</p>
                </article>
                <article class="feature">
                    <small>Checkout</small>
                    <h2>Pedido fechado com validacao no backend</h2>
                    <p>O frontend calcula para UX, mas o backend recalcula subtotal, taxa e disponibilidade antes de criar o pedido.</p>
                </article>
                <article class="feature">
                    <small>Operacao</small>
                    <h2>Painel, cozinha e acompanhamento do cliente</h2>
                    <p>As areas internas ja tem base de autenticacao, permissao por perfil e entrada dedicada para a camada administrativa.</p>
                </article>
            </section>

            <h2 class="section-title" id="fluxo">Como o sistema se organiza</h2>
            <section class="flow">
                <article class="flow-card">
                    <strong>1</strong>
                    <h3>Publicacao por slug</h3>
                    <p>Cada tenant responde em uma rota publica propria, como <code>/piemonte</code>, com identidade, menu e configuracoes isoladas.</p>
                </article>
                <article class="flow-card">
                    <strong>2</strong>
                    <h3>Pedido com persistencia</h3>
                    <p>O cliente monta o carrinho, envia o checkout e o sistema grava pedido, itens, adicionais e historico em transacao.</p>
                </article>
                <article class="flow-card">
                    <strong>3</strong>
                    <h3>Operacao protegida</h3>
                    <p>Superadmin, admin, operador e cozinha ja entram por perfis separados, reduzindo acesso indevido nas rotas internas.</p>
                </article>
            </section>

            <section class="cta-band">
                <div>
                    <h2>Quer testar agora?</h2>
                    <p>Abra o tenant real Piemonte para testes operacionais ou entre nas areas internas. O tenant demo ainda sera criado em uma etapa futura.</p>
                </div>
                <div class="cta-stack">
                    <a class="cta primary" href="/<?= htmlspecialchars((string) ($realTestTenant['slug'] ?? 'piemonte'), ENT_QUOTES, 'UTF-8') ?>">Abrir Piemonte</a>
                    <a class="cta" href="/login">Entrar no sistema</a>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
