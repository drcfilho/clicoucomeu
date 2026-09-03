<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404</title>
</head>
<body>
    <main>
        <h1>404</h1>
        <p><?= htmlspecialchars($message ?? 'Pagina nao encontrada.', ENT_QUOTES, 'UTF-8') ?></p>
    </main>
</body>
</html>
