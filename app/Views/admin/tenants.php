<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenants</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'tenants'; require __DIR__ . '/../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
        <section class="backoffice-topbar">
            <div class="backoffice-brand">
                <span class="backoffice-kicker">Superadmin</span>
                <h1 class="backoffice-title">Tenants</h1>
                <p class="backoffice-subtitle">Listagem inicial da area de superadmin, otimizada primeiro para telas menores.</p>
            </div>
            <div class="backoffice-actions">
                <a class="bo-link bo-link-secondary" href="/admin">Voltar</a>
                <a class="bo-link bo-link-primary" href="/admin/tenants">Atualizar</a>
            </div>
        </section>

        <section class="bo-panel">
            <h2 class="bo-section-title">Criar tenant</h2>

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

            <form method="post" action="/admin/tenants">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                <div class="bo-form-grid bo-form-grid-4">
                    <label class="bo-field">
                        Nome
                        <input name="nome" value="<?= htmlspecialchars((string) ($form['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label class="bo-field">
                        Slug
                        <input name="slug" value="<?= htmlspecialchars((string) ($form['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label class="bo-field">
                        WhatsApp
                        <input name="whatsapp" value="<?= htmlspecialchars((string) ($form['whatsapp'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label class="bo-field">
                        Cidade
                        <input name="cidade" value="<?= htmlspecialchars((string) ($form['cidade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label class="bo-field">
                        UF
                        <input name="uf" maxlength="2" value="<?= htmlspecialchars((string) ($form['uf'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <label class="bo-field">
                        Timezone
                        <input name="timezone" value="<?= htmlspecialchars((string) ($form['timezone'] ?? 'America/Sao_Paulo'), ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label class="bo-field">
                        Status
                        <select name="status">
                            <?php foreach (['ativo' => 'Ativo', 'bloqueado' => 'Bloqueado', 'cancelado' => 'Cancelado'] as $value => $label): ?>
                                <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= (($form['status'] ?? 'ativo') === $value) ? 'selected' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="bo-field">
                        Plano
                        <select name="plano">
                            <?php foreach (['mvp' => 'MVP', 'starter' => 'Starter', 'pro' => 'Pro', 'enterprise' => 'Enterprise'] as $value => $label): ?>
                                <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= (($form['plano'] ?? 'mvp') === $value) ? 'selected' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <div class="bo-form-actions">
                    <button class="bo-btn bo-btn-primary" type="submit">Criar tenant</button>
                </div>
            </form>
        </section>

        <?php if ($tenants === []): ?>
            <div class="bo-empty">
                <strong>Nenhum tenant encontrado.</strong>
            </div>
        <?php else: ?>
            <section class="bo-cards-grid">
                <?php foreach ($tenants as $tenant): ?>
                    <?php $status = (string) ($tenant['status'] ?? 'ativo'); ?>
                    <article class="bo-card">
                        <div class="backoffice-topbar" style="margin-bottom: 0;">
                            <div>
                                <h2 class="bo-card-title"><?= htmlspecialchars((string) $tenant['nome'], ENT_QUOTES, 'UTF-8') ?></h2>
                                <p class="bo-card-text">/<?= htmlspecialchars((string) $tenant['slug'], ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                            <span class="bo-badge bo-badge-<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars(ucfirst($status), ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </div>
                        <div class="bo-meta-row">
                            <span class="bo-chip">Plano: <?= htmlspecialchars((string) ($tenant['plano'] ?? 'n/d'), ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="bo-chip">Cidade: <?= htmlspecialchars(trim(((string) ($tenant['cidade'] ?? '')) . ' ' . ((string) ($tenant['uf'] ?? ''))), ENT_QUOTES, 'UTF-8') ?: 'n/d' ?></span>
                            <span class="bo-chip">Criado em: <?= htmlspecialchars((string) ($tenant['criado_em'] ?? 'n/d'), ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <div class="bo-form-actions">
                            <a class="bo-link bo-link-secondary" href="/admin/tenants/<?= (int) $tenant['id'] ?>/editar">Editar</a>
                            <?php if ($status !== 'ativo'): ?>
                                <form class="bo-inline-form" method="post" action="/admin/tenants/<?= (int) $tenant['id'] ?>/ativar">
                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                    <button class="bo-btn bo-btn-primary" type="submit">Ativar</button>
                                </form>
                            <?php else: ?>
                                <form class="bo-inline-form" method="post" action="/admin/tenants/<?= (int) $tenant['id'] ?>/bloquear">
                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                    <button class="bo-btn bo-btn-secondary" type="submit">Bloquear</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
