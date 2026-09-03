<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?> | A Plataforma de Delivery que Vende Mais</title>
    <style>
        :root {
            --bg: #fdfaf6;
            --paper: #ffffff;
            --ink: #18110b;
            --muted: #574f46;
            --line: rgba(135, 78, 23, 0.12);
            --accent: #d94111;
            --accent-hover: #b8330a;
            --accent-2: #f2994a;
            --accent-green: #1b8755;
            --shadow: 0 20px 50px rgba(180, 60, 10, 0.08);
            --shadow-card: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background:
                radial-gradient(circle at 10% 10%, rgba(242, 153, 74, 0.1), transparent 30%),
                radial-gradient(circle at 90% 20%, rgba(217, 65, 17, 0.08), transparent 35%),
                linear-gradient(180deg, #ffffff 0%, var(--bg) 100%);
            line-height: 1.5;
        }

        a { color: inherit; text-decoration: none; }
        .shell { min-height: 100vh; overflow: hidden; }
        .container { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }
        
        /* Navigation */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(16px);
            background: rgba(253, 250, 246, 0.85);
            border-bottom: 1px solid var(--line);
        }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: 1.2rem;
            color: #ffffff;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            box-shadow: 0 10px 20px rgba(217, 65, 17, 0.3);
        }
        .brand-copy strong { display: block; font-size: 1.1rem; font-weight: 800; letter-spacing: -0.02em; }
        .brand-copy span { display: block; color: var(--muted); font-size: 0.82rem; font-weight: 500; }
        .nav { display: flex; gap: 12px; align-items: center; }
        .nav a, .cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .nav a:not(.primary) {
            color: var(--ink);
        }
        .nav a:not(.primary):hover {
            color: var(--accent);
            background: rgba(217, 65, 17, 0.05);
        }
        .cta.primary, .nav .primary {
            color: #ffffff;
            border: none;
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            box-shadow: 0 10px 24px rgba(217, 65, 17, 0.28);
        }
        .cta.primary:hover, .nav .primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(217, 65, 17, 0.38);
        }
        .cta.secondary {
            background: #ffffff;
            border: 1px solid var(--line);
            color: var(--ink);
            box-shadow: var(--shadow-card);
        }
        .cta.secondary:hover {
            background: #faf8f5;
            border-color: rgba(135, 78, 23, 0.25);
        }

        /* Hero */
        .hero {
            padding: 56px 0 40px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 32px;
            align-items: center;
        }
        .hero-copy {
            position: relative;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 34px;
            padding: 0 14px;
            border-radius: 999px;
            background: rgba(27, 135, 85, 0.1);
            color: var(--accent-green);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }
        .eyebrow-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent-green);
            display: inline-block;
            box-shadow: 0 0 10px var(--accent-green);
        }
        .hero h1 {
            margin: 20px 0 18px;
            font-size: clamp(2.4rem, 4.5vw, 3.8rem);
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: var(--ink);
        }
        .hero h1 span {
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p {
            margin: 0;
            font-size: 1.15rem;
            line-height: 1.6;
            color: var(--muted);
            max-width: 54ch;
        }
        .hero-actions {
            margin-top: 32px;
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }
        .hero-meta {
            margin-top: 36px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
        }
        .metric strong { display: block; font-size: 1.8rem; font-weight: 800; color: var(--ink); }
        .metric span { display: block; color: var(--muted); margin-top: 2px; font-size: 0.88rem; font-weight: 500; }

        /* Showcase Preview Card */
        .hero-card {
            border-radius: 28px;
            padding: 24px;
            background: #ffffff;
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
        }
        .card-header {
            margin-bottom: 20px;
        }
        .card-header badge {
            background: rgba(217, 65, 17, 0.1);
            color: var(--accent);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .card-header h2 {
            margin: 8px 0 4px;
            font-size: 1.6rem;
            font-weight: 800;
        }
        .card-header p {
            margin: 0;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .device {
            border-radius: 24px;
            padding: 12px;
            background: #1e1915;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .device-screen {
            border-radius: 16px;
            overflow: hidden;
            background: #faf8f5;
            padding: 16px;
        }
        .device-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }
        .device-pill {
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            background: rgba(27, 135, 85, 0.12);
            color: var(--accent-green);
            font-size: 0.78rem;
            font-weight: 700;
        }
        .device-list { display: grid; gap: 10px; }
        .device-item {
            display: grid;
            grid-template-columns: 50px 1fr auto;
            gap: 12px;
            align-items: center;
            border-radius: 14px;
            padding: 10px;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }
        .device-thumb {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ffc880, #d94111);
            display: grid;
            place-items: center;
            font-size: 1.4rem;
        }
        .device-item strong { display: block; font-size: 0.92rem; font-weight: 700; }
        .device-item span { display: block; color: var(--muted); font-size: 0.78rem; margin-top: 2px; }
        .device-item b { color: var(--accent); font-size: 0.92rem; font-weight: 800; }

        /* Features Section */
        .section-header {
            text-align: center;
            max-width: 650px;
            margin: 60px auto 40px;
        }
        .section-header h2 {
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            margin: 0 0 12px;
        }
        .section-header p {
            color: var(--muted);
            font-size: 1.1rem;
            margin: 0;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }
        .feature {
            background: #ffffff;
            border-radius: 20px;
            padding: 32px 24px;
            border: 1px solid var(--line);
            box-shadow: var(--shadow-card);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .feature:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }
        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(217, 65, 17, 0.08);
            color: var(--accent);
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .feature h3 {
            margin: 0 0 10px;
            font-size: 1.3rem;
            font-weight: 700;
        }
        .feature p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.98rem;
        }

        /* Steps Section */
        .flow {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }
        .flow-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 32px 24px;
            border: 1px solid var(--line);
            position: relative;
        }
        .flow-num {
            display: inline-grid;
            place-items: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            color: #ffffff;
            font-weight: 800;
            font-size: 1.2rem;
            box-shadow: 0 8px 18px rgba(217, 65, 17, 0.25);
        }
        .flow-card h3 {
            margin: 0 0 10px;
            font-size: 1.2rem;
            font-weight: 700;
        }
        .flow-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.96rem;
        }

        /* Banner CTA */
        .cta-band {
            margin: 70px 0 60px;
            border-radius: 28px;
            padding: 48px 40px;
            background: linear-gradient(135deg, #18110b 0%, #342113 100%);
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            gap: 32px;
            align-items: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.18);
        }
        .cta-band h2 {
            margin: 0 0 10px;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #ffffff;
        }
        .cta-band p {
            margin: 0;
            color: rgba(255,255,255,0.78);
            max-width: 52ch;
            font-size: 1.08rem;
        }
        .cta-stack { display: flex; gap: 14px; flex-wrap: wrap; }

        /* Footer */
        footer {
            padding: 30px 0;
            border-top: 1px solid var(--line);
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        @media (max-width: 980px) {
            .hero, .feature-grid, .flow { grid-template-columns: 1fr; }
            .cta-band { flex-direction: column; align-items: flex-start; text-align: left; }
        }
        @media (max-width: 720px) {
            .topbar { position: static; padding: 14px 0; }
            .hero { padding-top: 20px; }
            .hero-meta { grid-template-columns: 1fr; gap: 12px; }
            .nav { display: none; } /* Mobile simplificado */
            .container { width: min(100%, calc(100% - 24px)); }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="container">
            <header class="topbar">
                <div class="brand">
                    <div class="brand-mark">🍕</div>
                    <div class="brand-copy">
                        <strong><?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?></strong>
                        <span>Cardápio Digital & Sistema para Delivery</span>
                    </div>
                </div>
                <nav class="nav">
                    <a href="#vantagens">Vantagens</a>
                    <a href="#como-funciona">Como Funciona</a>
                    <a href="/login">Área do Cliente</a>
                    <a class="primary" href="/<?= htmlspecialchars((string) ($realTestTenant['slug'] ?? 'piemonte'), ENT_QUOTES, 'UTF-8') ?>">Ver Demonstração</a>
                </nav>
            </header>

            <section class="hero">
                <div class="hero-copy">
                    <div class="eyebrow">
                        <span class="eyebrow-dot"></span>
                        Aumente suas vendas diretas sem pagar comissões
                    </div>
                    <h1>Seu delivery <span>vendendo no piloto automático</span> com cardápio próprio.</h1>
                    <p>
                        Receba pedidos direto no seu WhatsApp e painel de gestão. Sem intermediários, com taxas zeradas sobre vendas e pagamento rápido no seu caixa.
                    </p>
                    <div class="hero-actions">
                        <a class="cta primary" href="/<?= htmlspecialchars((string) ($realTestTenant['slug'] ?? 'piemonte'), ENT_QUOTES, 'UTF-8') ?>">Testar Cardápio Ao Vivo</a>
                        <a class="cta secondary" href="/login">Acessar Meu Painel</a>
                    </div>
                    <div class="hero-meta">
                        <div class="metric">
                            <strong>0% Comissoes</strong>
                            <span>Lucro 100% do seu restaurante em cada pedido.</span>
                        </div>
                        <div class="metric">
                            <strong>2x Mais Rapido</strong>
                            <span>Checkout otimizado para o cliente pedir em segundos.</span>
                        </div>
                        <div class="metric">
                            <strong>Total Controle</strong>
                            <span>Altere preços, adicionais e horários quando quiser.</span>
                        </div>
                    </div>
                </div>

                <aside class="hero-card">
                    <div class="card-header">
                        <badge>Demonstração Interativa</badge>
                        <h2>Cardápio em Ação</h2>
                        <p>Veja exatamente como seu cliente vai visualizar seu restaurante no celular:</p>
                    </div>
                    <div class="device">
                        <div class="device-screen">
                            <div class="device-bar">
                                <strong style="font-size:0.95rem; color:#18110b;"><?= htmlspecialchars((string) ($realTestTenant['name'] ?? 'Pizzaria Piemonte'), ENT_QUOTES, 'UTF-8') ?></strong>
                                <span class="device-pill">● Aberto Agora</span>
                            </div>
                            <div class="device-list">
                                <div class="device-item">
                                    <div class="device-thumb">🍕</div>
                                    <div>
                                        <strong>Pizza Artesanal Grande</strong>
                                        <span>Bordas recheadas, 2 sabores e adicionais</span>
                                    </div>
                                    <b>R$ 59,90</b>
                                </div>
                                <div class="device-item">
                                    <div class="device-thumb">🥤</div>
                                    <div>
                                        <strong>Combo Delivery Especial</strong>
                                        <span>Pizza + Bebida com entrega grátis</span>
                                    </div>
                                    <b>R$ 74,90</b>
                                </div>
                                <div class="device-item">
                                    <div class="device-thumb">🚀</div>
                                    <div>
                                        <strong>Acompanhamento em Tempo Real</strong>
                                        <span>Cliente vê a pizza saindo para entrega</span>
                                    </div>
                                    <b style="color:var(--accent-green);">Ativo</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </section>

            <div class="section-header" id="vantagens">
                <h2>Tudo o que seu restaurante precisa para crescer</h2>
                <p>Abandone os PDFs lentos e os aplicativos que ficam com a maior parte do seu lucro.</p>
            </div>

            <section class="feature-grid">
                <article class="feature">
                    <div class="feature-icon">📲</div>
                    <h3>Cardápio Digital Inteligente</h3>
                    <p>Organizado por categorias, opções de tamanhos, sabores divididos e adicionais. Muito simples para o cliente escolher e montar o pedido.</p>
                </article>
                <article class="feature">
                    <div class="feature-icon">⚡</div>
                    <h3>Checkout Rápido & Sem Erros</h3>
                    <p>Cálculo automático de taxa de entrega por bairro, cupons de desconto e confirmação instantânea de endereço e pagamento.</p>
                </article>
                <article class="feature">
                    <div class="feature-icon">🍳</div>
                    <h3>Gestão de Pedidos & Cozinha</h3>
                    <p>Painel completo para acompanhar pedidos em produção, gerenciar entregas e organizar a fila da cozinha em tempo real.</p>
                </article>
            </section>

            <div class="section-header" id="como-funciona">
                <h2>Como funciona para o seu negócio</h2>
                <p>Em apenas 3 passos simples você já está pronto para receber pedidos online.</p>
            </div>

            <section class="flow">
                <article class="flow-card">
                    <div class="flow-num">1</div>
                    <h3>Cadastre seu Cardápio</h3>
                    <p>Insira seus produtos, fotos, adicionais e bairros atendidos de forma rápida no painel intuitivo.</p>
                </article>
                <article class="flow-card">
                    <div class="flow-num">2</div>
                    <h3>Divulgue seu Link Exclusivo</h3>
                    <p>Coloque o link do seu cardápio na bio do Instagram, WhatsApp e redes sociais para seus clientes pedirem direto.</p>
                </article>
                <article class="flow-card">
                    <div class="flow-num">3</div>
                    <h3>Receba Pedidos e Fature</h3>
                    <p>Os pedidos chegam organizados no seu painel e impressora, prontos para a produção e entrega sem complicação.</p>
                </article>
            </section>

            <section class="cta-band">
                <div>
                    <h2>Pronto para modernizar seu delivery?</h2>
                    <p>Experimente nosso cardápio na prática agora mesmo ou acesse o painel administrativo.</p>
                </div>
                <div class="cta-stack">
                    <a class="cta primary" href="/<?= htmlspecialchars((string) ($realTestTenant['slug'] ?? 'piemonte'), ENT_QUOTES, 'UTF-8') ?>">Experimentar Cardápio</a>
                    <a class="cta secondary" href="/login">Acessar Painel</a>
                </div>
            </section>

            <footer>
                <p>© <?= date('Y') ?> <?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?> - Todos os direitos reservados. Feito para fortalecer o comércio local.</p>
            </footer>
        </div>
    </div>
</body>
</html>

