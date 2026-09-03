<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Itens de <?= htmlspecialchars((string) $group['nome'], ENT_QUOTES, 'UTF-8') ?> - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'adicionais'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Grupo de Adicionais</span>
                        <h1 class="backoffice-title">Itens: <?= htmlspecialchars((string) $group['nome'], ENT_QUOTES, 'UTF-8') ?></h1>
                        <p class="backoffice-subtitle">Cadastre os adicionais disponíveis para o cliente escolher neste grupo.</p>
                    </div>
                    <div class="backoffice-actions">
                        <a href="/painel/adicionais" class="bo-link bo-link-secondary">Voltar aos Grupos</a>
                        <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-item')">+ Novo Adicional</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <section class="bo-panel">
                    <?php if (empty($items)): ?>
                        <div style="text-align: center; padding: 40px 20px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem; margin-bottom: 16px;">Nenhum item adicional cadastrado neste grupo.</p>
                            <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-item')">Cadastrar Primeiro Adicional</button>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--bo-line); text-align: left; color: var(--bo-muted);">
                                        <th style="padding: 12px 8px; width: 60px;">Ordem</th>
                                        <th style="padding: 12px 8px;">Nome do Adicional</th>
                                        <th style="padding: 12px 8px;">Preço Extra</th>
                                        <th style="padding: 12px 8px; text-align: right; width: 180px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                        <tr style="border-bottom: 1px solid var(--bo-line);">
                                            <td style="padding: 14px 8px; font-weight: bold;"><?= (int) $item['ordem'] ?></td>
                                            <td style="padding: 14px 8px; font-weight: 600;"><?= htmlspecialchars((string) $item['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td style="padding: 14px 8px; font-weight: 700; color: var(--bo-text);">
                                                + R$ <?= number_format((float) $item['preco'], 2, ',', '.') ?>
                                            </td>
                                            <td style="padding: 14px 8px; text-align: right; display: flex; gap: 6px; justify-content: flex-end;">
                                                <button type="button" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;" 
                                                        onclick="editarItem(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)">
                                                    Editar
                                                </button>
                                                <form method="post" action="/painel/adicionais/<?= (int)$group['id'] ?>/itens/<?= (int)$item['id'] ?>/excluir" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este adicional?');">
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

    <!-- Modal Novo Item Adicional -->
    <div id="modal-novo-item" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Novo Item Adicional</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-novo-item')">&times;</button>
            </div>
            <form method="post" action="/painel/adicionais/<?= (int)$group['id'] ?>/itens">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome do Adicional *
                        <input name="nome" placeholder="Ex: Catupiry Original" required>
                    </label>
                    <label class="bo-field">
                        Preço Extra (R$) *
                        <input name="preco" placeholder="0,00" required>
                    </label>
                    <label class="bo-field">
                        Ordem de Exibição
                        <input type="number" name="ordem" placeholder="Deixe em branco para o final">
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-novo-item')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Adicional</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Item Adicional -->
    <div id="modal-editar-item" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Editar Adicional</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-editar-item')">&times;</button>
            </div>
            <form id="form-editar-item" method="post" action="">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome do Adicional *
                        <input id="edit-item-nome" name="nome" required>
                    </label>
                    <label class="bo-field">
                        Preço Extra (R$) *
                        <input id="edit-item-preco" name="preco" required>
                    </label>
                    <label class="bo-field">
                        Ordem de Exibição
                        <input type="number" id="edit-item-ordem" name="ordem" required>
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-editar-item')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Atualizar Adicional</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        function editarItem(item) {
            document.getElementById('form-editar-item').action = '/painel/adicionais/<?= (int)$group['id'] ?>/itens/' + item.id + '/editar';
            document.getElementById('edit-item-nome').value = item.nome || '';
            document.getElementById('edit-item-preco').value = parseFloat(item.preco).toFixed(2).replace('.', ',');
            document.getElementById('edit-item-ordem').value = item.ordem || 0;
            openModal('modal-editar-item');
        }
    </script>
</body>
</html>
