<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grupos de Adicionais - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'adicionais'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Cardápio</span>
                        <h1 class="backoffice-title">Grupos de Adicionais</h1>
                        <p class="backoffice-subtitle">Crie grupos como "Bordas Recheadas", "Molhos" ou "Adicionais" e associe aos produtos.</p>
                    </div>
                    <div class="backoffice-actions">
                        <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-grupo')">+ Novo Grupo</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <!-- Gerador de Variações Rápidas por Segmento -->
                <section class="bo-panel" style="margin-bottom: 20px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #fff;">
                    <h2 style="margin: 0 0 8px 0; font-size: 1.15rem; color: #f8fafc; display: flex; align-items: center; gap: 8px;">
                        🎨 Gerador de Variações & Presets Rápidos
                    </h2>
                    <p style="margin: 0 0 16px 0; color: #94a3b8; font-size: 0.88rem;">Clique no segmento do seu restaurante para carregar variações pré-configuradas de 1-clique:</p>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
                        <button type="button" onclick="loadPreset('pizzaria')" style="padding: 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: #fff; text-align: left; cursor: pointer; transition: background 0.2s;">
                            <strong style="display: block; color: #f8fafc; font-size: 0.95rem;">🍕 Pizzaria</strong>
                            <span style="font-size: 0.78rem; color: #94a3b8;">Tamanhos, Bordas e Sabores</span>
                        </button>

                        <button type="button" onclick="loadPreset('hamburgueria')" style="padding: 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: #fff; text-align: left; cursor: pointer; transition: background 0.2s;">
                            <strong style="display: block; color: #f8fafc; font-size: 0.95rem;">🍔 Hamburgueria</strong>
                            <span style="font-size: 0.78rem; color: #94a3b8;">Ponto da Carne, Pão & Molhos</span>
                        </button>

                        <button type="button" onclick="loadPreset('acaiteria')" style="padding: 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: #fff; text-align: left; cursor: pointer; transition: background 0.2s;">
                            <strong style="display: block; color: #f8fafc; font-size: 0.95rem;">🍧 Açaiteria</strong>
                            <span style="font-size: 0.78rem; color: #94a3b8;">Tamanho Copo, Acompanhamentos</span>
                        </button>

                        <button type="button" onclick="loadPreset('confeitaria')" style="padding: 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: #fff; text-align: left; cursor: pointer; transition: background 0.2s;">
                            <strong style="display: block; color: #f8fafc; font-size: 0.95rem;">🍰 Confeitaria</strong>
                            <span style="font-size: 0.78rem; color: #94a3b8;">Recheios & Coberturas</span>
                        </button>

                        <button type="button" onclick="loadPreset('sushi')" style="padding: 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: #fff; text-align: left; cursor: pointer; transition: background 0.2s;">
                            <strong style="display: block; color: #f8fafc; font-size: 0.95rem;">🍱 Sushi / Japa</strong>
                            <span style="font-size: 0.78rem; color: #94a3b8;">Molhos & Adicionais</span>
                        </button>
                    </div>
                </section>

                <section class="bo-panel">
                    <?php if (empty($groups)): ?>
                        <div style="text-align: center; padding: 40px 20px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem; margin-bottom: 16px;">Nenhum grupo de adicionais cadastrado ainda.</p>
                            <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-grupo')">Cadastrar Primeiro Grupo</button>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--bo-line); text-align: left; color: var(--bo-muted);">
                                        <th style="padding: 12px 8px; width: 60px;">Ordem</th>
                                        <th style="padding: 12px 8px;">Nome do Grupo</th>
                                        <th style="padding: 12px 8px;">Regra de Escolha</th>
                                        <th style="padding: 12px 8px;">Obrigatório</th>
                                        <th style="padding: 12px 8px;">Itens</th>
                                        <th style="padding: 12px 8px; text-align: right; width: 220px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($groups as $g): ?>
                                        <tr style="border-bottom: 1px solid var(--bo-line);">
                                            <td style="padding: 14px 8px; font-weight: bold;"><?= (int) $g['ordem'] ?></td>
                                            <td style="padding: 14px 8px; font-weight: 600;"><?= htmlspecialchars((string) $g['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td style="padding: 14px 8px; color: var(--bo-muted);">
                                                Mín: <strong><?= (int)$g['minimo'] ?></strong> | Máx: <strong><?= (int)$g['maximo'] ?></strong>
                                            </td>
                                            <td style="padding: 14px 8px;">
                                                <?php if ($g['obrigatorio']): ?>
                                                    <span style="background: var(--bo-warn-bg); color: var(--bo-warn); padding: 4px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 700;">Sim</span>
                                                <?php else: ?>
                                                    <span style="color: var(--bo-muted); font-size: 0.85rem;">Opcional</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px;">
                                                <a href="/painel/adicionais/<?= (int)$g['id'] ?>/itens" class="bo-link bo-link-secondary" style="padding: 4px 8px; font-size: 0.8rem;">
                                                    ➕ <?= (int)$g['total_adicionais'] ?> Itens
                                                </a>
                                            </td>
                                            <td style="padding: 14px 8px; text-align: right; display: flex; gap: 6px; justify-content: flex-end;">
                                                <button type="button" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;" 
                                                        onclick="editarGrupo(<?= htmlspecialchars(json_encode($g), ENT_QUOTES, 'UTF-8') ?>)">
                                                    Editar
                                                </button>
                                                <form method="post" action="/painel/adicionais/<?= (int)$g['id'] ?>/excluir" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este grupo?');">
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

    <!-- Modal Novo Grupo -->
    <div id="modal-novo-grupo" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal bo-modal-lg" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Novo Grupo de Adicionais</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-novo-grupo')">&times;</button>
            </div>
            <form method="post" action="/painel/adicionais">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome do Grupo *
                        <input name="nome" placeholder="Ex: Bordas Recheadas" required>
                    </label>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Quantidade Mínima *
                            <input type="number" name="minimo" value="0" min="0" required>
                        </label>
                        <label class="bo-field">
                            Quantidade Máxima *
                            <input type="number" name="maximo" value="1" min="1" required>
                        </label>
                    </div>

                    <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                        <input type="checkbox" name="obrigatorio" value="1">
                        Escolha obrigatória pelo cliente no cardápio
                    </label>

                    <div>
                        <strong style="display: block; margin-bottom: 8px;">Vincular a Produtos:</strong>
                        <div style="max-height: 180px; overflow-y: auto; border: 1px solid var(--bo-line); border-radius: 8px; padding: 10px; display: grid; gap: 8px;">
                            <?php foreach ($products as $p): ?>
                                <label style="display: flex; align-items: center; gap: 8px; font-size: 0.9rem; cursor: pointer;">
                                    <input type="checkbox" name="produtos[]" value="<?= (int)$p['id'] ?>">
                                    <?= htmlspecialchars((string)$p['nome'], ENT_QUOTES, 'UTF-8') ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-novo-grupo')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Grupo</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Grupo -->
    <div id="modal-editar-grupo" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal bo-modal-lg" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Editar Grupo</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-editar-grupo')">&times;</button>
            </div>
            <form id="form-editar-grupo" method="post" action="">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome do Grupo *
                        <input id="edit-group-nome" name="nome" required>
                    </label>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Quantidade Mínima *
                            <input type="number" id="edit-group-minimo" name="minimo" min="0" required>
                        </label>
                        <label class="bo-field">
                            Quantidade Máxima *
                            <input type="number" id="edit-group-maximo" name="maximo" min="1" required>
                        </label>
                    </div>

                    <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                        <input type="checkbox" id="edit-group-obrigatorio" name="obrigatorio" value="1">
                        Escolha obrigatória pelo cliente no cardápio
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-editar-grupo')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        function editarGrupo(g) {
            document.getElementById('form-editar-grupo').action = '/painel/adicionais/' + g.id + '/editar';
            document.getElementById('edit-group-nome').value = g.nome || '';
            document.getElementById('edit-group-minimo').value = g.minimo || 0;
            document.getElementById('edit-group-maximo').value = g.maximo || 1;
            document.getElementById('edit-group-obrigatorio').checked = g.obrigatorio == 1;
            openModal('modal-editar-grupo');
        }

        function loadPreset(type) {
            const presets = {
                pizzaria: { nome: '🍕 Escolha a Borda Recheada', minimo: 0, maximo: 1, obrigatorio: false },
                hamburgueria: { nome: '🍔 Escolha o Ponto da Carne', minimo: 1, maximo: 1, obrigatorio: true },
                acaiteria: { nome: '🍧 Escolha os Acompanhamentos Grátis', minimo: 0, maximo: 3, obrigatorio: false },
                confeitaria: { nome: '🍰 Escolha a Cobertura Especial', minimo: 1, maximo: 1, obrigatorio: true },
                sushi: { nome: '🍱 Escolha os Molhos & Hashi', minimo: 0, maximo: 2, obrigatorio: false }
            };

            const selected = presets[type];
            if (!selected) return;

            const modal = document.getElementById('modal-novo-grupo');
            modal.querySelector('input[name="nome"]').value = selected.nome;
            modal.querySelector('input[name="minimo"]').value = selected.minimo;
            modal.querySelector('input[name="maximo"]').value = selected.maximo;
            modal.querySelector('input[name="obrigatorio"]').checked = selected.obrigatorio;

            openModal('modal-novo-grupo');
        }
    </script>
</body>
</html>
