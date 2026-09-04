<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel Superadmin — Clicou Comeu</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'admin'; require __DIR__ . '/../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Plataforma SaaS</span>
                        <h1 class="backoffice-title">Central de Gestão Superadmin</h1>
                        <p class="backoffice-subtitle">Visão executiva de faturamento, novos restaurantes, trials e performance global.</p>
                    </div>
                    <div class="backoffice-actions">
                        <a class="bo-link bo-link-primary" href="/admin/tenants">Gerenciar Restaurantes (Tenants) 🏬</a>
                    </div>
                </header>

                <?php require __DIR__ . '/../partials/flash-messages.php'; ?>

                <!-- Cards de Métricas SaaS & MRR -->
                <section class="bo-stats-grid" style="margin-bottom: 24px;">
                    <article class="bo-stat" style="border-left: 4px solid #10b981;">
                        <strong>Receita Recorrente Mensal (MRR)</strong>
                        <span>R$ <?= number_format((float) ($metrics['mrr'] ?? 0), 2, ',', '.') ?></span>
                    </article>

                    <article class="bo-stat">
                        <strong>Receita Anual Projetada (ARR)</strong>
                        <span>R$ <?= number_format((float) ($metrics['arr'] ?? 0), 2, ',', '.') ?></span>
                    </article>

                    <article class="bo-stat" style="border-left: 4px solid #3b82f6;">
                        <strong>Restaurantes Ativos</strong>
                        <span><?= (int) ($metrics['active_tenants'] ?? 0) ?> de <?= (int) ($metrics['total_tenants'] ?? 0) ?></span>
                    </article>

                    <article class="bo-stat" style="border-left: 4px solid #f59e0b;">
                        <strong>Em Degustação (7 Dias)</strong>
                        <span><?= (int) ($metrics['trials_count'] ?? 0) ?> restaurantes</span>
                    </article>
                </section>

                <!-- Distribuição de Planos -->
                <section class="bo-panel" style="margin-bottom: 24px;">
                    <h2 class="bo-section-title">📊 Distribuição de Assinaturas de Planos</h2>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 16px;">
                        <?php 
                        $plans = [
                            'mvp' => ['label' => 'MVP / Degustação', 'color' => '#f59e0b'],
                            'starter' => ['label' => 'Starter (R$ 49)', 'color' => '#3b82f6'],
                            'pro' => ['label' => 'Pro (R$ 99)', 'color' => '#10b981'],
                            'enterprise' => ['label' => 'Enterprise', 'color' => '#6366f1'],
                        ];
                        foreach ($plans as $key => $info):
                            $count = (int) ($metrics['plans_breakdown'][$key] ?? 0);
                        ?>
                            <div style="padding: 16px; border-radius: 12px; background: rgba(255,255,255,0.05); border: 1px solid var(--bo-line);">
                                <span style="font-size: 0.8rem; font-weight: 700; color: <?= $info['color'] ?>; text-transform: uppercase;"><?= htmlspecialchars($info['label'], ENT_QUOTES, 'UTF-8') ?></span>
                                <div style="font-size: 1.6rem; font-weight: 900; margin-top: 4px;"><?= $count ?> restaurantes</div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- Atalhos de Impersonação / Acesso Rápido -->
                <section class="bo-panel">
                    <h2 class="bo-section-title">⚡ Acesso Rápido aos Restaurantes (Impersonação / Suporte)</h2>
                    <p style="color: var(--bo-muted); font-size: 0.9rem; margin-bottom: 16px;">Acesse instantaneamente o painel administrativo de qualquer restaurante para prestar suporte.</p>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.92rem;">
                            <thead>
                                <tr style="border-bottom: 1px solid var(--bo-line); text-align: left;">
                                    <th style="padding: 10px;">Restaurante</th>
                                    <th style="padding: 10px;">Link (Slug)</th>
                                    <th style="padding: 10px;">Plano</th>
                                    <th style="padding: 10px;">Status</th>
                                    <th style="padding: 10px; text-align: right;">Ação de Suporte</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tenants as $t): ?>
                                    <tr style="border-bottom: 1px solid var(--bo-line);">
                                        <td style="padding: 10px; font-weight: 700;"><?= htmlspecialchars((string) $t['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td style="padding: 10px; color: var(--bo-muted);">/<?= htmlspecialchars((string) $t['slug'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td style="padding: 10px;"><span class="bo-chip"><?= htmlspecialchars(strtoupper((string) ($t['plano'] ?? 'mvp')), ENT_QUOTES, 'UTF-8') ?></span></td>
                                        <td style="padding: 10px;">
                                            <span class="bo-badge bo-badge-<?= htmlspecialchars((string) ($t['status'] ?? 'ativo'), ENT_QUOTES, 'UTF-8') ?>">
                                                <?= htmlspecialchars(ucfirst((string) ($t['status'] ?? 'ativo')), ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </td>
                                        <td style="padding: 10px; text-align: right;">
                                            <a href="/admin/tenants/<?= (int) $t['id'] ?>/acessar" class="bo-btn bo-btn-primary" style="padding: 4px 10px; font-size: 0.8rem; text-decoration: none;">
                                                🔑 Entrar no Painel
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
