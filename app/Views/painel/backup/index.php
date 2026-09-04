<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exportação e Backup dos Dados — Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'tenant_backup'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">LGPD & Segurança</span>
                        <h1 class="backoffice-title">📦 Backup & Exportação do Cardápio</h1>
                        <p class="backoffice-subtitle">Baixe uma cópia de segurança completa do seu restaurante incluindo produtos, categorias, adicionais e pedidos.</p>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <div class="bo-panel" style="max-width: 650px; margin-top: 10px;">
                    <h2 class="bo-section-title" style="margin-bottom: 8px;">📑 Exportação de Dados em JSON</h2>
                    <p style="color: var(--bo-muted); font-size: 0.9rem; margin-bottom: 20px;">
                        Gera um arquivo `.json` proprietário que armazena toda a estrutura de produtos, adicionais, bairros e pedidos do seu estabelecimento. Este arquivo pode ser guardado no seu computador para backup ou migrações.
                    </p>

                    <form method="POST" action="<?= htmlspecialchars(url('painel/backup/export-json'), ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" class="bo-link bo-link-primary" style="font-size: 0.95rem; padding: 12px 24px;">
                            💾 Baixar Backup do Restaurante (.JSON)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
