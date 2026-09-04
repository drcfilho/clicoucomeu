<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configurações do Estabelecimento - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
    <style>
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .bo-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }
        .bo-form-group label {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--bo-text);
        }
        .bo-form-group input, .bo-form-group select, .bo-form-group textarea {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--bo-line);
            background: #fff;
            font-size: 0.95rem;
        }
    </style>
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'configuracoes'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Configurações</span>
                        <h1 class="backoffice-title">Perfil e Parâmetros da Loja</h1>
                        <p class="backoffice-subtitle">Gerencie nome, contato, logotipo, cores, timezone e formato de impressão.</p>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <form method="post" action="/painel/configuracoes" enctype="multipart/form-data">
                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                    <div class="settings-grid">
                        <!-- Dados do Estabelecimento -->
                        <section class="bo-panel">
                            <h2 class="bo-section-title">🏢 Identificação da Loja</h2>
                            
                            <div class="bo-form-group">
                                <label for="nome">Nome do Estabelecimento *</label>
                                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars((string)($tenant['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                            </div>

                            <div class="bo-form-group">
                                <label for="whatsapp">WhatsApp da Loja (com DDD) *</label>
                                <input type="text" id="whatsapp" name="whatsapp" value="<?= htmlspecialchars((string)($tenant['whatsapp'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" placeholder="ex: 88999998888" required>
                            </div>

                            <div class="bo-form-group">
                                <label for="logo">Logotipo da Loja</label>
                                <?php if (!empty($configs['logo_url'])): ?>
                                    <div style="margin-bottom: 8px;">
                                        <img src="<?= htmlspecialchars(asset($configs['logo_url']), ENT_QUOTES, 'UTF-8') ?>" alt="Logo" style="max-height: 60px; border-radius: 8px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" id="logo" name="logo" accept="image/*">
                            </div>

                            <div class="bo-form-group">
                                <label for="endereco_completo">Endereço Completo</label>
                                <textarea id="endereco_completo" name="endereco_completo" rows="2" placeholder="Rua, Número, Bairro, Cidade - UF"><?= htmlspecialchars((string)($configs['endereco_completo'] ?? ''), ENT_QUOTES, 'UTF-8') ?></textarea>
                            </div>
                        </section>

                        <!-- Parâmetros Operacionais -->
                        <section class="bo-panel">
                            <h2 class="bo-section-title">⚙️ Parâmetros Operacionais</h2>

                            <div class="bo-form-group">
                                <label for="timezone">Fuso Horário (Timezone) *</label>
                                <select id="timezone" name="timezone" required>
                                    <?php 
                                    $timezones = [
                                        'America/Fortaleza' => 'America/Fortaleza (UTC-3)',
                                        'America/Sao_Paulo' => 'America/Sao_Paulo (Brasília UTC-3)',
                                        'America/Manaus' => 'America/Manaus (UTC-4)',
                                        'America/Rio_Branco' => 'America/Rio_Branco (UTC-5)',
                                    ];
                                    $currentTz = (string)($tenant['timezone'] ?? 'America/Sao_Paulo');
                                    foreach ($timezones as $tz => $tzLabel): 
                                    ?>
                                        <option value="<?= $tz ?>" <?= $currentTz === $tz ? 'selected' : '' ?>><?= $tzLabel ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="bo-form-group">
                                <label for="impressora_formato">Formato de Impressão Padrão</label>
                                <select id="impressora_formato" name="impressora_formato">
                                    <?php $fmt = (string)($configs['impressora_formato'] ?? '80mm'); ?>
                                    <option value="80mm" <?= $fmt === '80mm' ? 'selected' : '' ?>>Térmica 80 mm (Recomendado)</option>
                                    <option value="58mm" <?= $fmt === '58mm' ? 'selected' : '' ?>>Térmica 58 mm</option>
                                    <option value="a4" <?= $fmt === 'a4' ? 'selected' : '' ?>>Folha A4</option>
                                </select>
                            </div>

                            <div class="bo-form-group">
                                <label for="cor_primaria">Cor Primária do Tema (Hexadecimal)</label>
                                <input type="color" id="cor_primaria" name="cor_primaria" value="<?= htmlspecialchars((string)($configs['cor_primaria'] ?? '#EA1D2C'), ENT_QUOTES, 'UTF-8') ?>" style="height: 42px; padding: 2px;">
                            </div>

                            <div class="bo-form-group">
                                <label for="mensagem_loja_fechada">Mensagem de Loja Fechada</label>
                                <textarea id="mensagem_loja_fechada" name="mensagem_loja_fechada" rows="2"><?= htmlspecialchars((string)($configs['mensagem_loja_fechada'] ?? 'No momento estamos fechados. Consulte nossos horários de funcionamento.'), ENT_QUOTES, 'UTF-8') ?></textarea>
                            </div>
                        </section>
                    </div>

                    <div style="margin-top: 24px; text-align: right;">
                        <button type="submit" class="bo-link bo-link-primary" style="padding: 12px 24px; font-size: 1rem;">💾 Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
