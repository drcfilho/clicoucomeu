<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?> — Venda Mais sem Comissões | Cardápio Digital & Sistema para Delivery</title>
    <style>
        :root {
            --primary: #e11d48;
            --primary-hover: #be123c;
            --primary-soft: rgba(225, 29, 72, 0.1);
            --accent-green: #16a34a;
            --dark-bg: #0f172a;
            --dark-card: #1e293b;
            --body-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --shadow-lg: 0 20px 40px -15px rgba(0, 0, 0, 0.08);
            --shadow-xl: 0 25px 50px -12px rgba(225, 29, 72, 0.25);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--body-bg);
            color: var(--text-dark);
            line-height: 1.6;
        }

        a { text-decoration: none; color: inherit; }
        .container { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }

        /* Announcement Bar */
        .announcement-bar {
            background: linear-gradient(90deg, #1e1b4b, #312e81);
            color: #e0e7ff;
            text-align: center;
            padding: 10px 16px;
            font-size: 0.88rem;
            font-weight: 600;
        }
        .announcement-bar span {
            background: #4338ca;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 0.75rem;
            margin-right: 6px;
            text-transform: uppercase;
        }

        /* Topbar Header */
        .header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
        }
        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 900;
            font-size: 1.4rem;
            color: var(--text-dark);
        }
        .logo-mark {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), #f43f5e);
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 1.4rem;
            box-shadow: 0 8px 16px rgba(225, 29, 72, 0.3);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-muted);
        }
        .nav-links a:hover { color: var(--primary); }

        .btn-header {
            background: var(--primary);
            color: #fff;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(225, 29, 72, 0.3);
        }
        .btn-header:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        /* HERO SECTION */
        .hero {
            padding: 60px 0 80px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 40px;
            align-items: center;
        }
        .badge-hero {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
        .badge-pulse {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
            box-shadow: 0 0 0 0 rgba(225, 29, 72, 0.7);
            animation: pulse 1.6s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(225, 29, 72, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(225, 29, 72, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(225, 29, 72, 0); }
        }

        .hero h1 {
            font-size: clamp(2.2rem, 4vw, 3.4rem);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin: 0 0 20px;
        }
        .hero h1 span {
            background: linear-gradient(135deg, var(--primary), #f43f5e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p {
            font-size: 1.15rem;
            color: var(--text-muted);
            margin: 0 0 32px;
            max-width: 540px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
        }
        .btn-cta-lg {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: #fff;
            padding: 18px 36px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 1.1rem;
            box-shadow: var(--shadow-xl);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .btn-cta-lg:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 60px -15px rgba(225, 29, 72, 0.4);
        }

        .btn-secondary-lg {
            background: #fff;
            border: 2px solid var(--border-color);
            color: var(--text-dark);
            padding: 16px 28px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.2s ease;
        }
        .btn-secondary-lg:hover {
            border-color: var(--text-dark);
            background: #f1f5f9;
        }

        .hero-guarantee {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 28px;
            font-size: 0.88rem;
            color: var(--text-muted);
            font-weight: 600;
        }
        .hero-guarantee item { display: flex; align-items: center; gap: 6px; }

        /* HERO CARD PREVIEW */
        .hero-preview {
            position: relative;
        }
        .preview-card {
            background: var(--card-bg);
            border-radius: 28px;
            padding: 28px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
        }
        .preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }
        .preview-title { font-weight: 800; font-size: 1.1rem; }
        .live-badge {
            background: #dcfce7;
            color: #15803d;
            padding: 4px 10px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.78rem;
        }

        .order-simulation { display: grid; gap: 14px; }
        .sim-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
        }
        .sim-info strong { display: block; font-size: 0.95rem; }
        .sim-info span { font-size: 0.8rem; color: var(--text-muted); }
        .sim-price { font-weight: 800; color: var(--primary); }

        .sim-total-box {
            background: #1e293b;
            color: #fff;
            padding: 16px 20px;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
        .sim-total-box span { color: #94a3b8; font-size: 0.9rem; }
        .sim-total-box strong { font-size: 1.25rem; color: #4ade80; }

        /* PROOF / COMPARISON SECTION */
        .comparison-section {
            padding: 80px 0;
            background: #fff;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }
        .section-title-center {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 50px;
        }
        .section-title-center h2 {
            font-size: 2.2rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            margin: 0 0 12px;
        }
        .section-title-center p {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin: 0;
        }

        .comparison-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            max-width: 960px;
            margin: 0 auto;
        }
        .comp-card {
            border-radius: 24px;
            padding: 36px 30px;
            border: 2px solid;
        }
        .comp-card.bad {
            background: #fff5f5;
            border-color: #fca5a5;
        }
        .comp-card.good {
            background: #f0fdf4;
            border-color: #86efac;
            box-shadow: 0 20px 40px -15px rgba(22, 163, 74, 0.15);
        }
        .comp-card h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0 0 20px;
        }
        .comp-card.bad h3 { color: #991b1b; }
        .comp-card.good h3 { color: #166534; }

        .comp-list { list-style: none; padding: 0; margin: 0; display: grid; gap: 14px; }
        .comp-list li { display: flex; align-items: flex-start; gap: 10px; font-weight: 600; font-size: 0.98rem; }
        .comp-card.bad li { color: #7f1d1d; }
        .comp-card.good li { color: #14532d; }

        /* FEATURES GRID */
        .features-section { padding: 90px 0; }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
        }
        .feature-box {
            background: #fff;
            border-radius: 20px;
            padding: 32px 26px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-lg);
            transition: transform 0.25s ease;
        }
        .feature-box:hover { transform: translateY(-4px); }
        .feature-icon-wrapper {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: var(--primary-soft);
            color: var(--primary);
            display: grid;
            place-items: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
        }
        .feature-box h3 { font-size: 1.25rem; font-weight: 800; margin: 0 0 10px; }
        .feature-box p { color: var(--text-muted); margin: 0; font-size: 0.95rem; line-height: 1.55; }

        /* CTA BANNER HIGH CONVERSION */
        .cta-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            border-radius: 32px;
            padding: 60px 48px;
            color: #fff;
            text-align: center;
            margin: 40px 0 80px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }
        .cta-banner h2 {
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            font-weight: 900;
            margin: 0 0 16px;
            letter-spacing: -0.02em;
        }
        .cta-banner p {
            color: #94a3b8;
            font-size: 1.15rem;
            max-width: 600px;
            margin: 0 auto 36px;
        }

        /* FOOTER DISCRETO */
        footer {
            border-top: 1px solid var(--border-color);
            padding: 32px 0;
            color: var(--text-muted);
            font-size: 0.88rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-restricted {
            color: var(--text-muted);
            opacity: 0.6;
            font-size: 0.8rem;
            transition: opacity 0.2s;
        }
        .footer-restricted:hover { opacity: 1; color: var(--primary); }

        @media (max-width: 900px) {
            .hero { grid-template-columns: 1fr; text-align: center; }
            .hero p { margin-left: auto; margin-right: auto; }
            .hero-actions { justify-content: center; }
            .hero-guarantee { justify-content: center; }
            .comparison-grid { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <!-- Top Notice -->
    <div class="announcement-bar">
        <span>Novidade</span> Aumente o lucro do seu delivery economizando até 100% das taxas sobre vendas!
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container header-inner">
            <div class="logo">
                <div class="logo-mark">🚀</div>
                <span><?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <nav class="nav-links">
                <a href="#comparativo">Por que usar?</a>
                <a href="#recursos">Recursos</a>
                <a href="#como-funciona">Como Funciona</a>
            </nav>
            <div>
                <a class="btn-header" href="/login">Área do Cliente</a>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Hero Section -->
        <section class="hero">
            <div>
                <div class="badge-hero">
                    <span class="badge-pulse"></span> Sistema Oficial para Restaurantes & Delivery
                </div>
                <h1>Receba pedidos direto no <span>seu WhatsApp</span> sem taxas de comissão.</h1>
                <p>
                    Tenha seu próprio cardápio digital completo, aceite pedidos online com cálculo de entrega automático por bairro e gerencie sua cozinha no piloto automático.
                </p>
                <div class="hero-actions">
                    <a class="btn-cta-lg" href="/login">
                        ⚡ Começar Agora Grátis
                    </a>
                    <a class="btn-secondary-lg" href="#recursos">
                        Conhecer Recursos
                    </a>
                </div>
                <div class="hero-guarantee">
                    <span>✓ Sem taxa por pedido</span>
                    <span>✓ Sem fidelidade</span>
                    <span>✓ Configuração em 5 min</span>
                </div>
            </div>

            <!-- Interactive Preview Simulation -->
            <div class="hero-preview">
                <div class="preview-card">
                    <div class="preview-header">
                        <div class="preview-title">📱 Simulação de Pedido Real</div>
                        <span class="live-badge">● Painel em Tempo Real</span>
                    </div>
                    <div class="order-simulation">
                        <div class="sim-item">
                            <div class="sim-info">
                                <strong>1x Pizza Grande (2 Sabores)</strong>
                                <span>Calabresa / 4 Queijos + Borda Cheddar</span>
                            </div>
                            <span class="sim-price">R$ 54,90</span>
                        </div>
                        <div class="sim-item">
                            <div class="sim-info">
                                <strong>1x Guaraná 2 Litros</strong>
                                <span>Gelado</span>
                            </div>
                            <span class="sim-price">R$ 12,00</span>
                        </div>
                        <div class="sim-item">
                            <div class="sim-info">
                                <strong>🛵 Entrega (Bairro Centro)</strong>
                                <span>Cálculo automático por bairro</span>
                            </div>
                            <span class="sim-price">R$ 6,00</span>
                        </div>
                        <div class="sim-total-box">
                            <span>Total Líquido (100% Seu)</span>
                            <strong>R$ 72,90</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Comparison Section -->
    <section class="comparison-section" id="comparativo">
        <div class="container">
            <div class="section-title-center">
                <h2>Pare de rasgar dinheiro com comissões abusivas</h2>
                <p>Veja a diferença real entre vender por aplicativos terceiros e ter sua própria plataforma direta.</p>
            </div>

            <div class="comparison-grid">
                <div class="comp-card bad">
                    <h3>❌ Aplicativos Tradicionais</h3>
                    <ul class="comp-list">
                        <li>❌ Cobram de 12% a 27% sobre CADA pedido realizado</li>
                        <li>❌ Seus clientes pertencem aos aplicativos, não a você</li>
                        <li>❌ Repasse do dinheiro demora semanas para cair na conta</li>
                        <li>❌ Concorrentes aparecem ao lado do seu restaurante</li>
                    </ul>
                </div>

                <div class="comp-card good">
                    <h3>✅ Com o <?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?></h3>
                    <ul class="comp-list">
                        <li>✅ 0% de comissão. O lucro das vendas é 100% seu</li>
                        <li>✅ Base de dados e contatos de clientes sob seu controle</li>
                        <li>✅ Recebimento imediato no seu caixa (PIX / Dinheiro)</li>
                        <li>✅ Link exclusivo e personalizado para o seu negócio</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="recursos">
        <div class="container">
            <div class="section-title-center">
                <h2>Tudo o que seu estabelecimento precisa em um só lugar</h2>
                <p>Ferramentas projetadas por quem entende a rotina e as necessidades de um delivery acelerado.</p>
            </div>

            <div class="features-grid">
                <div class="feature-box">
                    <div class="feature-icon-wrapper">📱</div>
                    <h3>Cardápio Digital Responsivo</h3>
                    <p>Interface ultra rápida para o cliente escolher tamanhos, adicionais, bordas e sabores divididos sem dúvidas ou erros.</p>
                </div>

                <div class="feature-box">
                    <div class="feature-icon-wrapper">📍</div>
                    <h3>Taxa de Entrega por Bairro</h3>
                    <p>Cadastre os bairros que você atende com suas respectivas taxas e tempos de entrega estimados de forma 100% automatizada.</p>
                </div>

                <div class="feature-box">
                    <div class="feature-icon-wrapper">🚨</div>
                    <h3>Painel de Pedidos & Som</h3>
                    <p>Acompanhe a chegada dos pedidos com alertas sonoros automáticos para sua equipe não perder nenhuma venda.</p>
                </div>

                <div class="feature-box">
                    <div class="feature-icon-wrapper">🍳</div>
                    <h3>Tela de Cozinha (KDS)</h3>
                    <p>Visualização limpa para a equipe de produção focada apenas nos itens, adicionais e observações sem poluição visual.</p>
                </div>

                <div class="feature-box">
                    <div class="feature-icon-wrapper">🎟️</div>
                    <h3>Cupons de Desconto</h3>
                    <p>Crie promoções estratégicas com cupons de valor fixo ou percentual e defina limites de uso para impulsionar dias fracos.</p>
                </div>

                <div class="feature-box">
                    <div class="feature-icon-wrapper">💵</div>
                    <h3>Troco Dinâmico & PIX Copia e Cola</h3>
                    <p>Facilite o pagamento para seu cliente com cálculo automático de troco em dinheiro e exibição da chave PIX instantânea.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <div class="container">
        <section class="cta-banner" id="como-funciona">
            <h2>Pronto para escalar seu delivery hoje?</h2>
            <p>Cadastre seus produtos em poucos minutos e comece a vender diretamente pelo seu link oficial sem pagar nenhuma comissão.</p>
            <a class="btn-cta-lg" href="/login">
                🚀 Criar Meu Cardápio Agora
            </a>
        </section>

        <!-- Footer -->
        <footer>
            <div>
                © <?= date('Y') ?> <?= htmlspecialchars((string) $appName, ENT_QUOTES, 'UTF-8') ?> — Todos os direitos reservados.
            </div>
            <a href="/login" class="footer-restricted">🔐 Acesso Restrito / Superadmin</a>
        </footer>
    </div>

</body>
</html>
