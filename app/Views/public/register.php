<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Minha Conta — Clicou Comeu</title>
    <style>
        :root {
            --primary: #e11d48;
            --primary-hover: #be123c;
            --body-bg: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #cbd5e1;
        }
        * { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            background-color: var(--body-bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px 16px;
        }
        .register-card {
            width: 100%;
            max-width: 520px;
            background: #ffffff;
            padding: 36px 32px;
            border-radius: 20px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.08), 0 0 1px rgba(0, 0, 0, 0.1);
        }
        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .brand-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), #f43f5e);
            border-radius: 14px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 1.5rem;
            margin: 0 auto 12px;
            box-shadow: 0 8px 16px rgba(225, 29, 72, 0.25);
        }
        .brand-header h1 {
            font-size: 1.6rem;
            font-weight: 800;
            margin: 0 0 6px;
            letter-spacing: -0.02em;
        }
        .brand-header p {
            color: var(--text-muted);
            font-size: 0.92rem;
            margin: 0;
        }
        .plan-badge {
            display: inline-block;
            background: rgba(225, 29, 72, 0.1);
            color: var(--primary);
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            margin-top: 8px;
            text-transform: uppercase;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #334155;
        }
        input, select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.95rem;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.15);
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .slug-preview {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 4px;
        }
        .btn-submit {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), #f43f5e);
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: 0 10px 20px -5px rgba(225, 29, 72, 0.4);
            margin-top: 10px;
            transition: transform 0.1s, background-color 0.2s;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
        }
        .error-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 0.88rem;
            margin-bottom: 20px;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.88rem;
            color: var(--text-muted);
        }
        .login-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <main class="register-card">
        <div class="brand-header">
            <div class="brand-logo">🚀</div>
            <h1>Cadastre seu Restaurante</h1>
            <p>Monte seu cardápio digital e receba pedidos no WhatsApp</p>
            <?php 
            $selectedPlan = (string) ($plan ?? 'mvp');
            $planNames = [
                'mvp' => 'MVP / Degustação (7 Dias Grátis)',
                'starter' => 'Plano Starter (R$ 49/mês)',
                'pro' => 'Plano Pro (R$ 99/mês)',
                'enterprise' => 'Plano Enterprise',
            ];
            ?>
            <span class="plan-badge"><?= htmlspecialchars($planNames[$selectedPlan] ?? $planNames['mvp'], ENT_QUOTES, 'UTF-8') ?></span>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="error-alert">
                <strong>Atenção:</strong>
                <ul style="margin: 6px 0 0 0; padding-left: 20px;">
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars((string) $err, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="/cadastrar">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) ($csrfToken ?? ''), ENT_QUOTES, 'UTF-8') ?>">
            <input type="hidden" name="plano" value="<?= htmlspecialchars($selectedPlan, ENT_QUOTES, 'UTF-8') ?>">

            <div class="form-group">
                <label for="nome">Nome do Restaurante / Estabelecimento *</label>
                <input id="nome" name="nome" type="text" placeholder="Ex: Pizzaria Bella Italia" value="<?= htmlspecialchars((string) ($form['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required oninput="generateSlug(this.value)">
            </div>

            <div class="form-group">
                <label for="slug">Link do seu Cardápio Digital (Slug) *</label>
                <input id="slug" name="slug" type="text" placeholder="ex: meurestaurante" value="<?= htmlspecialchars((string) ($form['slug'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                <div class="slug-preview">Endereço público: <strong>clicoucomeu.com.br/<span id="slug-text">meurestaurante</span></strong></div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label for="whatsapp">WhatsApp do Estabelecimento *</label>
                    <input id="whatsapp" name="whatsapp" type="text" placeholder="(88) 99999-9999" value="<?= htmlspecialchars((string) ($form['whatsapp'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade *</label>
                    <input id="cidade" name="cidade" type="text" placeholder="Ex: Juazeiro do Norte" value="<?= htmlspecialchars((string) ($form['cidade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
            </div>

            <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 20px 0;">

            <div class="form-group">
                <label for="admin_nome">Seu Nome Completo (Proprietário) *</label>
                <input id="admin_nome" name="admin_nome" type="text" placeholder="Ex: João da Silva" value="<?= htmlspecialchars((string) ($form['admin_nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label for="admin_usuario">Usuário para Acesso *</label>
                    <input id="admin_usuario" name="admin_usuario" type="text" placeholder="ex: joao.pizzaria" value="<?= htmlspecialchars((string) ($form['admin_usuario'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-group">
                    <label for="admin_senha">Senha de Acesso *</label>
                    <input id="admin_senha" name="admin_senha" type="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">🚀 Criar Meu Cardápio Agora</button>
        </form>

        <div class="login-link">
            Já possui uma conta? <a href="/login">Fazer Login</a>
        </div>
    </main>

    <script>
        function generateSlug(text) {
            const slugInput = document.getElementById('slug');
            const slugText = document.getElementById('slug-text');
            const slug = text
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');

            if (!slugInput.dataset.userEdited) {
                slugInput.value = slug;
                slugText.innerText = slug || 'meurestaurante';
            }
        }

        document.getElementById('slug').addEventListener('input', function() {
            this.dataset.userEdited = 'true';
            document.getElementById('slug-text').innerText = this.value || 'meurestaurante';
        });

        // Máscara básica para WhatsApp
        document.getElementById('whatsapp').addEventListener('input', function(e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });
    </script>
</body>
</html>
