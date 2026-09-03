<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acesso negado</title>
</head>
<body>
    <main>
        <h1>Acesso negado</h1>
        <p><?= htmlspecialchars((string) ($message ?? 'Voce nao tem permissao para acessar esta area.'), ENT_QUOTES, 'UTF-8') ?></p>
    </main>
</body>
</html>
