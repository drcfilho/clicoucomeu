<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f4f1ea; color: #1e1a16; }
        main { min-height: 100vh; padding: 32px 20px; display: grid; place-items: center; }
        section { width: min(680px, 100%); background: #fffdf8; border: 1px solid #e6dccd; border-radius: 20px; padding: 28px; box-sizing: border-box; }
        h1 { margin: 0 0 8px; font-size: 2rem; }
        p { margin: 0 0 16px; line-height: 1.5; }
        nav { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 24px; }
        a { display: inline-flex; align-items: center; justify-content: center; min-height: 44px; padding: 0 18px; border-radius: 999px; text-decoration: none; }
        .primary { background: #1e1a16; color: #fffdf8; }
        .secondary { border: 1px solid #c9b89d; color: #5c4830; }
    </style>
</head>
<body>
    <main>
        <section>
            <h1>Area administrativa</h1>
            <p>Usuario autenticado: <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?></p>
            <p>Esta entrada centraliza operacoes de superadmin. A proxima etapa e listar e gerenciar tenants.</p>
            <nav>
                <a class="primary" href="/admin/tenants">Ir para tenants</a>
                <a class="secondary" href="/painel">Voltar ao painel</a>
            </nav>
        </section>
    </main>
</body>
</html>
