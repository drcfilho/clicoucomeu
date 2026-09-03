<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenants</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f4f1ea; color: #1e1a16; }
        main { padding: 32px 20px 48px; max-width: 1100px; margin: 0 auto; }
        .topbar { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
        .actions { display: flex; gap: 12px; flex-wrap: wrap; }
        a { display: inline-flex; align-items: center; justify-content: center; min-height: 42px; padding: 0 16px; border-radius: 999px; text-decoration: none; }
        .primary { background: #1e1a16; color: #fffdf8; }
        .secondary { border: 1px solid #c9b89d; color: #5c4830; }
        .grid { display: grid; gap: 16px; }
        .card { background: #fffdf8; border: 1px solid #e6dccd; border-radius: 18px; padding: 18px; }
        .head { display: flex; justify-content: space-between; gap: 12px; align-items: center; flex-wrap: wrap; }
        .slug { color: #7f6a52; font-size: 0.95rem; }
        .meta { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 12px; }
        .chip { padding: 6px 10px; border-radius: 999px; background: #f0e7da; font-size: 0.9rem; }
        .chip.status-ativo { background: #dff4e4; color: #215c30; }
        .chip.status-bloqueado { background: #fde7d6; color: #8a4a1a; }
        .chip.status-cancelado { background: #f4d9dc; color: #8d2934; }
        .empty { background: #fffdf8; border: 1px dashed #cfbea6; border-radius: 18px; padding: 28px; }
        .panel { background: #fffdf8; border: 1px solid #e6dccd; border-radius: 18px; padding: 20px; margin-bottom: 20px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; }
        label { display: grid; gap: 6px; font-size: 0.95rem; }
        input, select { min-height: 42px; border: 1px solid #cfbea6; border-radius: 12px; padding: 0 12px; background: #fff; }
        .submit-row { margin-top: 16px; display: flex; gap: 12px; flex-wrap: wrap; }
        .alert { border-radius: 14px; padding: 14px 16px; margin-bottom: 16px; }
        .alert-success { background: #dff4e4; color: #215c30; }
        .alert-error { background: #f9e1e4; color: #862634; }
        .error-list { margin: 0; padding-left: 18px; }
    </style>
</head>
<body>
    <main>
        <div class="topbar">
            <div>
                <h1>Tenants</h1>
                <p>Listagem inicial da area de superadmin.</p>
            </div>
            <div class="actions">
                <a class="secondary" href="/admin">Voltar</a>
                <a class="primary" href="/admin/tenants">Atualizar</a>
            </div>
        </div>

        <section class="panel">
            <h2>Criar tenant</h2>

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

            <form method="post" action="/admin/tenants">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                <div class="form-grid">
                    <label>
                        Nome
                        <input name="nome" value="<?= htmlspecialchars((string) ($form['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Slug
                        <input name="slug" value="<?= htmlspecialchars((string) ($form['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        WhatsApp
                        <input name="whatsapp" value="<?= htmlspecialchars((string) ($form['whatsapp'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label>
                        Cidade
                        <input name="cidade" value="<?= htmlspecialchars((string) ($form['cidade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label>
                        UF
                        <input name="uf" maxlength="2" value="<?= htmlspecialchars((string) ($form['uf'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label>
                        Timezone
                        <input name="timezone" value="<?= htmlspecialchars((string) ($form['timezone'] ?? 'America/Sao_Paulo'), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Status
                        <select name="status">
                            <?php foreach (['ativo' => 'Ativo', 'bloqueado' => 'Bloqueado', 'cancelado' => 'Cancelado'] as $value => $label): ?>
                                <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= (($form['status'] ?? 'ativo') === $value) ? 'selected' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        Plano
                        <input name="plano" value="<?= htmlspecialchars((string) ($form['plano'] ?? 'mvp'), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                </div>

                <div class="submit-row">
                    <button class="primary" type="submit">Criar tenant</button>
                </div>
            </form>
        </section>

        <?php if ($tenants === []): ?>
            <div class="empty">
                <strong>Nenhum tenant encontrado.</strong>
            </div>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($tenants as $tenant): ?>
                    <?php $status = (string) ($tenant['status'] ?? 'ativo'); ?>
                    <article class="card">
                        <div class="head">
                            <div>
                                <h2><?= htmlspecialchars((string) $tenant['nome'], ENT_QUOTES, 'UTF-8') ?></h2>
                                <div class="slug">/<?= htmlspecialchars((string) $tenant['slug'], ENT_QUOTES, 'UTF-8') ?></div>
                            </div>
                            <span class="chip status-<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars(ucfirst($status), ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </div>
                        <div class="meta">
                            <span class="chip">Plano: <?= htmlspecialchars((string) ($tenant['plano'] ?? 'n/d'), ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="chip">Cidade: <?= htmlspecialchars(trim(((string) ($tenant['cidade'] ?? '')) . ' ' . ((string) ($tenant['uf'] ?? ''))), ENT_QUOTES, 'UTF-8') ?: 'n/d' ?></span>
                            <span class="chip">Criado em: <?= htmlspecialchars((string) ($tenant['criado_em'] ?? 'n/d'), ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
