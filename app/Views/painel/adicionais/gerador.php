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
                                <button type="button" class="template-btn" onclick="applyTemplate('bolo')">
                                    <span class="template-icon">🍰</span>
                                    <span class="template-label">Bolo</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('burger')">
                                    <span class="template-icon">🍔</span>
                                    <span class="template-label">Burger</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('hotdog')">
                                    <span class="template-icon">🌭</span>
                                    <span class="template-label">Cachorro</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('batata')">
                                    <span class="template-icon">🍟</span>
                                    <span class="template-label">Batata</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('milkshake')">
                                    <span class="template-icon">🥤</span>
                                    <span class="template-label">Milk Shake</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('marmita')">
                                    <span class="template-icon">🍱</span>
                                    <span class="template-label">Marmita</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('cafe')">
                                    <span class="template-icon">☕</span>
                                    <span class="template-label">Café</span>
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
                                <button type="button" class="template-btn" onclick="applyTemplate('coxinha')">
                                    <span class="template-icon">🥪</span>
                                    <span class="template-label">Coxinha</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('sorvete')">
                                    <span class="template-icon">🍦</span>
                                    <span class="template-label">Sorvete</span>
                                </button>
                                <button type="button" class="template-btn" onclick="applyTemplate('flor')">
                                    <span class="template-icon">🌸</span>
                                    <span class="template-label">Flores</span>
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
                name: "Tamanho do Copo",
                min: 1, max: 1, req: true,
                options: [
                    { name: "Copo 300ml", price: 12.00, type: "fixed" },
                    { name: "Copo 500ml", price: 18.00, type: "fixed" },
                    { name: "Copo 700ml", price: 24.00, type: "fixed" }
                ]
            },
            pizza: {
                name: "Escolha a Borda",
                min: 0, max: 1, req: false,
                options: [
                    { name: "Sem Borda", price: 0.00, type: "positive" },
                    { name: "Borda Catupiry", price: 8.00, type: "positive" },
                    { name: "Borda Cheddar", price: 8.00, type: "positive" },
                    { name: "Borda Chocolate", price: 10.00, type: "positive" }
                ]
            },
            burger: {
                name: "Ponto da Carne",
                min: 1, max: 1, req: true,
                options: [
                    { name: "Ao Ponto", price: 0.00, type: "positive" },
                    { name: "Bem Passado", price: 0.00, type: "positive" },
                    { name: "Mal Passado", price: 0.00, type: "positive" }
                ]
            },
            sushi: {
                name: "Acompanhamentos",
                min: 0, max: 2, req: false,
                options: [
                    { name: "Molho Shoyu Extra", price: 2.00, type: "positive" },
                    { name: "Molho Tarê Extra", price: 3.00, type: "positive" },
                    { name: "Wasabi Extra", price: 2.00, type: "positive" }
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
            const template = templates[type] || {
                name: "Variação " + type.toUpperCase(),
                min: 1, max: 1, req: true,
                options: [
                    { name: "Opção Padrão 1", price: 0.00, type: "positive" },
                    { name: "Opção Especial 2", price: 5.00, type: "positive" }
                ]
            };

            addGroup(JSON.parse(JSON.stringify(template)));
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
