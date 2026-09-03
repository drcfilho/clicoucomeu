<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horários de Funcionamento - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'horarios'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Operação</span>
                        <h1 class="backoffice-title">Horários de Funcionamento</h1>
                        <p class="backoffice-subtitle">Configure os horários semanais ou faça o fechamento/abertura manual da loja.</p>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <!-- Status Atual e Pausa Manual -->
                <section class="bo-panel" style="margin-bottom: 24px; background: #ffffff;">
                    <h2 class="bo-section-title">Status da Loja em Tempo Real</h2>
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap; padding: 10px 0;">
                        <div>
                            <?php if ($status['is_open']): ?>
                                <span style="background: var(--bo-success-bg); color: var(--bo-success); padding: 6px 14px; border-radius: 20px; font-weight: 800; font-size: 1rem; display: inline-flex; align-items: center; gap: 6px;">
                                    ● Aberto Agora
                                </span>
                            <?php else: ?>
                                <span style="background: var(--bo-danger-bg); color: var(--bo-danger); padding: 6px 14px; border-radius: 20px; font-weight: 800; font-size: 1rem; display: inline-flex; align-items: center; gap: 6px;">
                                    ● Fechado
                                </span>
                            <?php endif; ?>
                            <p style="margin: 8px 0 0; color: var(--bo-muted); font-size: 0.94rem;"><?= htmlspecialchars((string) $status['message'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>

                        <form method="post" action="/painel/horarios/manual" style="display: flex; gap: 10px; align-items: center;">
                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                            <?php if ($status['manual_override']): ?>
                                <input type="hidden" name="forcar_fechamento" value="0">
                                <button type="submit" class="bo-link bo-link-primary">Reabrir Loja Agora</button>
                            <?php else: ?>
                                <input type="hidden" name="forcar_fechamento" value="1">
                                <button type="submit" class="bo-link bo-link-danger">Pausar Vendas Manualmente (Fechar)</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </section>

                <!-- Grade Semanal -->
                <section class="bo-panel">
                    <h2 class="bo-section-title">Grade Semanal de Abertura e Fechamento</h2>
                    <form method="post" action="/painel/horarios">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                        <div style="display: grid; gap: 16px; margin-top: 16px;">
                            <?php foreach ($schedule as $day => $info): ?>
                                <div style="display: grid; grid-template-columns: 140px 1fr 1fr 120px; gap: 14px; align-items: center; padding: 12px; border-bottom: 1px solid var(--bo-line);">
                                    <strong style="font-size: 0.98rem;"><?= htmlspecialchars((string) $info['nome_dia'], ENT_QUOTES, 'UTF-8') ?></strong>
                                    
                                    <label class="bo-field" style="margin:0;">
                                        Abertura
                                        <input type="time" name="dias[<?= (int)$day ?>][abertura]" value="<?= htmlspecialchars((string)$info['abertura'], ENT_QUOTES, 'UTF-8') ?>">
                                    </label>
                                    
                                    <label class="bo-field" style="margin:0;">
                                        Fechamento
                                        <input type="time" name="dias[<?= (int)$day ?>][fechamento]" value="<?= htmlspecialchars((string)$info['fechamento'], ENT_QUOTES, 'UTF-8') ?>">
                                    </label>

                                    <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px; margin:0; justify-content: flex-end;">
                                        <input type="checkbox" name="dias[<?= (int)$day ?>][ativo]" value="1" <?= $info['ativo'] ? 'checked' : '' ?>>
                                        Abre
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div style="margin-top: 24px; text-align: right;">
                            <button type="submit" class="bo-link bo-link-primary">Salvar Horários Semanais</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
</body>
</html>
