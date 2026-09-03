<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Categorias - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'categorias'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Cardápio</span>
                        <h1 class="backoffice-title">Categorias</h1>
                        <p class="backoffice-subtitle">Organize os grupos de produtos que aparecem no seu cardápio público.</p>
                    </div>
                    <div class="backoffice-actions">
                        <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-nova-categoria')">+ Nova Categoria</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <section class="bo-panel">
                    <?php if (empty($categories)): ?>
                        <div style="text-align: center; padding: 40px 20px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem; margin-bottom: 16px;">Nenhuma categoria cadastrada ainda.</p>
                            <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-nova-categoria')">Cadastrar Primeira Categoria</button>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--bo-line); text-align: left; color: var(--bo-muted);">
                                        <th style="padding: 12px 8px; width: 60px;">Ordem</th>
                                        <th style="padding: 12px 8px;">Nome</th>
                                        <th style="padding: 12px 8px;">Descrição</th>
                                        <th style="padding: 12px 8px; width: 100px;">Status</th>
                                        <th style="padding: 12px 8px; text-align: right; width: 180px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $cat): ?>
                                        <tr style="border-bottom: 1px solid var(--bo-line);">
                                            <td style="padding: 14px 8px; font-weight: bold;"><?= (int) $cat['ordem'] ?></td>
                                            <td style="padding: 14px 8px; font-weight: 600;"><?= htmlspecialchars((string) $cat['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td style="padding: 14px 8px; color: var(--bo-muted);"><?= htmlspecialchars((string) ($cat['descricao'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                            <td style="padding: 14px 8px;">
                                                <?php if ($cat['ativo']): ?>
                                                    <span style="background: var(--bo-success-bg); color: var(--bo-success); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Ativo</span>
                                                <?php else: ?>
                                                    <span style="background: var(--bo-danger-bg); color: var(--bo-danger); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Inativo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px; text-align: right; display: flex; gap: 6px; justify-content: flex-end;">
                                                <button type="button" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;" 
                                                        onclick="editarCategoria(<?= htmlspecialchars(json_encode($cat), ENT_QUOTES, 'UTF-8') ?>)">
                                                    Editar
                                                </button>
                                                <form method="post" action="/painel/categorias/<?= (int)$cat['id'] ?>/toggle" style="display: inline;">
                                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;">
                                                        <?= $cat['ativo'] ? 'Desativar' : 'Ativar' ?>
                                                    </button>
                                                </form>
                                                <form method="post" action="/painel/categorias/<?= (int)$cat['id'] ?>/excluir" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
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

    <!-- Modal Nova Categoria -->
    <div id="modal-nova-categoria" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Nova Categoria</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-nova-categoria')">&times;</button>
            </div>
            <form method="post" action="/painel/categorias">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome da Categoria *
                        <input name="nome" placeholder="Ex: Pizzas Tradicionais" required>
                    </label>
                    <label class="bo-field">
                        Descrição (opcional)
                        <input name="descricao" placeholder="Ex: Acompanha molho de tomate artesanal">
                    </label>
                    <label class="bo-field">
                        Ordem de Exibição
                        <input type="number" name="ordem" placeholder="Deixe em branco para o final">
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-nova-categoria')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Categoria</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Categoria -->
    <div id="modal-editar-categoria" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Editar Categoria</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-editar-categoria')">&times;</button>
            </div>
            <form id="form-editar-categoria" method="post" action="">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome da Categoria *
                        <input id="edit-nome" name="nome" required>
                    </label>
                    <label class="bo-field">
                        Descrição
                        <input id="edit-descricao" name="descricao">
                    </label>
                    <label class="bo-field">
                        Ordem de Exibição
                        <input type="number" id="edit-ordem" name="ordem" required>
                    </label>
                    <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                        <input type="checkbox" id="edit-ativo" name="ativo" value="1">
                        Categoria ativa no cardápio
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-editar-categoria')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Atualizar Categoria</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        function editarCategoria(cat) {
            document.getElementById('form-editar-categoria').action = '/painel/categorias/' + cat.id + '/editar';
            document.getElementById('edit-nome').value = cat.nome || '';
            document.getElementById('edit-descricao').value = cat.descricao || '';
            document.getElementById('edit-ordem').value = cat.ordem || 0;
            document.getElementById('edit-ativo').checked = cat.ativo == 1;
            openModal('modal-editar-categoria');
        }
    </script>
</body>
</html>
