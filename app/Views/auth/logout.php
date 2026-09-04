<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sessão Encerrada — Clicou Comeu</title>
    <style>
        :root {
            --primary: #e11d48;
            --body-bg: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
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
        .logout-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            padding: 40px 32px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.08), 0 0 1px rgba(0, 0, 0, 0.1);
        }
        .logout-icon {
            width: 64px;
            height: 64px;
            background: rgba(225, 29, 72, 0.1);
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 2rem;
            margin: 0 auto 16px;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0 0 8px;
            letter-spacing: -0.02em;
        }
        p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin: 0 0 28px;
            line-height: 1.5;
        }
        .actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .btn-primary {
            display: block;
            width: 100%;
            padding: 12px 16px;
            background: var(--primary);
            color: #fff;
            font-weight: 700;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: #be123c;
        }
        .btn-secondary {
            display: block;
            width: 100%;
            padding: 12px 16px;
            background: #f1f5f9;
            color: #334155;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-secondary:hover {
            background: #e2e8f0;
        }
    </style>
</head>
<body>

    <main class="logout-card">
        <div class="logout-icon">👋</div>
        <h1>Você saiu do sistema</h1>
        <p>Sua sessão foi encerrada com segurança. O que você gostaria de fazer agora?</p>

        <div class="actions">
            <a href="/login" class="btn-primary">🔐 Entrar Novamente</a>
            <a href="/" class="btn-secondary">🏠 Ir para a Página Inicial</a>
        </div>
    </main>

    <script>
        // Redireciona automaticamente para a tela de login após 10 segundos
        setTimeout(() => {
            window.location.href = '/login';
        }, 10000);
    </script>

</body>
</html>
