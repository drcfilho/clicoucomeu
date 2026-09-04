<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cupons de Desconto - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'cupons'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Marketing</span>
                        <h1 class="backoffice-title">Cupons de Desconto</h1>
                        <p class="backoffice-subtitle">Crie cupons de porcentagem, valor fixo ou frete grátis com regras de uso.</p>
                    </div>
                    <div class="backoffice-actions">
                        <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-cupom')">+ Novo Cupom</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <section class="bo-panel">
                    <?php if (empty($coupons)): ?>
                        <div style="text-align: center; padding: 40px 20px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem; margin-bottom: 16px;">Nenhum cupom de desconto cadastrado ainda.</p>
                            <button type="button" class="bo-link bo-link-primary" onclick="openModal('modal-novo-cupom')">Criar Primeiro Cupom</button>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--bo-line); text-align: left; color: var(--bo-muted);">
                                        <th style="padding: 12px 8px;">Código</th>
                                        <th style="padding: 12px 8px;">Tipo & Valor</th>
                                        <th style="padding: 12px 8px;">Mínimo</th>
                                        <th style="padding: 12px 8px;">Usos</th>
                                        <th style="padding: 12px 8px; width: 100px;">Status</th>
                                        <th style="padding: 12px 8px; text-align: right; width: 180px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($coupons as $c): ?>
                                        <tr style="border-bottom: 1px solid var(--bo-line);">
                                            <td style="padding: 14px 8px; font-weight: 800; color: var(--bo-primary);">
                                                🎟️ <?= htmlspecialchars((string) $c['codigo'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 14px 8px; font-weight: 700;">
                                                <?php if ($c['tipo'] === 'percentual'): ?>
                                                    <?= number_format((float)$c['valor'], 0) ?>% de desconto
                                                <?php elseif ($c['tipo'] === 'valor'): ?>
                                                    R$ <?= number_format((float)$c['valor'], 2, ',', '.') ?> de desconto
                                                <?php else: ?>
                                                    🚚 Frete Grátis
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px; color: var(--bo-muted);">
                                                <?= (float)$c['valor_minimo'] > 0 ? 'R$ ' . number_format((float)$c['valor_minimo'], 2, ',', '.') : 'Sem mínimo' ?>
                                            </td>
                                            <td style="padding: 14px 8px; color: var(--bo-muted);">
                                                <?= (int)$c['usos'] ?> <?= $c['limite_usos'] ? '/ ' . (int)$c['limite_usos'] : 'usos' ?>
                                            </td>
                                            <td style="padding: 14px 8px;">
                                                <?php if ($c['ativo']): ?>
                                                    <span style="background: var(--bo-success-bg); color: var(--bo-success); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Ativo</span>
                                                <?php else: ?>
                                                    <span style="background: var(--bo-danger-bg); color: var(--bo-danger); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Inativo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 8px; text-align: right; display: flex; gap: 6px; justify-content: flex-end;">
                                                <button type="button" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;" 
                                                        onclick="editarCupom(<?= htmlspecialchars(json_encode($c), ENT_QUOTES, 'UTF-8') ?>)">
                                                    Editar
                                                </button>
                                                <form method="post" action="/painel/cupons/<?= (int)$c['id'] ?>/toggle" style="display: inline;">
                                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="bo-link bo-link-secondary" style="padding: 4px 10px; font-size: 0.82rem;">
                                                        <?= $c['ativo'] ? 'Desativar' : 'Ativar' ?>
                                                    </button>
                                                </form>
                                                <form method="post" action="/painel/cupons/<?= (int)$c['id'] ?>/excluir" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cupom?');">
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

    <!-- Modal Novo Cupom -->
    <div id="modal-novo-cupom" class="bo-modal" aria-hidden="true">
        <div class="bo-modal-backdrop" onclick="closeModal('modal-novo-cupom')"></div>
        <div class="bo-modal-dialog">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Novo Cupom de Desconto</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-novo-cupom')">&times;</button>
            </div>
            <form method="post" action="/painel/cupons">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 14px;">
                    <label class="bo-field">
                        Código do Cupom *
                        <input name="codigo" placeholder="Ex: PRIMEIRACOMPRA ou PIZZA10" style="text-transform: uppercase;" required>
                    </label>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Tipo de Desconto *
                            <select name="tipo" required>
                                <option value="percentual">Porcentagem (%)</option>
                                <option value="valor">Valor Fixo (R$)</option>
                                <option value="frete_gratis">Frete Grátis</option>
                            </select>
                        </label>
                        <label class="bo-field">
                            Valor do Desconto *
                            <input name="valor" placeholder="Ex: 10 para 10% ou 15,00 para R$15" required>
                        </label>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Pedido Mínimo (R$)
                            <input name="valor_minimo" placeholder="Ex: 50,00 (opcional)">
                        </label>
                        <label class="bo-field">
                            Limite de Usos Totais
                            <input type="number" name="limite_usos" placeholder="Ex: 100 (opcional)">
                        </label>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Data Início
                            <input type="datetime-local" name="data_inicio">
                        </label>
                        <label class="bo-field">
                            Data Fim (Validade)
                            <input type="datetime-local" name="data_fim">
                        </label>
                    </div>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-novo-cupom')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Salvar Cupom</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Cupom -->
    <div id="modal-editar-cupom" class="bo-modal" aria-hidden="true">
        <div class="bo-modal-backdrop" onclick="closeModal('modal-editar-cupom')"></div>
        <div class="bo-modal-dialog">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">Editar Cupom</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-editar-cupom')">&times;</button>
            </div>
            <form id="form-editar-cupom" method="post" action="">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <div class="bo-modal-body" style="display: grid; gap: 14px;">
                    <label class="bo-field">
                        Código do Cupom *
                        <input id="edit-coupon-codigo" name="codigo" style="text-transform: uppercase;" required>
                    </label>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Tipo de Desconto *
                            <select id="edit-coupon-tipo" name="tipo" required>
                                <option value="percentual">Porcentagem (%)</option>
                                <option value="valor">Valor Fixo (R$)</option>
                                <option value="frete_gratis">Frete Grátis</option>
                            </select>
                        </label>
                        <label class="bo-field">
                            Valor do Desconto *
                            <input id="edit-coupon-valor" name="valor" required>
                        </label>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <label class="bo-field">
                            Pedido Mínimo (R$)
                            <input id="edit-coupon-minimo" name="valor_minimo">
                        </label>
                        <label class="bo-field">
                            Limite de Usos Totais
                            <input type="number" id="edit-coupon-limite" name="limite_usos">
                        </label>
                    </div>

                    <label class="bo-field" style="flex-direction: row; align-items: center; gap: 8px;">
                        <input type="checkbox" id="edit-coupon-ativo" name="ativo" value="1">
                        Cupom Ativo
                    </label>
                </div>
                <div class="bo-modal-footer">
                    <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-editar-cupom')">Cancelar</button>
                    <button type="submit" class="bo-link bo-link-primary">Atualizar Cupom</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        function editarCupom(c) {
            document.getElementById('form-editar-cupom').action = '/painel/cupons/' + c.id + '/editar';
            document.getElementById('edit-coupon-codigo').value = c.codigo || '';
            document.getElementById('edit-coupon-tipo').value = c.tipo || 'percentual';
            document.getElementById('edit-coupon-valor').value = parseFloat(c.valor).toFixed(2).replace('.', ',');
            document.getElementById('edit-coupon-minimo').value = c.valor_minimo ? parseFloat(c.valor_minimo).toFixed(2).replace('.', ',') : '';
            document.getElementById('edit-coupon-limite').value = c.limite_usos || '';
            document.getElementById('edit-coupon-ativo').checked = c.ativo == 1;
            openModal('modal-editar-cupom');
        }
    </script>
</body>
</html>
