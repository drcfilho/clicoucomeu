<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Produtos - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'produtos'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Cardápio</span>
                        <h1 class="backoffice-title">Produtos</h1>
                        <p class="backoffice-subtitle">Cadastre, edite e controle a disponibilidade dos seus itens à venda.</p>
                    </div>
                    <div class="backoffice-actions">
                        <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-produto')">+ Novo Produto</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <!-- Filtros e Busca -->
                <section class="bo-panel" style="margin-bottom: 20px; padding: 16px;">
                    <form method="get" action="/painel/produtos" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
                        <div style="flex: 1; min-width: 200px;">
                            <input type="text" name="q" value="<?= htmlspecialchars((string)($searchQuery ?? ''), ENT_QUOTES, 'UTF-8') ?>" 
                                   placeholder="Buscar por nome ou descrição..." 
                                   style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid var(--bo-line);">
                        </div>
                        <div style="width: 220px;">
                            <select name="categoria_id" onchange="this.form.submit()" style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid var(--bo-line);">
                                <option value="">Todas as Categorias</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= (int)$cat['id'] ?>" <?= ($selectedCategoryId == $cat['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars((string)$cat['nome'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="bo-link bo-link-secondary" style="padding: 8px 16px;">Filtrar</button>
                        <?php if ($searchQuery || $selectedCategoryId): ?>
                            <a href="/painel/produtos" class="bo-link" style="color: var(--bo-muted); font-size: 0.88rem;">Limpar Filtros</a>
                        <?php endif; ?>
                    </form>
                </section>

                <section class="bo-panel">
                    <?php if (empty($products)): ?>
                        <div style="text-align: center; padding: 40px 20px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem; margin-bottom: 16px;">Nenhum produto encontrado.</p>
                            <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-produto')">Cadastrar Produto</button>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.92rem;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--bo-line); text-align: left; color: var(--bo-muted);">
                                        <th style="padding: 12px 8px; width: 60px;">Imagem</th>
                                        <th style="padding: 12px 8px;">Produto</th>
                                        <th style="padding: 12px 8px;">Categoria</th>
                                        <th style="padding: 12px 8px;">Preço Base</th>
                                        <th style="padding: 12px 8px; width: 110px;">Status</th>
                                        <th style="padding: 12px 8px; text-align: right; width: 240px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $prod): ?>
                                        <tr style="border-bottom: 1px solid var(--bo-line);">
                                            <td style="padding: 10px 8px;">
                                                <?php if (!empty($prod['imagem'])): ?>
                                                    <img src="<?= htmlspecialchars((string)$prod['imagem'], ENT_QUOTES, 'UTF-8') ?>" alt="" style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div style="width: 44px; height: 44px; border-radius: 8px; background: var(--bo-primary-soft); display: grid; place-items: center; font-size: 1.2rem;">🍔</div>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 10px 8px;">
                                                <strong style="display: block; font-size: 0.98rem;"><?= htmlspecialchars((string) $prod['nome'], ENT_QUOTES, 'UTF-8') ?></strong>
                                                <?php if (!empty($prod['descricao'])): ?>
                                                    <span style="color: var(--bo-muted); font-size: 0.82rem; display: block; max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars((string) $prod['descricao'], ENT_QUOTES, 'UTF-8') ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 10px 8px; color: var(--bo-muted); font-weight: 500;">
                                                <?= htmlspecialchars((string) ($prod['categoria_nome'] ?? 'Sem categoria'), ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 10px 8px; font-weight: 700; color: var(--bo-text);">
                                                R$ <?= number_format((float) $prod['preco'], 2, ',', '.') ?>
                                            </td>
                                            <td style="padding: 10px 8px;">
                                                <?php if ($prod['disponivel']): ?>
                                                    <span style="background: var(--bo-success-bg); color: var(--bo-success); padding: 4px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 700;">Disponível</span>
                                                <?php else: ?>
                                                    <span style="background: var(--bo-warn-bg); color: var(--bo-warn); padding: 4px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 700;">Esgotado</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 10px 8px; text-align: right; display: flex; gap: 4px; justify-content: flex-end; align-items: center; min-height: 60px;">
                                                <a href="/painel/produtos/<?= (int)$prod['id'] ?>/variacoes" class="bo-link bo-link-secondary" style="padding: 4px 8px; font-size: 0.8rem;" title="Gerenciar variações (Tamanhos/Opções)">
                                                    📏 Variações
                                                </a>
                                                <button type="button" class="bo-link bo-link-secondary" style="padding: 4px 8px; font-size: 0.8rem;" 
                                                        onclick="editarProduto(<?= htmlspecialchars(json_encode($prod), ENT_QUOTES, 'UTF-8') ?>)">
                                                    Editar
                                                </button>
                                                <form method="post" action="/painel/produtos/<?= (int)$prod['id'] ?>/disponibilidade" style="display: inline;">
                                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="bo-link bo-link-secondary" style="padding: 4px 8px; font-size: 0.8rem;">
                                                        <?= $prod['disponivel'] ? 'Esgotar' : 'Ativar' ?>
                                                    </button>
                                                </form>
                                                <form method="post" action="/painel/produtos/<?= (int)$prod['id'] ?>/duplicar" style="display: inline;">
                                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="bo-link bo-link-secondary" style="padding: 4px 8px; font-size: 0.8rem;" title="Duplicar produto">
                                                        📋
                                                    </button>
                                                </form>
                                                <form method="post" action="/painel/produtos/<?= (int)$prod['id'] ?>/excluir" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="bo-link bo-link-danger" style="padding: 4px 8px; font-size: 0.8rem;">✕</button>
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

    <!-- Modal Novo Produto -->
    <div id="modal-novo-produto" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal bo-modal-lg" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Novo Produto</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-novo-produto')">&times;</button>
            </div>
            <form method="post" action="/painel/produtos" enctype="multipart/form-data">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Nome do Produto *
                            <input name="nome" placeholder="Ex: Pizza Calabresa Especial" required>
                        </label>
                        <label class="bo-field">
                            Categoria *
                            <select name="categoria_id" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= (int)$cat['id'] ?>"><?= htmlspecialchars((string)$cat['nome'], ENT_QUOTES, 'UTF-8') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Preço Base (R$) *
                            <input name="preco" placeholder="0,00" required>
                        </label>
                        <label class="bo-field">
                            Imagem do Produto (opcional)
                            <input type="file" name="imagem" accept="image/jpeg,image/png,image/webp">
                        </label>
                    </div>

                    <label class="bo-field">
                        Descrição
                        <textarea name="descricao" rows="3" placeholder="Ingredientes e detalhes do produto..."></textarea>
                    </label>

                    <div style="display: flex; gap: 20px;">
                        <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                            <input type="checkbox" name="disponivel" value="1" checked>
                            Produto disponível para venda
                        </label>
                        <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                            <input type="checkbox" name="destaque" value="1">
                            Destaque no cardápio
                        </label>
                    </div>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-novo-produto')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Cadastrar Produto</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Produto -->
    <div id="modal-editar-produto" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal bo-modal-lg" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Editar Produto</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-editar-produto')">&times;</button>
            </div>
            <form id="form-editar-produto" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Nome do Produto *
                            <input id="edit-prod-nome" name="nome" required>
                        </label>
                        <label class="bo-field">
                            Categoria *
                            <select id="edit-prod-categoria" name="categoria_id" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= (int)$cat['id'] ?>"><?= htmlspecialchars((string)$cat['nome'], ENT_QUOTES, 'UTF-8') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Preço Base (R$) *
                            <input id="edit-prod-preco" name="preco" required>
                        </label>
                        <label class="bo-field">
                            Alterar Imagem
                            <input type="file" name="imagem" accept="image/jpeg,image/png,image/webp">
                        </label>
                    </div>

                    <label class="bo-field">
                        Descrição
                        <textarea id="edit-prod-descricao" name="descricao" rows="3"></textarea>
                    </label>

                    <div style="display: flex; gap: 20px;">
                        <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                            <input type="checkbox" id="edit-prod-disponivel" name="disponivel" value="1">
                            Produto disponível para venda
                        </label>
                        <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                            <input type="checkbox" id="edit-prod-destaque" name="destaque" value="1">
                            Destaque no cardápio
                        </label>
                    </div>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-editar-produto')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        function editarProduto(prod) {
            document.getElementById('form-editar-produto').action = '/painel/produtos/' + prod.id + '/editar';
            document.getElementById('edit-prod-nome').value = prod.nome || '';
            document.getElementById('edit-prod-categoria').value = prod.categoria_id || '';
            document.getElementById('edit-prod-preco').value = parseFloat(prod.preco).toFixed(2).replace('.', ',');
            document.getElementById('edit-prod-descricao').value = prod.descricao || '';
            document.getElementById('edit-prod-disponivel').checked = prod.disponivel == 1;
            document.getElementById('edit-prod-destaque').checked = prod.destaque == 1;
            openModal('modal-editar-produto');
        }
    </script>
</body>
</html>
