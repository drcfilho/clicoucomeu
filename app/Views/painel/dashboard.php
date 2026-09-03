<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel</title>
</head>
<body>
    <main>
        <h1>Painel</h1>
        <p>Estrutura inicial do dashboard.</p>
        <pre><?= htmlspecialchars(json_encode($metrics, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?></pre>
    </main>
</body>
</html>
