<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar tenant</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'tenants'; require __DIR__ . '/../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
        <header class="backoffice-topbar">
            <div class="backoffice-brand">
                <span class="backoffice-kicker">Tenant</span>
                <h1 class="backoffice-title">Editar tenant</h1>
                <p class="backoffice-subtitle">Ajuste os dados cadastrais do tenant selecionado em um fluxo pensado primeiro para mobile.</p>
            </div>
            <div class="backoffice-actions">
                <a class="bo-link bo-link-secondary" href="/admin/tenants">Voltar para tenants</a>
            </div>
        </header>

        <section class="bo-panel">
            <h2 class="bo-section-title">Status do tenant</h2>
            <div class="bo-stats-grid" style="margin-bottom: 20px;">
                <div class="bo-stat">
                    <strong>Status atual</strong>
                    <?php $status = (string) ($tenant['status'] ?? 'n/d'); ?>
                    <span class="bo-badge bo-badge-<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(ucfirst($status), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="bo-stat">
                    <strong>Plano atual</strong>
                    <span><?= htmlspecialchars((string) ($tenant['plano'] ?? 'n/d'), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="bo-stat">
                    <strong>Slug publico</strong>
                    <span>/<?= htmlspecialchars((string) ($tenant['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="bo-stat">
                    <strong>Timezone</strong>
                    <span><?= htmlspecialchars((string) ($tenant['timezone'] ?? 'n/d'), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="bo-stat">
                    <strong>Painel de acesso</strong>
                    <span><?= htmlspecialchars('/' . (string) ($tenant['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            </div>

            <h2 class="bo-section-title">Dados do tenant</h2>
            <?php if (!empty($success)): ?>
                <div class="bo-alert bo-alert-success"><?= htmlspecialchars((string) $success, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="bo-alert bo-alert-error">
                    <strong>Corrija os campos abaixo:</strong>
                    <ul class="bo-list-errors">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/editar">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                <div class="bo-form-grid bo-form-grid-4">
                    <label class="bo-field">
                        Nome
                        <input name="nome" value="<?= htmlspecialchars((string) ($tenant['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label class="bo-field">
                        Slug
                        <input name="slug" value="<?= htmlspecialchars((string) ($tenant['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label class="bo-field">
                        WhatsApp
                        <input name="whatsapp" value="<?= htmlspecialchars((string) ($tenant['whatsapp'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label class="bo-field">
                        Cidade
                        <input name="cidade" value="<?= htmlspecialchars((string) ($tenant['cidade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label class="bo-field">
                        UF
                        <input name="uf" maxlength="2" value="<?= htmlspecialchars((string) ($tenant['uf'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label class="bo-field">
                        Timezone
                        <input name="timezone" value="<?= htmlspecialchars((string) ($tenant['timezone'] ?? 'America/Sao_Paulo'), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label class="bo-field">
                        Status
                        <select name="status">
                            <?php foreach (['ativo' => 'Ativo', 'bloqueado' => 'Bloqueado', 'cancelado' => 'Cancelado'] as $value => $label): ?>
                                <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= (($tenant['status'] ?? 'ativo') === $value) ? 'selected' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="bo-field">
                        Plano
                        <input name="plano" value="<?= htmlspecialchars((string) ($tenant['plano'] ?? 'mvp'), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                </div>

                <div class="bo-form-actions">
                    <button class="bo-btn bo-btn-primary" type="submit">Salvar alteracoes</button>
                    <?php if (($tenant['status'] ?? 'ativo') !== 'ativo'): ?>
                        <button class="bo-btn bo-btn-secondary" type="submit" formaction="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/ativar">Ativar tenant</button>
                    <?php else: ?>
                        <button class="bo-btn bo-btn-secondary" type="submit" formaction="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/bloquear">Bloquear tenant</button>
                    <?php endif; ?>
                    <a class="bo-link bo-link-secondary" href="/<?= htmlspecialchars((string) ($tenant['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noreferrer">Abrir tenant</a>
                </div>
            </form>
        </section>

        <section class="bo-panel" style="margin-top: 18px;">
            <h2 class="bo-section-title">Definir plano</h2>
            <form method="post" action="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/plano">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-form-grid">
                    <label class="bo-field">
                        Plano do tenant
                        <select name="plano">
                            <?php foreach (['mvp' => 'MVP', 'starter' => 'Starter', 'pro' => 'Pro', 'enterprise' => 'Enterprise'] as $value => $label): ?>
                                <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= (($tenant['plano'] ?? 'mvp') === $value) ? 'selected' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                <div class="bo-form-actions">
                    <button class="bo-btn bo-btn-primary" type="submit">Salvar plano</button>
                </div>
            </form>
        </section>

        <section class="bo-panel" style="margin-top: 18px;">
            <h2 class="bo-section-title">Criar admin do tenant</h2>

            <?php if (!empty($adminErrors)): ?>
                <div class="bo-alert bo-alert-error">
                    <strong>Corrija os campos abaixo:</strong>
                    <ul class="bo-list-errors">
                        <?php foreach ($adminErrors as $error): ?>
                            <li><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/admin">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                <div class="bo-form-grid">
                    <label class="bo-field">
                        Nome do admin
                        <input name="admin_nome" value="<?= htmlspecialchars((string) ($adminForm['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label class="bo-field">
                        Usuario
                        <input name="admin_usuario" value="<?= htmlspecialchars((string) ($adminForm['usuario'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label class="bo-field">
                        Senha inicial
                        <input name="admin_senha" type="password" value="<?= htmlspecialchars((string) ($adminForm['senha'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                </div>

                <div class="bo-form-actions">
                    <button class="bo-btn bo-btn-primary" type="submit">Criar admin</button>
                </div>
            </form>
        </section>
            </div>
        </div>
    </main>
</body>
</html>
