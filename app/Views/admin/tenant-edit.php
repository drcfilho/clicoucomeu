<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar tenant</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f4f1ea; color: #1e1a16; }
        main { padding: 32px 20px 48px; max-width: 980px; margin: 0 auto; }
        .topbar { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
        .actions { display: flex; gap: 12px; flex-wrap: wrap; }
        a, button { display: inline-flex; align-items: center; justify-content: center; min-height: 42px; padding: 0 16px; border-radius: 999px; text-decoration: none; border: 0; }
        .primary { background: #1e1a16; color: #fffdf8; cursor: pointer; }
        .secondary { border: 1px solid #c9b89d; color: #5c4830; background: transparent; }
        .panel { background: #fffdf8; border: 1px solid #e6dccd; border-radius: 18px; padding: 20px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; }
        label { display: grid; gap: 6px; font-size: 0.95rem; }
        input, select { min-height: 42px; border: 1px solid #cfbea6; border-radius: 12px; padding: 0 12px; background: #fff; }
        .submit-row { margin-top: 16px; display: flex; gap: 12px; flex-wrap: wrap; }
        .alert { border-radius: 14px; padding: 14px 16px; margin-bottom: 16px; }
        .alert-success { background: #dff4e4; color: #215c30; }
        .alert-error { background: #f9e1e4; color: #862634; }
        .error-list { margin: 0; padding-left: 18px; }
        .status-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px; }
        .stat { border: 1px solid #e6dccd; border-radius: 16px; padding: 16px; background: #fff; }
        .stat strong { display: block; font-size: 1rem; margin-bottom: 6px; }
        .stat span { color: #5c4830; }
        .badge { display: inline-flex; align-items: center; min-height: 28px; padding: 0 10px; border-radius: 999px; font-weight: 700; }
        .badge-ativo { background: #dff4e4; color: #215c30; }
        .badge-bloqueado { background: #fde7d6; color: #8a4a1a; }
        .badge-cancelado { background: #f4d9dc; color: #8d2934; }
    </style>
</head>
<body>
    <main>
        <div class="topbar">
            <div>
                <h1>Editar tenant</h1>
                <p>Ajuste os dados cadastrais do tenant selecionado.</p>
            </div>
            <div class="actions">
                <a class="secondary" href="/admin/tenants">Voltar para tenants</a>
            </div>
        </div>

        <section class="panel">
            <h2>Status do tenant</h2>
            <div class="status-grid" style="margin-bottom: 20px;">
                <div class="stat">
                    <strong>Status atual</strong>
                    <?php $status = (string) ($tenant['status'] ?? 'n/d'); ?>
                    <span class="badge badge-<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(ucfirst($status), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="stat">
                    <strong>Plano atual</strong>
                    <span><?= htmlspecialchars((string) ($tenant['plano'] ?? 'n/d'), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="stat">
                    <strong>Slug publico</strong>
                    <span>/<?= htmlspecialchars((string) ($tenant['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="stat">
                    <strong>Timezone</strong>
                    <span><?= htmlspecialchars((string) ($tenant['timezone'] ?? 'n/d'), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="stat">
                    <strong>Painel de acesso</strong>
                    <span><?= htmlspecialchars('/' . (string) ($tenant['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            </div>

            <h2>Dados do tenant</h2>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars((string) $success, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <strong>Corrija os campos abaixo:</strong>
                    <ul class="error-list">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/editar">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                <div class="form-grid">
                    <label>
                        Nome
                        <input name="nome" value="<?= htmlspecialchars((string) ($tenant['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Slug
                        <input name="slug" value="<?= htmlspecialchars((string) ($tenant['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        WhatsApp
                        <input name="whatsapp" value="<?= htmlspecialchars((string) ($tenant['whatsapp'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label>
                        Cidade
                        <input name="cidade" value="<?= htmlspecialchars((string) ($tenant['cidade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label>
                        UF
                        <input name="uf" maxlength="2" value="<?= htmlspecialchars((string) ($tenant['uf'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label>
                        Timezone
                        <input name="timezone" value="<?= htmlspecialchars((string) ($tenant['timezone'] ?? 'America/Sao_Paulo'), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Status
                        <select name="status">
                            <?php foreach (['ativo' => 'Ativo', 'bloqueado' => 'Bloqueado', 'cancelado' => 'Cancelado'] as $value => $label): ?>
                                <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= (($tenant['status'] ?? 'ativo') === $value) ? 'selected' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        Plano
                        <input name="plano" value="<?= htmlspecialchars((string) ($tenant['plano'] ?? 'mvp'), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                </div>

                <div class="submit-row">
                    <button class="primary" type="submit">Salvar alteracoes</button>
                    <?php if (($tenant['status'] ?? 'ativo') !== 'ativo'): ?>
                        <button class="secondary" type="submit" formaction="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/ativar">Ativar tenant</button>
                    <?php else: ?>
                        <button class="secondary" type="submit" formaction="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/bloquear">Bloquear tenant</button>
                    <?php endif; ?>
                    <a class="secondary" href="/<?= htmlspecialchars((string) ($tenant['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noreferrer">Abrir tenant</a>
                </div>
            </form>
        </section>

        <section class="panel" style="margin-top: 18px;">
            <h2>Definir plano</h2>
            <form method="post" action="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/plano">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="form-grid">
                    <label>
                        Plano do tenant
                        <select name="plano">
                            <?php foreach (['mvp' => 'MVP', 'starter' => 'Starter', 'pro' => 'Pro', 'enterprise' => 'Enterprise'] as $value => $label): ?>
                                <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= (($tenant['plano'] ?? 'mvp') === $value) ? 'selected' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                <div class="submit-row">
                    <button class="primary" type="submit">Salvar plano</button>
                </div>
            </form>
        </section>

        <section class="panel" style="margin-top: 18px;">
            <h2>Criar admin do tenant</h2>

            <?php if (!empty($adminErrors)): ?>
                <div class="alert alert-error">
                    <strong>Corrija os campos abaixo:</strong>
                    <ul class="error-list">
                        <?php foreach ($adminErrors as $error): ?>
                            <li><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="/admin/tenants/<?= (int) ($tenant['id'] ?? 0) ?>/admin">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                <div class="form-grid">
                    <label>
                        Nome do admin
                        <input name="admin_nome" value="<?= htmlspecialchars((string) ($adminForm['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Usuario
                        <input name="admin_usuario" value="<?= htmlspecialchars((string) ($adminForm['usuario'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Senha inicial
                        <input name="admin_senha" type="password" value="<?= htmlspecialchars((string) ($adminForm['senha'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                </div>

                <div class="submit-row">
                    <button class="primary" type="submit">Criar admin</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
