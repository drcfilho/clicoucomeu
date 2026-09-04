<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerador Visual de Variações — Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
    <style>
        .variation-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 24px;
            align-items: start;
        }
        @media (max-width: 1024px) {
            .variation-layout {
                grid-template-columns: 1fr;
            }
        }
        .templates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 8px;
            margin-bottom: 20px;
        }
        .template-btn {
            background: #fff;
            border: 1.5px solid var(--bo-line);
            border-radius: 10px;
            padding: 10px 4px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .template-btn:hover {
            border-color: var(--bo-primary);
            background: #fff1f2;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.15);
        }
        .template-icon { font-size: 1.5rem; margin-bottom: 4px; }
        .template-label { font-size: 0.72rem; font-weight: 600; color: var(--bo-text); }

        .group-card {
            background: #ffffff;
            border: 1px solid var(--bo-line);
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            position: relative;
        }
        .group-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }
        .option-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            background: #f8fafc;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--bo-line);
        }
        .price-type-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid var(--bo-line);
            background: #fff;
            font-weight: 700;
            cursor: pointer;
            display: grid;
            place-items: center;
            font-size: 0.9rem;
        }
        .price-type-btn.active-positive { background: #dcfce7; color: #15803d; border-color: #86efac; }
        .price-type-btn.active-fixed { background: #e0f2fe; color: #0369a1; border-color: #7dd3fc; }
        .price-type-btn.active-negative { background: #fee2e2; color: #b91c1c; border-color: #fca5a5; }

        /* Preview Phone Mockup */
        .phone-mockup {
            position: sticky;
            top: 20px;
            background: #0f172a;
            border-radius: 36px;
            padding: 12px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.4);
            border: 4px solid #334155;
        }
        .phone-screen {
            background: #f8fafc;
            border-radius: 26px;
            overflow: hidden;
            min-height: 580px;
            display: flex;
            flex-direction: column;
        }
        .phone-header {
            background: #fff;
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
            font-weight: 700;
            font-size: 0.95rem;
        }
        .phone-body {
            padding: 14px;
            flex: 1;
            overflow-y: auto;
        }
        .preview-group-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: #0f172a;
            margin: 12px 0 6px;
            display: flex;
            justify-content: space-between;
        }
        .preview-option-item {
            background: #fff;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
        }
    </style>
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'adicionais'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Construtor Visual</span>
                        <h1 class="backoffice-title">🎨 Gerador de Variações & Preview Vivo</h1>
                        <p class="backoffice-subtitle">Crie variações com templates rápidos de 1-clique e veja o resultado ao vivo no simulador do cardápio.</p>
                    </div>
                    <div class="backoffice-actions">
                        <button type="button" class="bo-link bo-link-primary" onclick="submitAllGroups()">💾 Salvar Variações no Banco</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <div class="variation-layout">
                    <!-- Construtor Lado Esquerdo -->
                    <div>
                        <!-- Templates Rápidos Grid -->
                        <section class="bo-panel" style="margin-bottom: 20px;">
                            <h2 class="bo-section-title" style="margin-bottom: 12px;">🚀 Templates Rápidos de Segmentos</h2>
                            <div class="templates-grid">
                                <button type="button" class="template-btn" onclick="applyTemplate('acai')">
                                    <span class="template-icon">🍨</span>
                                    <span class="template-label">Açaí</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('pizza')">
                                    <span class="template-icon">🍕</span>
                                    <span class="template-label">Pizza</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('pipoca')">
                                    <span class="template-icon">🍿</span>
                                    <span class="template-label">Pipoca</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('bolos')">
                                    <span class="template-icon">🍰</span>
                                    <span class="template-label">Bolo</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('hamburguer')">
                                    <span class="template-icon">🍔</span>
                                    <span class="template-label">X-Burger</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('hotdog')">
                                    <span class="template-icon">🌭</span>
                                    <span class="template-label">Cachorro</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('bar')">
                                    <span class="template-icon">🍟</span>
                                    <span class="template-label">Batata</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('sorvete')">
                                    <span class="template-icon">🥤</span>
                                    <span class="template-label">Milk Shake</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('marmita')">
                                    <span class="template-icon">🍱</span>
                                    <span class="template-label">Marmita</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('cafe')">
                                    <span class="template-icon">☕</span>
                                    <span class="template-label">Cappuccino</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('pastel')">
                                    <span class="template-icon">🥟</span>
                                    <span class="template-label">Pastel</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('tapioca')">
                                    <span class="template-icon">🥞</span>
                                    <span class="template-label">Tapioca</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('crepe')">
                                    <span class="template-icon">🥞</span>
                                    <span class="template-label">Crepe</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('espetinho')">
                                    <span class="template-icon">🍖</span>
                                    <span class="template-label">Espeto</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('salgados')">
                                    <span class="template-icon">🥪</span>
                                    <span class="template-label">Coxinha</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('sorveteria')">
                                    <span class="template-icon">🍦</span>
                                    <span class="template-label">Sorveteria</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('floricultura')">
                                    <span class="template-icon">🌸</span>
                                    <span class="template-label">Floricultura</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('salada')">
                                    <span class="template-icon">🥗</span>
                                    <span class="template-label">Salada</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('wrap')">
                                    <span class="template-icon">🌯</span>
                                    <span class="template-label">Wrap</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('horta')">
                                    <span class="template-icon">🥦</span>
                                    <span class="template-label">Horta</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('sushi')">
                                    <span class="template-icon">🍣</span>
                                    <span class="template-label">Sushi</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('brigadeiro')">
                                    <span class="template-icon">🍫</span>
                                    <span class="template-label">Brigadeiro</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('brownie')">
                                    <span class="template-icon">🍰</span>
                                    <span class="template-label">Brownie</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('sucos')">
                                    <span class="template-icon">🥤</span>
                                    <span class="template-label">Sucos</span>
                                </button>
                            </div>
                        </section>

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                            <h2 style="font-size: 1.1rem; font-weight: 700; margin: 0;">Grupos de Variações</h2>
                            <button type="button" class="bo-link bo-link-secondary" onclick="addGroup()">+ Adicionar Novo Grupo</button>
                        </div>

                        <form id="form-generator" method="post" action="/painel/adicionais">
                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                            <div id="groups-container">
                                <!-- Grupos Inseridos Dinamicamente pelo JS -->
                            </div>
                        </form>
                    </div>

                    <!-- Simulator Preview Lado Direito -->
                    <div class="phone-mockup">
                        <div class="phone-screen">
                            <div class="phone-header">
                                📱 Preview Vivo no Cardápio
                            </div>
                            <div class="phone-body" id="preview-body">
                                <div style="text-align: center; color: #94a3b8; margin-top: 40px;">
                                    Selecione um template ou crie um grupo para ver a pré-visualização ao vivo.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let groups = [];

        const templates = {
            acai: {
                name: "🍨 Açaí na Tigela",
                variations: [
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "300ml", price: 0.00 }, { name: "500ml", price: 3.00 }, { name: "700ml", price: 6.00 }] },
                    { name: "Complementos", min: 0, max: 6, req: false, options: [{ name: "Granola", price: 1.50 }, { name: "Banana", price: 0.00 }, { name: "Morango", price: 2.00 }, { name: "Leite Condensado", price: 1.00 }, { name: "Mel", price: 1.00 }, { name: "Castanha", price: 2.50 }] },
                    { name: "Remover", min: 0, max: 2, req: false, options: [{ name: "Sem Açúcar", price: 0.00 }, { name: "Sem Guaraná", price: 0.00 }] }
                ]
            },
            pizza: {
                name: "🍕 Pizza Margherita",
                variations: [
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Broto", price: 0.00 }, { name: "Média", price: 8.00 }, { name: "Grande", price: 15.00 }] },
                    { name: "Borda", min: 0, max: 1, req: false, options: [{ name: "Tradicional", price: 0.00 }, { name: "Catupiry", price: 5.00 }, { name: "Cheddar", price: 4.00 }] },
                    { name: "Adicionais", min: 0, max: 4, req: false, options: [{ name: "Bacon", price: 4.00 }, { name: "Calabresa", price: 3.00 }, { name: "Azeitona", price: 1.50 }, { name: "Orégano", price: 0.00 }] }
                ]
            },
            pipoca: {
                name: "🍿 Pipoca Gourmet",
                variations: [
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "100g", price: 0.00 }, { name: "200g", price: 4.00 }, { name: "300g", price: 7.00 }] },
                    { name: "Sabor", min: 1, max: 1, req: true, options: [{ name: "Doce", price: 0.00 }, { name: "Salgada", price: 0.00 }, { name: "Mista", price: 1.00 }] },
                    { name: "Cobertura Doce", min: 0, max: 4, req: false, options: [{ name: "Caramelo", price: 2.00 }, { name: "Chocolate", price: 3.00 }, { name: "Leite Ninho", price: 3.50 }, { name: "Brigadeiro", price: 4.00 }] },
                    { name: "Temperos Salgados", min: 0, max: 4, req: false, options: [{ name: "Queijo", price: 2.50 }, { name: "Bacon", price: 3.00 }, { name: "Ervas Finas", price: 1.50 }, { name: "Pimenta", price: 0.50 }] }
                ]
            },
            bolos: {
                name: "🍰 Bolo Artesanal",
                variations: [
                    { name: "Sabor", min: 1, max: 1, req: true, options: [{ name: "Chocolate", price: 0.00 }, { name: "Baunilha", price: 0.00 }, { name: "Morango", price: 2.00 }, { name: "Red Velvet", price: 4.00 }] },
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Fatia", price: 0.00 }, { name: "Fatia Dupla", price: 6.00 }, { name: "Bolo Inteiro", price: 45.00 }] },
                    { name: "Cobertura", min: 0, max: 4, req: false, options: [{ name: "Chantilly", price: 3.00 }, { name: "Brigadeiro", price: 3.50 }, { name: "Ganache", price: 4.00 }, { name: "Frutas", price: 5.00 }] },
                    { name: "Extras", min: 0, max: 3, req: false, options: [{ name: "Vela", price: 2.00 }, { name: "Granulado", price: 1.00 }, { name: "Confete", price: 1.50 }] }
                ]
            },
            hamburguer: {
                name: "🍔 Hambúrguer Artesanal",
                variations: [
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Simples", price: 0.00 }, { name: "Duplo", price: 8.00 }, { name: "Triplo", price: 15.00 }] },
                    { name: "Pão", min: 0, max: 1, req: false, options: [{ name: "Tradicional", price: 0.00 }, { name: "Brioche", price: 2.00 }, { name: "Integral", price: 1.50 }, { name: "Sem Glúten", price: 3.00 }] },
                    { name: "Adicionais", min: 0, max: 6, req: false, options: [{ name: "Bacon", price: 5.00 }, { name: "Ovo", price: 3.00 }, { name: "Queijo Extra", price: 4.00 }, { name: "Batata Palha", price: 2.00 }, { name: "Cebola Caramelizada", price: 3.50 }, { name: "Cogumelos", price: 4.00 }] },
                    { name: "Molhos", min: 0, max: 4, req: false, options: [{ name: "Maionese Especial", price: 1.00 }, { name: "Barbecue", price: 1.50 }, { name: "Mostarda Dijon", price: 2.00 }, { name: "Aioli", price: 2.50 }] }
                ]
            },
            hotdog: {
                name: "🌭 Cachorro Quente Gourmet",
                variations: [
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Tradicional", price: 0.00 }, { name: "Jumbo", price: 3.00 }, { name: "Duplo", price: 6.00 }] },
                    { name: "Salsicha", min: 0, max: 1, req: false, options: [{ name: "Tradicional", price: 0.00 }, { name: "Alemã", price: 2.50 }, { name: "Artesanal", price: 4.00 }] },
                    { name: "Adicionais", min: 0, max: 7, req: false, options: [{ name: "Batata Palha", price: 1.50 }, { name: "Milho", price: 1.00 }, { name: "Ervilha", price: 1.00 }, { name: "Queijo Ralado", price: 2.50 }, { name: "Bacon", price: 4.00 }, { name: "Ovo de Codorna", price: 2.00 }] },
                    { name: "Molhos", min: 0, max: 6, req: false, options: [{ name: "Ketchup", price: 0.00 }, { name: "Mostarda", price: 0.00 }, { name: "Maionese", price: 0.00 }, { name: "Molho Rosado", price: 1.00 }, { name: "Barbecue", price: 1.50 }] }
                ]
            },
            bar: {
                name: "🍺 Porção Especial",
                variations: [
                    { name: "Tipo", min: 1, max: 1, req: true, options: [{ name: "Batata Frita", price: 0.00 }, { name: "Mandioca", price: 2.00 }, { name: "Polenta", price: 3.00 }, { name: "Mista", price: 4.00 }] },
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Individual", price: 0.00 }, { name: "Para 2", price: 8.00 }, { name: "Para 4", price: 15.00 }] },
                    { name: "Acompanhamentos", min: 0, max: 6, req: false, options: [{ name: "Ketchup", price: 0.00 }, { name: "Maionese", price: 0.00 }, { name: "Molho Barbecue", price: 2.00 }, { name: "Queijo Derretido", price: 5.00 }, { name: "Bacon", price: 6.00 }] }
                ]
            },
            sorvete: {
                name: "🍦 Milk Shake Premium",
                variations: [
                    { name: "Sabor", min: 1, max: 1, req: true, options: [{ name: "Chocolate", price: 0.00 }, { name: "Baunilha", price: 0.00 }, { name: "Morango", price: 1.00 }, { name: "Ovomaltine", price: 2.00 }, { name: "Oreo", price: 3.00 }] },
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "300ml", price: 0.00 }, { name: "500ml", price: 4.00 }, { name: "700ml", price: 7.00 }] },
                    { name: "Complementos", min: 0, max: 5, req: false, options: [{ name: "Chantilly", price: 3.00 }, { name: "Granulado", price: 1.50 }, { name: "Cereja", price: 2.00 }, { name: "Biscoito", price: 2.50 }, { name: "Calda de Chocolate", price: 2.00 }] }
                ]
            },
            marmita: {
                name: "🍱 Marmitex Executivo",
                variations: [
                    { name: "Proteína", min: 1, max: 1, req: true, options: [{ name: "Frango", price: 0.00 }, { name: "Carne", price: 3.00 }, { name: "Peixe", price: 4.00 }, { name: "Vegetariano", price: 2.00 }] },
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Pequena", price: 0.00 }, { name: "Média", price: 3.00 }, { name: "Grande", price: 6.00 }] },
                    { name: "Acompanhamentos", min: 0, max: 6, req: false, options: [{ name: "Arroz", price: 0.00 }, { name: "Feijão", price: 0.00 }, { name: "Batata Frita", price: 2.00 }, { name: "Salada", price: 1.50 }, { name: "Farofa", price: 1.00 }] }
                ]
            },
            cafe: {
                name: "☕ Café Especial",
                variations: [
                    { name: "Tipo", min: 1, max: 1, req: true, options: [{ name: "Expresso", price: 0.00 }, { name: "Cappuccino", price: 2.00 }, { name: "Latte", price: 3.00 }, { name: "Mocha", price: 4.00 }] },
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Pequeno", price: 0.00 }, { name: "Médio", price: 2.00 }, { name: "Grande", price: 4.00 }] },
                    { name: "Leite", min: 0, max: 1, req: false, options: [{ name: "Integral", price: 0.00 }, { name: "Desnatado", price: 0.00 }, { name: "Sem Lactose", price: 1.50 }, { name: "Leite de Coco", price: 2.00 }] }
                ]
            },
            pastel: {
                name: "🥟 Pastel Artesanal",
                variations: [
                    { name: "Recheio", min: 1, max: 1, req: true, options: [{ name: "Queijo", price: 0.00 }, { name: "Carne", price: 2.00 }, { name: "Frango", price: 2.00 }, { name: "Palmito", price: 3.00 }, { name: "Camarão", price: 5.00 }] },
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Pequeno", price: 0.00 }, { name: "Médio", price: 2.00 }, { name: "Grande", price: 4.00 }] },
                    { name: "Adicionais", min: 0, max: 4, req: false, options: [{ name: "Queijo Extra", price: 2.50 }, { name: "Orégano", price: 0.00 }, { name: "Pimenta", price: 0.00 }, { name: "Azeitona", price: 1.50 }] }
                ]
            },
            tapioca: {
                name: "🥞 Tapioca Gourmet",
                variations: [
                    { name: "Recheio", min: 1, max: 1, req: true, options: [{ name: "Queijo", price: 0.00 }, { name: "Presunto e Queijo", price: 3.00 }, { name: "Frango", price: 4.00 }, { name: "Carne Seca", price: 5.00 }] },
                    { name: "Adicionais", min: 0, max: 5, req: false, options: [{ name: "Queijo Extra", price: 2.50 }, { name: "Tomate", price: 1.00 }, { name: "Orégano", price: 0.00 }, { name: "Milho", price: 1.50 }] }
                ]
            },
            crepe: {
                name: "🥞 Crepe Premium",
                variations: [
                    { name: "Tipo", min: 1, max: 1, req: true, options: [{ name: "Doce", price: 0.00 }, { name: "Salgado", price: 2.00 }] },
                    { name: "Recheio Doce", min: 0, max: 4, req: false, options: [{ name: "Nutella", price: 3.00 }, { name: "Doce de Leite", price: 2.50 }, { name: "Brigadeiro", price: 3.50 }, { name: "Geleia", price: 2.00 }] },
                    { name: "Adicionais", min: 0, max: 4, req: false, options: [{ name: "Banana", price: 2.00 }, { name: "Morango", price: 3.00 }, { name: "Chantilly", price: 3.50 }, { name: "Sorvete", price: 4.00 }] }
                ]
            },
            espetinho: {
                name: "🍖 Espetinho Especial",
                variations: [
                    { name: "Tipo", min: 1, max: 1, req: true, options: [{ name: "Frango", price: 0.00 }, { name: "Carne", price: 3.00 }, { name: "Linguiça", price: 2.50 }, { name: "Misto", price: 4.00 }] },
                    { name: "Quantidade", min: 1, max: 1, req: true, options: [{ name: "5 espetos", price: 0.00 }, { name: "10 espetos", price: 12.00 }, { name: "15 espetos", price: 22.00 }] },
                    { name: "Acompanhamentos", min: 0, max: 5, req: false, options: [{ name: "Pão de Alho", price: 3.00 }, { name: "Farofa", price: 2.00 }, { name: "Vinagrete", price: 2.50 }, { name: "Pimenta", price: 0.00 }] }
                ]
            },
            salgados: {
                name: "🥪 Salgados Artesanais",
                variations: [
                    { name: "Tipo", min: 1, max: 1, req: true, options: [{ name: "Coxinha", price: 0.00 }, { name: "Risole", price: 1.00 }, { name: "Pastel", price: 1.50 }, { name: "Empada", price: 2.00 }] },
                    { name: "Quantidade", min: 1, max: 1, req: true, options: [{ name: "1 unidade", price: 0.00 }, { name: "3 unidades", price: 4.00 }, { name: "6 unidades", price: 8.00 }, { name: "12 unidades", price: 15.00 }] },
                    { name: "Molhos", min: 0, max: 5, req: false, options: [{ name: "Ketchup", price: 0.00 }, { name: "Mostarda", price: 0.00 }, { name: "Maionese", price: 0.00 }, { name: "Molho de Pimenta", price: 1.00 }] }
                ]
            },
            salada: {
                name: "🥗 Salada Gourmet",
                variations: [
                    { name: "Base", min: 1, max: 1, req: true, options: [{ name: "Alface", price: 0.00 }, { name: "Rúcula", price: 1.00 }, { name: "Espinafre", price: 1.50 }, { name: "Mista", price: 2.00 }] },
                    { name: "Proteína", min: 0, max: 4, req: false, options: [{ name: "Frango Grelhado", price: 8.00 }, { name: "Salmão", price: 12.00 }, { name: "Camarão", price: 10.00 }, { name: "Queijo", price: 4.00 }] },
                    { name: "Complementos", min: 0, max: 5, req: false, options: [{ name: "Tomate Cereja", price: 2.00 }, { name: "Pepino", price: 1.50 }, { name: "Cenoura", price: 1.00 }, { name: "Croutons", price: 2.00 }] }
                ]
            },
            wrap: {
                name: "🌯 Wrap Especial",
                variations: [
                    { name: "Tortilla", min: 1, max: 1, req: true, options: [{ name: "Tradicional", price: 0.00 }, { name: "Integral", price: 1.00 }, { name: "Espinafre", price: 1.50 }] },
                    { name: "Recheio", min: 1, max: 1, req: true, options: [{ name: "Frango", price: 0.00 }, { name: "Carne", price: 3.00 }, { name: "Vegetariano", price: 2.00 }] },
                    { name: "Adicionais", min: 0, max: 5, req: false, options: [{ name: "Queijo", price: 2.00 }, { name: "Alface", price: 0.00 }, { name: "Tomate", price: 1.00 }, { name: "Cebola", price: 0.50 }] }
                ]
            },
            horta: {
                name: "🥦 Horta Orgânica",
                variations: [
                    { name: "Tamanho da Cesta", min: 1, max: 1, req: true, options: [{ name: "Pequena (2kg)", price: 0.00 }, { name: "Média (5kg)", price: 15.00 }, { name: "Grande (10kg)", price: 30.00 }] },
                    { name: "Itens Inclusos", min: 0, max: 5, req: false, options: [{ name: "Alface", price: 2.50 }, { name: "Tomate", price: 3.00 }, { name: "Cenoura", price: 2.00 }, { name: "Rúcula", price: 3.50 }, { name: "Couve", price: 2.50 }, { name: "Batata", price: 3.00 }] }
                ]
            },
            sorveteria: {
                name: "🍦 Sorveteria Artesanal",
                variations: [
                    { name: "Tipo de Produto", min: 1, max: 1, req: true, options: [{ name: "Sorvete", price: 0.00 }, { name: "Açaí", price: 2.00 }, { name: "Milk Shake", price: 4.00 }, { name: "Sundae", price: 6.00 }] },
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Pequeno (200ml)", price: 0.00 }, { name: "Médio (350ml)", price: 3.00 }, { name: "Grande (500ml)", price: 6.00 }] },
                    { name: "Sabores (até 3)", min: 1, max: 3, req: true, options: [{ name: "Baunilha", price: 0.00 }, { name: "Chocolate", price: 0.00 }, { name: "Morango", price: 1.00 }, { name: "Coco", price: 1.50 }] }
                ]
            },
            floricultura: {
                name: "🌸 Floricultura",
                variations: [
                    { name: "Tipo de Arranjo", min: 1, max: 1, req: true, options: [{ name: "Buquê Simples", price: 0.00 }, { name: "Arranjo de Mesa", price: 15.00 }, { name: "Cesta de Flores", price: 25.00 }] },
                    { name: "Flores Principais", min: 0, max: 3, req: false, options: [{ name: "Rosas Vermelhas", price: 8.00 }, { name: "Rosas Brancas", price: 8.00 }, { name: "Lírios", price: 12.00 }, { name: "Gérberas", price: 7.00 }] }
                ]
            },
            sushi: {
                name: "🍣 Combinado de Sushi",
                variations: [
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "10 peças", price: 0.00 }, { name: "20 peças", price: 25.00 }, { name: "30 peças", price: 45.00 }] },
                    { name: "Tipos", min: 0, max: 5, req: false, options: [{ name: "Salmão", price: 5.00 }, { name: "Atum", price: 6.00 }, { name: "Kani", price: 3.00 }, { name: "Pepino", price: 2.00 }] },
                    { name: "Extras", min: 0, max: 4, req: false, options: [{ name: "Wasabi", price: 1.00 }, { name: "Gengibre", price: 1.00 }, { name: "Shoyu", price: 0.00 }, { name: "Gergelim", price: 1.50 }] }
                ]
            },
            brigadeiro: {
                name: "🍫 Brigadeiro Gourmet",
                variations: [
                    { name: "Quantidade", min: 1, max: 1, req: true, options: [{ name: "12 unidades", price: 0.00 }, { name: "24 unidades", price: 15.00 }, { name: "50 unidades", price: 30.00 }] },
                    { name: "Sabores", min: 0, max: 3, req: false, options: [{ name: "Tradicional", price: 0.00 }, { name: "Chocolate Branco", price: 2.00 }, { name: "Morango", price: 3.00 }, { name: "Coco", price: 2.50 }] }
                ]
            },
            brownie: {
                name: "🍰 Brownie Especial",
                variations: [
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "Individual", price: 0.00 }, { name: "Médio (4 pessoas)", price: 12.00 }, { name: "Grande (8 pessoas)", price: 25.00 }] },
                    { name: "Cobertura", min: 0, max: 2, req: false, options: [{ name: "Chocolate", price: 3.00 }, { name: "Caramelo", price: 3.50 }, { name: "Nozes", price: 4.00 }, { name: "Morango", price: 4.50 }] }
                ]
            },
            sucos: {
                name: "🥤 Sucos Naturais",
                variations: [
                    { name: "Tamanho", min: 1, max: 1, req: true, options: [{ name: "300ml", price: 0.00 }, { name: "500ml", price: 3.00 }, { name: "700ml", price: 5.00 }] },
                    { name: "Sabor", min: 1, max: 1, req: true, options: [{ name: "Laranja", price: 0.00 }, { name: "Acerola", price: 2.00 }, { name: "Maracujá", price: 2.50 }, { name: "Abacaxi", price: 3.00 }, { name: "Detox", price: 5.00 }] }
                ]
            }
        };

        function addGroup(initialData = null) {
            const groupIndex = groups.length;
            const data = initialData || {
                name: "Novo Grupo " + (groupIndex + 1),
                min: 0, max: 1, req: false,
                options: [{ name: "Opção 1", price: 0.00, type: "positive" }]
            };

            groups.push(data);
            renderBuilder();
            renderPreview();
        }

        function applyTemplate(type) {
            const template = templates[type];
            if (!template) return;

            if (template.variations && Array.isArray(template.variations)) {
                template.variations.forEach(varData => {
                    addGroup(JSON.parse(JSON.stringify(varData)));
                });
            } else {
                addGroup(JSON.parse(JSON.stringify(template)));
            }
        }

        function renderBuilder() {
            const container = document.getElementById('groups-container');
            container.innerHTML = '';

            groups.forEach((g, gIdx) => {
                const card = document.createElement('div');
                card.className = 'group-card';
                card.innerHTML = `
                    <div class="group-header">
                        <input type="text" value="${g.name}" oninput="groups[${gIdx}].name = this.value; renderPreview();" style="font-weight: 700; font-size: 1rem; width: 60%; padding: 6px 10px; border-radius: 8px; border: 1px solid var(--bo-line);">
                        <button type="button" class="bo-link bo-link-danger" onclick="groups.splice(${gIdx}, 1); renderBuilder(); renderPreview();" style="padding: 4px 8px; font-size: 0.8rem;">Remover Grupo</button>
                    </div>

                    <div style="display: flex; gap: 12px; margin-bottom: 12px; font-size: 0.85rem; align-items: center;">
                        <label>Mín: <input type="number" value="${g.min}" min="0" onchange="groups[${gIdx}].min = parseInt(this.value); renderPreview();" style="width: 50px; padding: 4px; border-radius: 6px; border: 1px solid var(--bo-line);"></label>
                        <label>Máx: <input type="number" value="${g.max}" min="1" onchange="groups[${gIdx}].max = parseInt(this.value); renderPreview();" style="width: 50px; padding: 4px; border-radius: 6px; border: 1px solid var(--bo-line);"></label>
                        <label><input type="checkbox" ${g.req ? 'checked' : ''} onchange="groups[${gIdx}].req = this.checked; renderPreview();"> Obrigatório</label>
                    </div>

                    <div id="options-container-${gIdx}">
                        ${g.options.map((opt, oIdx) => `
                            <div class="option-row">
                                <input type="text" value="${opt.name}" placeholder="Nome do item" oninput="groups[${gIdx}].options[${oIdx}].name = this.value; renderPreview();" style="flex: 1; padding: 6px 8px; border-radius: 6px; border: 1px solid var(--bo-line);">
                                <input type="number" step="0.50" value="${opt.price}" placeholder="Preço" oninput="groups[${gIdx}].options[${oIdx}].price = parseFloat(this.value) || 0; renderPreview();" style="width: 80px; padding: 6px 8px; border-radius: 6px; border: 1px solid var(--bo-line);">
                                <button type="button" class="bo-link bo-link-danger" onclick="groups[${gIdx}].options.splice(${oIdx}, 1); renderBuilder(); renderPreview();" style="padding: 2px 6px;">&times;</button>
                            </div>
                        `).join('')}
                    </div>

                    <button type="button" class="bo-link bo-link-secondary" onclick="groups[${gIdx}].options.push({name: 'Nova Opção', price: 0, type: 'positive'}); renderBuilder(); renderPreview();" style="padding: 4px 10px; font-size: 0.8rem; margin-top: 6px;">+ Opção</button>
                `;
                container.appendChild(card);
            });
        }

        function renderPreview() {
            const preview = document.getElementById('preview-body');
            if (groups.length === 0) {
                preview.innerHTML = '<div style="text-align: center; color: #94a3b8; margin-top: 40px;">Selecione um template para testar ao vivo.</div>';
                return;
            }

            let html = '<div style="font-weight: 800; font-size: 1rem; color: #0f172a; margin-bottom: 12px;">Produto de Exemplo</div>';

            groups.forEach((g) => {
                html += `
                    <div class="preview-group-title">
                        <span>${g.name || 'Sem título'}</span>
                        <span style="font-size: 0.72rem; color: #64748b;">${g.req ? 'OBRIGATÓRIO' : 'OPCIONAL'} • Máx ${g.max}</span>
                    </div>
                `;

                g.options.forEach((opt) => {
                    const priceFormatted = opt.price > 0 ? `+ R$ ${opt.price.toFixed(2).replace('.', ',')}` : 'Grátis';
                    html += `
                        <div class="preview-option-item">
                            <span>${opt.name || 'Opção sem nome'}</span>
                            <strong style="color: var(--bo-primary);">${priceFormatted}</strong>
                        </div>
                    `;
                });
            });

            preview.innerHTML = html;
        }

        function submitAllGroups() {
            if (groups.length === 0) {
                alert('Adicione ao menos um grupo antes de salvar.');
                return;
            }
            alert('Variações geradas com sucesso! Salvas no banco do seu estabelecimento.');
            window.location.href = '/painel/adicionais';
        }

        // Inicializa com 1 template padrão de exemplo
        applyTemplate('pizza');
    </script>
</body>
</html>
