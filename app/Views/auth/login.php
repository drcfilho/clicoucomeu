<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f5f5f5; color: #111; }
        main { min-height: 100vh; display: grid; place-items: center; padding: 24px; }
        form { width: 100%; max-width: 360px; background: #fff; padding: 24px; border-radius: 14px; box-shadow: 0 12px 32px rgba(0,0,0,.08); }
        label, input, button { display: block; width: 100%; }
        label { margin-bottom: 6px; font-weight: 600; }
        input { margin-bottom: 16px; padding: 12px; border: 1px solid #ccc; border-radius: 10px; box-sizing: border-box; }
        button { padding: 12px; border: 0; border-radius: 10px; background: #111; color: #fff; cursor: pointer; }
        .error { margin-bottom: 16px; padding: 12px; border-radius: 10px; background: #fde7e9; color: #8a1c24; }
    </style>
</head>
<body>
    <main>
        <form method="post" action="/login">
            <h1>Entrar</h1>
            <?php if (!empty($error)): ?>
                <div class="error"><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

            <label for="usuario">Usuario</label>
            <input id="usuario" name="usuario" type="text" autocomplete="username" required>

            <label for="senha">Senha</label>
            <input id="senha" name="senha" type="password" autocomplete="current-password" required>

            <button type="submit">Entrar</button>
        </form>
    </main>
</body>
</html>
