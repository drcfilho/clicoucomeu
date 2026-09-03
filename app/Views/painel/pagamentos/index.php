<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formas de Pagamento - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'pagamentos'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Financeiro</span>
                        <h1 class="backoffice-title">Formas de Pagamento</h1>
                        <p class="backoffice-subtitle">Configure Dinheiro com solicitação de troco, chave Pix e maquininhas de cartão.</p>
                    </div>
                    <div class="backoffice-actions">
                        <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-nova-forma')">+ Nova Forma de Pagamento</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <section class="bo-panel">
                    <?php if (empty($methods)): ?>
                        <div style="text-align: center; padding: 40px 20px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem; margin-bottom: 16px;">Nenhuma forma de pagamento cadastrada ainda.</p>
                            <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-nova-forma')">Cadastrar Primeira Forma</button>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--bo-line); text-align: left; color: var(--bo-muted);">
                                        <th style="padding: 12px 8px; width: 60px;">Ordem</th>
                                        <th style="padding: 12px 8px;">Nome da Forma</th>
                                        <th style="padding: 12px 8px;">Tipo</th>
                                        <th style="padding: 12px 8px;">Detalhes / Troco</th>
                                        <th style="padding: 12px 8px; width: 100px;">Status</th>
                                        <th style="padding: 12px 8px; text-align: right; width: 180px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($methods as $m): ?>
                                        <tr style="border-bottom: 1px solid var(--bo-line);">
                                            <td style="padding: 14px 8px; font-weight: bold;"><?= (int) $m['ordem'] ?></td>
                                            <td style="padding: 14px 8px; font-weight: 600;"><?= htmlspecialchars((string) $m['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td style="padding: 14px 8px; color: var(--bo-muted); text-transform: capitalize;">
                                                <?= htmlspecialchars((string) $m['tipo'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 14px 8px; color: var(--bo-muted);">
                                                <?php if ($m['tipo'] === 'dinheiro'): ?>
                                                    <?= $m['pedir_troco'] ? 'Solicita valor do troco' : 'Sem necessidade de troco' ?>
                                                <?php elseif ($m['tipo'] === 'pix' && !empty($m['dados_pix'])): ?>
                                                    Chave Pix: <strong><?= htmlspecialchars((string)$m['dados_pix'], ENT_QUOTES, 'UTF-8') ?></strong>
                                                <?php else: ?>
                                                    Maquininha na entrega
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px;">
                                                <?php if ($m['ativo']): ?>
                                                    <span style="background: var(--bo-success-bg); color: var(--bo-success); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Ativo</span>
                                                <?php else: ?>
                                                    <span style="background: var(--bo-danger-bg); color: var(--bo-danger); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Inativo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px; text-align: right; display: flex; gap: 6px; justify-content: flex-end;">
                                                <button type="button" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;" 
                                                        onclick="editarForma(<?= htmlspecialchars(json_encode($m), ENT_QUOTES, 'UTF-8') ?>)">
                                                    Editar
                                                </button>
                                                <form method="post" action="/painel/pagamentos/<?= (int)$m['id'] ?>/toggle" style="display: inline;">
                                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;">
                                                        <?= $m['ativo'] ? 'Desativar' : 'Ativar' ?>
                                                    </button>
                                                </form>
                                                <form method="post" action="/painel/pagamentos/<?= (int)$m['id'] ?>/excluir" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta forma de pagamento?');">
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

    <!-- Modal Nova Forma de Pagamento -->
    <div id="modal-nova-forma" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Nova Forma de Pagamento</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-nova-forma')">&times;</button>
            </div>
            <form method="post" action="/painel/pagamentos">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome de Exibição *
                        <input name="nome" placeholder="Ex: Cartão de Crédito (Maquininha)" required>
                    </label>

                    <label class="bo-field">
                        Tipo de Pagamento *
                        <select name="tipo" required onchange="toggleTipoFields(this.value, 'nova')">
                            <option value="dinheiro">Dinheiro</option>
                            <option value="pix">Pix</option>
                            <option value="credito">Cartão de Crédito</option>
                            <option value="debito">Cartão de Débito</option>
                            <option value="outro">Outro</option>
                        </select>
                    </label>

                    <div id="nova-field-dinheiro">
                        <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                            <input type="checkbox" name="pedir_troco" value="1" checked>
                            Perguntar no checkout se o cliente precisa de troco
                        </label>
                    </div>

                    <div id="nova-field-pix" style="display: none;">
                        <label class="bo-field">
                            Chave Pix / Instruções de Pagamento (opcional)
                            <input name="dados_pix" placeholder="CNPJ, E-mail ou Celular">
                        </label>
                    </div>

                    <label class="bo-field">
                        Ordem de Exibição
                        <input type="number" name="ordem" placeholder="Opcional">
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-nova-forma')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Forma</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Forma de Pagamento -->
    <div id="modal-editar-forma" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Editar Forma de Pagamento</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-editar-forma')">&times;</button>
            </div>
            <form id="form-editar-forma" method="post" action="">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 16px;">
                    <label class="bo-field">
                        Nome de Exibição *
                        <input id="edit-pay-nome" name="nome" required>
                    </label>

                    <label class="bo-field">
                        Tipo de Pagamento *
                        <select id="edit-pay-tipo" name="tipo" required onchange="toggleTipoFields(this.value, 'edit')">
                            <option value="dinheiro">Dinheiro</option>
                            <option value="pix">Pix</option>
                            <option value="credito">Cartão de Crédito</option>
                            <option value="debito">Cartão de Débito</option>
                            <option value="outro">Outro</option>
                        </select>
                    </label>

                    <div id="edit-field-dinheiro">
                        <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                            <input type="checkbox" id="edit-pay-troco" name="pedir_troco" value="1">
                            Perguntar no checkout se o cliente precisa de troco
                        </label>
                    </div>

                    <div id="edit-field-pix" style="display: none;">
                        <label class="bo-field">
                            Chave Pix / Instruções de Pagamento
                            <input id="edit-pay-pix" name="dados_pix">
                        </label>
                    </div>

                    <label class="bo-field">
                        Ordem de Exibição
                        <input type="number" id="edit-pay-ordem" name="ordem" required>
                    </label>

                    <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                        <input type="checkbox" id="edit-pay-ativo" name="ativo" value="1">
                        Forma de pagamento ativa
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-editar-forma')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Atualizar Forma</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        function toggleTipoFields(val, prefix) {
            const fieldDinheiro = document.getElementById(prefix + '-field-dinheiro');
            const fieldPix = document.getElementById(prefix + '-field-pix');

            if (fieldDinheiro) fieldDinheiro.style.display = (val === 'dinheiro') ? 'block' : 'none';
            if (fieldPix) fieldPix.style.display = (val === 'pix') ? 'block' : 'none';
        }

        function editarForma(m) {
            document.getElementById('form-editar-forma').action = '/painel/pagamentos/' + m.id + '/editar';
            document.getElementById('edit-pay-nome').value = m.nome || '';
            document.getElementById('edit-pay-tipo').value = m.tipo || 'dinheiro';
            document.getElementById('edit-pay-troco').checked = m.pedir_troco == 1;
            document.getElementById('edit-pay-pix').value = m.dados_pix || '';
            document.getElementById('edit-pay-ordem').value = m.ordem || 0;
            document.getElementById('edit-pay-ativo').checked = m.ativo == 1;
            
            toggleTipoFields(m.tipo, 'edit');
            openModal('modal-editar-forma');
        }
    </script>
</body>
</html>
