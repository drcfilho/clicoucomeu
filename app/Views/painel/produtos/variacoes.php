<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Variações de <?= htmlspecialchars((string) $product['nome'], ENT_QUOTES, 'UTF-8') ?> - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'produtos'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Produto</span>
                        <h1 class="backoffice-title">Variações: <?= htmlspecialchars((string) $product['nome'], ENT_QUOTES, 'UTF-8') ?></h1>
                        <p class="backoffice-subtitle">Configure opções de tamanhos, porções ou tipos de embalagem (ex: Broto, Média, Grande, 500ml, 1L).</p>
                    </div>
                    <div class="backoffice-actions">
                        <a href="/painel/produtos" class="bo-link bo-link-secondary">Voltar aos Produtos</a>
                        <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-nova-variacao')">+ Nova Variação</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <section class="bo-panel">
                    <?php if (empty($variations)): ?>
                        <div style="text-align: center; padding: 40px 20px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem; margin-bottom: 8px;">Nenhuma variação cadastrada para este produto.</p>
                            <p style="font-size: 0.9rem; margin-bottom: 16px;">O produto usará o preço base fixo de <strong>R$ <?= number_format((float)$product['preco'], 2, ',', '.') ?></strong>.</p>
                            <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-nova-variacao')">Cadastrar Primeira Variação</button>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--bo-line); text-align: left; color: var(--bo-muted);">
                                        <th style="padding: 12px 8px; width: 60px;">Ordem</th>
                                        <th style="padding: 12px 8px;">Nome da Variação</th>
                                        <th style="padding: 12px 8px;">Preço Específico</th>
                                        <th style="padding: 12px 8px; text-align: right; width: 180px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($variations as $var): ?>
                                        <tr style="border-bottom: 1px solid var(--bo-line);">
                                            <td style="padding: 14px 8px; font-weight: bold;"><?= (int) $var['ordem'] ?></td>
                                            <td style="padding: 14px 8px; font-weight: 600;"><?= htmlspecialchars((string) $var['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td style="padding: 14px 8px; font-weight: 700; color: var(--bo-text);">
                                                <?php if ($var['preco'] !== null): ?>
                                                    R$ <?= number_format((float) $var['preco'], 2, ',', '.') ?>
                                                <?php else: ?>
                                                    <span style="color: var(--bo-muted); font-weight: normal;">Preço base (R$ <?= number_format((float)$product['preco'], 2, ',', '.') ?>)</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px; text-align: right; display: flex; gap: 6px; justify-content: flex-end;">
                                                <button type="button" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;" 
                                                        onclick="editarVariacao(<?= htmlspecialchars(json_encode($var), ENT_QUOTES, 'UTF-8') ?>)">
                                                    Editar
                                                </button>
                                                <form method="post" action="/painel/produtos/<?= (int)$product['id'] ?>/variacoes/<?= (int)$var['id'] ?>/excluir" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta variação?');">
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

    <!-- Modal Nova Variação -->
    <div id="modal-nova-variacao" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Nova Variação</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-nova-variacao')">&times;</button>
            </div>
            <form method="post" action="/painel/produtos/<?= (int)$product['id'] ?>/variacoes">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome da Variação *
                        <input name="nome" placeholder="Ex: Pizza Grande (8 Fatias)" required>
                    </label>
                    <label class="bo-field">
                        Preço Específico (R$)
                        <input name="preco" placeholder="Deixe em branco para usar o preço base do produto">
                    </label>
                    <label class="bo-field">
                        Ordem de Exibição
                        <input type="number" name="ordem" placeholder="Deixe em branco para o final">
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-nova-variacao')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Variação</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Variação -->
    <div id="modal-editar-variacao" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Editar Variação</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-editar-variacao')">&times;</button>
            </div>
            <form id="form-editar-variacao" method="post" action="">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome da Variação *
                        <input id="edit-var-nome" name="nome" required>
                    </label>
                    <label class="bo-field">
                        Preço Específico (R$)
                        <input id="edit-var-preco" name="preco">
                    </label>
                    <label class="bo-field">
                        Ordem de Exibição
                        <input type="number" id="edit-var-ordem" name="ordem" required>
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-editar-variacao')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Atualizar Variação</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        function editarVariacao(v) {
            document.getElementById('form-editar-variacao').action = '/painel/produtos/<?= (int)$product['id'] ?>/variacoes/' + v.id + '/editar';
            document.getElementById('edit-var-nome').value = v.nome || '';
            document.getElementById('edit-var-preco').value = v.preco !== null ? parseFloat(v.preco).toFixed(2).replace('.', ',') : '';
            document.getElementById('edit-var-ordem').value = v.ordem || 0;
            openModal('modal-editar-variacao');
        }
    </script>
</body>
</html>
