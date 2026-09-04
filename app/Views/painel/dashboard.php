<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel - Visão Geral</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
    <style>
        .bo-filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            background: rgba(255, 253, 248, 0.86);
            border: 1px solid rgba(229, 216, 196, 0.95);
            border-radius: 16px;
            padding: 12px 16px;
            margin-bottom: 20px;
            box-shadow: var(--bo-shadow);
        }
        .bo-filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .bo-select, .bo-input-date {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--bo-line);
            background: var(--bo-surface-strong);
            font-size: 0.9rem;
        }
        .bo-dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .bo-card-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        .bo-card-table th, .bo-card-table td {
            padding: 8px 10px;
            text-align: left;
            border-bottom: 1px solid var(--bo-line);
        }
        .bo-card-table th {
            color: var(--bo-muted);
            font-weight: 600;
        }
        .bo-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
            background: var(--bo-primary-soft);
            color: var(--bo-text);
        }
    </style>
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'painel'; require __DIR__ . '/../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Painel</span>
                        <h1 class="backoffice-title">Visão Geral da Operação</h1>
                        <p class="backoffice-subtitle">Métricas de vendas, pedidos e desempenho do restaurante.</p>
                    </div>
                    <div class="backoffice-actions">
                        <a class="bo-link bo-link-secondary" href="/cozinha">Ir para cozinha 🍳</a>
                        <a class="bo-link bo-link-primary" href="/painel/pedidos">Gerenciar Pedidos 🚨</a>
                    </div>
                </header>

                <?php require __DIR__ . '/../partials/flash-messages.php'; ?>

                <?php if (!empty($showOnboarding)): ?>
                    <section class="bo-panel" style="margin-bottom: 20px; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: #fff; border: 1px solid rgba(255,255,255,0.1);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                            <div>
                                <h2 style="margin: 0; font-size: 1.15rem; font-weight: 700; color: #f8fafc; display: flex; align-items: center; gap: 8px;">
                                    🚀 Configuração Inicial do Cardápio
                                </h2>
                                <p style="margin: 4px 0 0 0; color: #94a3b8; font-size: 0.85rem;">Conclua estes 4 passos simples para deixar seu cardápio online pronto para receber pedidos.</p>
                            </div>
                            <div style="background: rgba(255,255,255,0.1); padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; color: #38bdf8;">
                                <?= (int) ($completedOnboardingCount ?? 0) ?> de 4 concluídos
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin-top: 16px;">
                            <a href="<?= htmlspecialchars(($tenantPrefix ?? '') . '/painel/categorias', ENT_QUOTES, 'UTF-8') ?>" style="display: flex; align-items: center; gap: 10px; padding: 12px; border-radius: 10px; background: <?= !empty($onboardingSteps['categorias']) ? 'rgba(34, 197, 94, 0.15)' : 'rgba(255, 255, 255, 0.05)' ?>; border: 1px solid <?= !empty($onboardingSteps['categorias']) ? 'rgba(34, 197, 94, 0.4)' : 'rgba(255, 255, 255, 0.1)' ?>; text-decoration: none; color: inherit;">
                                <span style="font-size: 1.2rem;"><?= !empty($onboardingSteps['categorias']) ? '✅' : '📁' ?></span>
                                <div>
                                    <strong style="display: block; font-size: 0.88rem; color: <?= !empty($onboardingSteps['categorias']) ? '#4ade80' : '#f8fafc' ?>;">1. Categorias</strong>
                                    <span style="font-size: 0.75rem; color: #94a3b8;"><?= !empty($onboardingSteps['categorias']) ? 'Cadastradas' : 'Criar primeira categoria' ?></span>
                                </div>
                            </a>

                            <a href="<?= htmlspecialchars(($tenantPrefix ?? '') . '/painel/produtos', ENT_QUOTES, 'UTF-8') ?>" style="display: flex; align-items: center; gap: 10px; padding: 12px; border-radius: 10px; background: <?= !empty($onboardingSteps['produtos']) ? 'rgba(34, 197, 94, 0.15)' : 'rgba(255, 255, 255, 0.05)' ?>; border: 1px solid <?= !empty($onboardingSteps['produtos']) ? 'rgba(34, 197, 94, 0.4)' : 'rgba(255, 255, 255, 0.1)' ?>; text-decoration: none; color: inherit;">
                                <span style="font-size: 1.2rem;"><?= !empty($onboardingSteps['produtos']) ? '✅' : '🍔' ?></span>
                                <div>
                                    <strong style="display: block; font-size: 0.88rem; color: <?= !empty($onboardingSteps['produtos']) ? '#4ade80' : '#f8fafc' ?>;">2. Produtos</strong>
                                    <span style="font-size: 0.75rem; color: #94a3b8;"><?= !empty($onboardingSteps['produtos']) ? 'Cadastrados' : 'Cadastrar produtos' ?></span>
                                </div>
                            </a>

                            <a href="<?= htmlspecialchars(($tenantPrefix ?? '') . '/painel/bairros', ENT_QUOTES, 'UTF-8') ?>" style="display: flex; align-items: center; gap: 10px; padding: 12px; border-radius: 10px; background: <?= !empty($onboardingSteps['bairros']) ? 'rgba(34, 197, 94, 0.15)' : 'rgba(255, 255, 255, 0.05)' ?>; border: 1px solid <?= !empty($onboardingSteps['bairros']) ? 'rgba(34, 197, 94, 0.4)' : 'rgba(255, 255, 255, 0.1)' ?>; text-decoration: none; color: inherit;">
                                <span style="font-size: 1.2rem;"><?= !empty($onboardingSteps['bairros']) ? '✅' : '🛵' ?></span>
                                <div>
                                    <strong style="display: block; font-size: 0.88rem; color: <?= !empty($onboardingSteps['bairros']) ? '#4ade80' : '#f8fafc' ?>;">3. Bairros & Taxas</strong>
                                    <span style="font-size: 0.75rem; color: #94a3b8;"><?= !empty($onboardingSteps['bairros']) ? 'Configurados' : 'Definir taxas de entrega' ?></span>
                                </div>
                            </a>

                            <a href="<?= htmlspecialchars(($tenantPrefix ?? '') . '/painel/horarios', ENT_QUOTES, 'UTF-8') ?>" style="display: flex; align-items: center; gap: 10px; padding: 12px; border-radius: 10px; background: <?= !empty($onboardingSteps['horarios']) ? 'rgba(34, 197, 94, 0.15)' : 'rgba(255, 255, 255, 0.05)' ?>; border: 1px solid <?= !empty($onboardingSteps['horarios']) ? 'rgba(34, 197, 94, 0.4)' : 'rgba(255, 255, 255, 0.1)' ?>; text-decoration: none; color: inherit;">
                                <span style="font-size: 1.2rem;"><?= !empty($onboardingSteps['horarios']) ? '✅' : '⏰' ?></span>
                                <div>
                                    <strong style="display: block; font-size: 0.88rem; color: <?= !empty($onboardingSteps['horarios']) ? '#4ade80' : '#f8fafc' ?>;">4. Horários</strong>
                                    <span style="font-size: 0.75rem; color: #94a3b8;"><?= !empty($onboardingSteps['horarios']) ? 'Definidos' : 'Definir funcionamento' ?></span>
                                </div>
                            </a>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Filtro por Período -->
                <form method="GET" action="/painel" class="bo-filter-bar">
                    <div class="bo-filter-group">
                        <label for="period"><strong>Período:</strong></label>
                        <select name="period" id="period" class="bo-select" onchange="toggleCustomDates(this.value)">
                            <option value="hoje" <?= $period === 'hoje' ? 'selected' : '' ?>>Hoje</option>
                            <option value="7dias" <?= $period === '7dias' ? 'selected' : '' ?>>Últimos 7 dias</option>
                            <option value="30dias" <?= $period === '30dias' ? 'selected' : '' ?>>Últimos 30 dias</option>
                            <option value="todos" <?= $period === 'todos' ? 'selected' : '' ?>>Todo o histórico</option>
                            <option value="personalizado" <?= $period === 'personalizado' ? 'selected' : '' ?>>Personalizado</option>
                        </select>
                    </div>

                    <div id="custom-dates" class="bo-filter-group" style="display: <?= $period === 'personalizado' ? 'flex' : 'none' ?>;">
                        <input type="date" name="start_date" value="<?= htmlspecialchars($startDate ?? '', ENT_QUOTES, 'UTF-8') ?>" class="bo-input-date">
                        <span>até</span>
                        <input type="date" name="end_date" value="<?= htmlspecialchars($endDate ?? '', ENT_QUOTES, 'UTF-8') ?>" class="bo-input-date">
                    </div>

                    <button type="submit" class="bo-link bo-link-secondary" style="padding: 6px 14px; font-size: 0.85rem;">Filtrar</button>
                </form>

                <!-- Cards de Métricas Principais -->
                <section class="bo-stats-grid">
                    <article class="bo-stat">
                        <strong>Pedidos no Período</strong>
                        <span><?= htmlspecialchars((string) ($metrics['orders_count'] ?? 0), ENT_QUOTES, 'UTF-8') ?></span>
                    </article>
                    <article class="bo-stat">
                        <strong>Faturamento Total</strong>
                        <span>R$ <?= number_format((float) ($metrics['total_revenue'] ?? 0), 2, ',', '.') ?></span>
                    </article>
                    <article class="bo-stat">
                        <strong>Ticket Médio</strong>
                        <span>R$ <?= number_format((float) ($metrics['average_ticket'] ?? 0), 2, ',', '.') ?></span>
                    </article>
                    <article class="bo-stat" style="border-left: 4px solid #e67e22;">
                        <strong>Pedidos Abertos Agora</strong>
                        <span><?= htmlspecialchars((string) ($metrics['open_orders'] ?? 0), ENT_QUOTES, 'UTF-8') ?></span>
                    </article>
                </section>

                <!-- Gráficos/Tabelas Informativas -->
                <div class="bo-dashboard-grid">
                    <!-- Produtos mais vendidos -->
                    <section class="bo-panel">
                        <h2 class="bo-section-title">🏆 Top Produtos Mais Vendidos</h2>
                        <?php if (empty($topProducts)): ?>
                            <p class="bo-section-text">Nenhum produto vendido no período selecionado.</p>
                        <?php else: ?>
                            <table class="bo-card-table">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Qtd</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($topProducts as $prod): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($prod['nome'], ENT_QUOTES, 'UTF-8') ?></strong></td>
                                            <td><span class="bo-badge"><?= (int) $prod['total_qtd'] ?>x</span></td>
                                            <td>R$ <?= number_format((float) $prod['total_valor'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </section>

                    <!-- Formas de Pagamento -->
                    <section class="bo-panel">
                        <h2 class="bo-section-title">💳 Formas de Pagamento</h2>
                        <?php if (empty($paymentMethods)): ?>
                            <p class="bo-section-text">Nenhum pagamento registrado no período.</p>
                        <?php else: ?>
                            <table class="bo-card-table">
                                <thead>
                                    <tr>
                                        <th>Forma</th>
                                        <th>Pedidos</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($paymentMethods as $pay): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars(ucfirst($pay['forma_pagamento']), ENT_QUOTES, 'UTF-8') ?></strong></td>
                                            <td><?= (int) $pay['qtd'] ?></td>
                                            <td>R$ <?= number_format((float) $pay['valor_total'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </section>

                    <!-- Bairros Mais Frequentes -->
                    <section class="bo-panel">
                        <h2 class="bo-section-title">📍 Bairros Mais Atendidos</h2>
                        <?php if (empty($topNeighborhoods)): ?>
                            <p class="bo-section-text">Nenhuma entrega registrada no período.</p>
                        <?php else: ?>
                            <table class="bo-card-table">
                                <thead>
                                    <tr>
                                        <th>Bairro</th>
                                        <th>Entregas</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($topNeighborhoods as $neigh): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($neigh['bairro'], ENT_QUOTES, 'UTF-8') ?></strong></td>
                                            <td><?= (int) $neigh['qtd'] ?></td>
                                            <td>R$ <?= number_format((float) $neigh['valor_total'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleCustomDates(value) {
            const container = document.getElementById('custom-dates');
            if (value === 'personalizado') {
                container.style.display = 'flex';
            } else {
                container.style.display = 'none';
            }
        }
    </script>
</body>
</html>
