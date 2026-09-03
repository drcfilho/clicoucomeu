<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bairros e Entrega - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'bairros'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Entrega</span>
                        <h1 class="backoffice-title">Bairros e Taxas de Entrega</h1>
                        <p class="backoffice-subtitle">Cadastre os bairros atendidos, valores de frete, pedido mínimo e prazos de entrega.</p>
                    </div>
                    <div class="backoffice-actions">
                        <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-bairro')">+ Novo Bairro</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <section class="bo-panel">
                    <?php if (empty($neighborhoods)): ?>
                        <div style="text-align: center; padding: 40px 20px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem; margin-bottom: 16px;">Nenhum bairro de entrega cadastrado ainda.</p>
                            <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-bairro')">Cadastrar Primeiro Bairro</button>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--bo-line); text-align: left; color: var(--bo-muted);">
                                        <th style="padding: 12px 8px; width: 60px;">Ordem</th>
                                        <th style="padding: 12px 8px;">Nome do Bairro</th>
                                        <th style="padding: 12px 8px;">Taxa de Entrega</th>
                                        <th style="padding: 12px 8px;">Pedido Mínimo</th>
                                        <th style="padding: 12px 8px;">Tempo Estimado</th>
                                        <th style="padding: 12px 8px; width: 100px;">Status</th>
                                        <th style="padding: 12px 8px; text-align: right; width: 180px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($neighborhoods as $b): ?>
                                        <tr style="border-bottom: 1px solid var(--bo-line);">
                                            <td style="padding: 14px 8px; font-weight: bold;"><?= (int) $b['ordem'] ?></td>
                                            <td style="padding: 14px 8px; font-weight: 600;"><?= htmlspecialchars((string) $b['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td style="padding: 14px 8px; font-weight: 700; color: var(--bo-text);">
                                                <?php if ((float)$b['taxa_entrega'] == 0): ?>
                                                    <span style="color: var(--bo-success); font-weight: 800;">Grátis</span>
                                                <?php else: ?>
                                                    R$ <?= number_format((float) $b['taxa_entrega'], 2, ',', '.') ?>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px; color: var(--bo-muted);">
                                                R$ <?= number_format((float) $b['pedido_minimo'], 2, ',', '.') ?>
                                            </td>
                                            <td style="padding: 14px 8px; color: var(--bo-muted);">
                                                <?= $b['tempo_estimado_min'] ? (int)$b['tempo_estimado_min'] . ' min' : '-' ?>
                                            </td>
                                            <td style="padding: 14px 8px;">
                                                <?php if ($b['ativo']): ?>
                                                    <span style="background: var(--bo-success-bg); color: var(--bo-success); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Ativo</span>
                                                <?php else: ?>
                                                    <span style="background: var(--bo-danger-bg); color: var(--bo-danger); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Inativo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px; text-align: right; display: flex; gap: 6px; justify-content: flex-end;">
                                                <button type="button" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;" 
                                                        onclick="editarBairro(<?= htmlspecialchars(json_encode($b), ENT_QUOTES, 'UTF-8') ?>)">
                                                    Editar
                                                </button>
                                                <form method="post" action="/painel/bairros/<?= (int)$b['id'] ?>/toggle" style="display: inline;">
                                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;">
                                                        <?= $b['ativo'] ? 'Desativar' : 'Ativar' ?>
                                                    </button>
                                                </form>
                                                <form method="post" action="/painel/bairros/<?= (int)$b['id'] ?>/excluir" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este bairro?');">
                                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="bo-link bo-link-danger" style="padding: 4px 10px; font-size: 0.82rem;">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </main>

    <!-- Modal Novo Bairro -->
    <div id="modal-novo-bairro" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Novo Bairro</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-novo-bairro')">&times;</button>
            </div>
            <form method="post" action="/painel/bairros">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome do Bairro *
                        <input name="nome" placeholder="Ex: Centro" required>
                    </label>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Taxa de Entrega (R$) *
                            <input name="taxa_entrega" placeholder="0,00 (0 para grátis)" required>
                        </label>
                        <label class="bo-field">
                            Pedido Mínimo (R$)
                            <input name="pedido_minimo" placeholder="0,00">
                        </label>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Tempo Estimado (minutos)
                            <input type="number" name="tempo_estimado_min" placeholder="Ex: 40">
                        </label>
                        <label class="bo-field">
                            Ordem de Exibição
                            <input type="number" name="ordem" placeholder="Opcional">
                        </label>
                    </div>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-novo-bairro')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Bairro</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Bairro -->
    <div id="modal-editar-bairro" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Editar Bairro</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-editar-bairro')">&times;</button>
            </div>
            <form id="form-editar-bairro" method="post" action="">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome do Bairro *
                        <input id="edit-bairro-nome" name="nome" required>
                    </label>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Taxa de Entrega (R$) *
                            <input id="edit-bairro-taxa" name="taxa_entrega" required>
                        </label>
                        <label class="bo-field">
                            Pedido Mínimo (R$)
                            <input id="edit-bairro-minimo" name="pedido_minimo">
                        </label>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Tempo Estimado (minutos)
                            <input type="number" id="edit-bairro-tempo" name="tempo_estimado_min">
                        </label>
                        <label class="bo-field">
                            Ordem de Exibição
                            <input type="number" id="edit-bairro-ordem" name="ordem" required>
                        </label>
                    </div>

                    <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                        <input type="checkbox" id="edit-bairro-ativo" name="ativo" value="1">
                        Bairro ativo para entregas
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-editar-bairro')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Atualizar Bairro</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        function editarBairro(b) {
            document.getElementById('form-editar-bairro').action = '/painel/bairros/' + b.id + '/editar';
            document.getElementById('edit-bairro-nome').value = b.nome || '';
            document.getElementById('edit-bairro-taxa').value = parseFloat(b.taxa_entrega).toFixed(2).replace('.', ',');
            document.getElementById('edit-bairro-minimo').value = parseFloat(b.pedido_minimo || 0).toFixed(2).replace('.', ',');
            document.getElementById('edit-bairro-tempo').value = b.tempo_estimado_min || '';
            document.getElementById('edit-bairro-ordem').value = b.ordem || 0;
            document.getElementById('edit-bairro-ativo').checked = b.ativo == 1;
            openModal('modal-editar-bairro');
        }
    </script>
</body>
</html>
