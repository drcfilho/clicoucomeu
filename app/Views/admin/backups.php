<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciamento de Backups Globais — Superadmin</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'admin_backups'; require __DIR__ . '/../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Segurança e Desastre</span>
                        <h1 class="backoffice-title">🛡️ Central de Backups Globais</h1>
                        <p class="backoffice-subtitle">Gere e baixe cópias de segurança completas do banco de dados MySQL e dos arquivos de mídia enviados por todos os tenants.</p>
                    </div>
                </header>

                <?php require __DIR__ . '/../partials/flash-messages.php'; ?>

                <!-- Ações Rápidas de Backup -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px; margin-bottom: 24px;">
                    <div class="bo-panel" style="border-top: 4px solid var(--bo-primary);">
                        <h2 class="bo-section-title" style="margin-bottom: 8px;">🗄️ Banco de Dados (MySQL)</h2>
                        <p style="color: var(--bo-muted); font-size: 0.88rem; margin-bottom: 16px;">Gera um dump `.sql` completo contendo todas as tabelas, schemas e dados de todos os restaurantes.</p>
                        <form method="POST" action="/admin/backups/banco">
                            <input type="hidden" name="_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="bo-link bo-link-primary" style="width: 100%; text-align: center;">⚡ Baixar Dump do Banco (.SQL)</button>
                        </form>
                    </div>

                    <div class="bo-panel" style="border-top: 4px solid #3b82f6;">
                        <h2 class="bo-section-title" style="margin-bottom: 8px;">🖼️ Arquivos de Mídia (Uploads)</h2>
                        <p style="color: var(--bo-muted); font-size: 0.88rem; margin-bottom: 16px;">Compacta em `.zip` todas as fotos de produtos, logos e imagens enviadas por todos os estabelecimentos.</p>
                        <form method="POST" action="/admin/backups/uploads">
                            <input type="hidden" name="_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="bo-link" style="background: #3b82f6; color: #fff; width: 100%; text-align: center;">📦 Baixar Mídias (.ZIP)</button>
                        </form>
                    </div>
                </div>

                <!-- Histórico de Arquivos Salvos em Disco -->
                <section class="bo-panel">
                    <h2 class="bo-section-title" style="margin-bottom: 14px;">📂 Backups Armazenados no Servidor</h2>
                    <?php if (empty($files)): ?>
                        <p style="color: var(--bo-muted); font-size: 0.9rem;">Nenhum arquivo de backup foi gerado anteriormente.</p>
                    <?php else: ?>
                        <table class="bo-table">
                            <thead>
                                <tr>
                                    <th>Nome do Arquivo</th>
                                    <th>Tamanho</th>
                                    <th>Data de Criação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($files as $f): ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($f['name'], ENT_QUOTES, 'UTF-8') ?></strong></td>
                                        <td><?= htmlspecialchars($f['size'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($f['date'], ENT_QUOTES, 'UTF-8') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
