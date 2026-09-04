<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador de Pedidos - Painel</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
    <style>
        .order-tabs { display: flex; gap: 8px; overflow-x: auto; margin-bottom: 20px; padding-bottom: 6px; }
        .order-tab { padding: 8px 14px; border-radius: 999px; border: 1px solid var(--bo-line); background: #fff; text-decoration: none; color: var(--bo-text); font-weight: 600; font-size: 0.88rem; white-space: nowrap; display: flex; align-items: center; gap: 6px; }
        .order-tab.is-active { background: var(--bo-primary); color: #fff; border-color: var(--bo-primary); }
        .order-tab-badge { background: rgba(0,0,0,0.12); padding: 2px 6px; border-radius: 10px; font-size: 0.76rem; }
        .order-tab.is-active .order-tab-badge { background: rgba(255,255,255,0.25); color: #fff; }
        
        .order-card { background: #fff; border: 1px solid var(--bo-line); border-radius: 14px; padding: 16px; margin-bottom: 14px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); transition: transform 0.15s ease; }
        .order-card.is-new { border-left: 5px solid var(--bo-danger); background: #fff5f5; animation: pulseOrder 2s infinite; }
        @keyframes pulseOrder { 0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(220, 38, 38, 0); } 100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); } }

        .order-head { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--bo-line); padding-bottom: 10px; margin-bottom: 10px; }
        .order-number { font-size: 1.1rem; font-weight: 800; color: var(--bo-text); }
        .order-status-badge { padding: 4px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; }
        .status-pendente { background: #fef2f2; color: #dc2626; }
        .status-aceito { background: #eff6ff; color: #2563eb; }
        .status-em_preparo { background: #fefce8; color: #ca8a04; }
        .status-pronto { background: #f0fdf4; color: #16a34a; }
        .status-saiu_entrega { background: #faf5ff; color: #9333ea; }
        .status-finalizado { background: #f3f4f6; color: #4b5563; }
        .status-cancelado { background: #fee2e2; color: #991b1b; }

        .order-customer { font-weight: 700; margin-bottom: 4px; display: flex; align-items: center; gap: 8px; }
        .order-meta { color: var(--bo-muted); font-size: 0.88rem; margin-bottom: 10px; }
        .order-actions { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 12px; border-top: 1px dashed var(--bo-line); padding-top: 12px; }
    </style>
</head>
<body class="backoffice-body">
    <main class="backoffice-shell">
        <div class="backoffice-layout">
            <?php $backofficeSection = 'pedidos'; require __DIR__ . '/../../partials/backoffice-sidebar.php'; ?>
            <div class="backoffice-content">
                <header class="backoffice-topbar">
                    <div class="backoffice-brand">
                        <span class="backoffice-kicker">Gestão Operacional</span>
                        <h1 class="backoffice-title">Pedidos em Tempo Real</h1>
                        <p class="backoffice-subtitle">Gerencie o fluxo de entrada, aceite, preparo e entrega dos pedidos do seu restaurante.</p>
                    </div>
                    <div class="backoffice-actions">
                        <button type="button" class="bo-link bo-link-secondary" onclick="enableAudioAlert()">🔔 Ativar Alerta Sonoro</button>
                    </div>
                </header>

                <?php require __DIR__ . '/../../partials/flash-messages.php'; ?>

                <!-- Abas de Filtros de Status -->
                <nav class="order-tabs">
                    <a href="/painel/pedidos" class="order-tab <?= $currentStatus === '' ? 'is-active' : '' ?>">
                        Todos <span class="order-tab-badge"><?= array_sum($counts) ?></span>
                    </a>
                    <a href="/painel/pedidos?status=pendente" class="order-tab <?= $currentStatus === 'pendente' ? 'is-active' : '' ?>" style="border-color:#dc2626;">
                        🚨 Novos <span class="order-tab-badge" id="badge-pendente"><?= $counts['pendente'] ?></span>
                    </a>
                    <a href="/painel/pedidos?status=aceito" class="order-tab <?= $currentStatus === 'aceito' ? 'is-active' : '' ?>">
                        Em Aceite <span class="order-tab-badge"><?= $counts['aceito'] ?></span>
                    </a>
                    <a href="/painel/pedidos?status=em_preparo" class="order-tab <?= $currentStatus === 'em_preparo' ? 'is-active' : '' ?>">
                        👨‍🍳 Em Preparo <span class="order-tab-badge"><?= $counts['em_preparo'] ?></span>
                    </a>
                    <a href="/painel/pedidos?status=pronto" class="order-tab <?= $currentStatus === 'pronto' ? 'is-active' : '' ?>">
                        ✅ Prontos <span class="order-tab-badge"><?= $counts['pronto'] ?></span>
                    </a>
                    <a href="/painel/pedidos?status=saiu_entrega" class="order-tab <?= $currentStatus === 'saiu_entrega' ? 'is-active' : '' ?>">
                        🛵 Em Entrega <span class="order-tab-badge"><?= $counts['saiu_entrega'] ?></span>
                    </a>
                    <a href="/painel/pedidos?status=finalizado" class="order-tab <?= $currentStatus === 'finalizado' ? 'is-active' : '' ?>">
                        🏁 Finalizados <span class="order-tab-badge"><?= $counts['finalizado'] ?></span>
                    </a>
                    <a href="/painel/pedidos?status=cancelado" class="order-tab <?= $currentStatus === 'cancelado' ? 'is-active' : '' ?>">
                        ❌ Cancelados <span class="order-tab-badge"><?= $counts['cancelado'] ?></span>
                    </a>
                </nav>

                <?php if ($currentStatus === 'cancelado' && ($counts['cancelado'] ?? 0) > 0): ?>
                    <div style="margin-bottom: 16px; text-align: right;">
                        <form method="post" action="/painel/pedidos/limpar-cancelados" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja apagar TODOS os pedidos cancelados? Esta ação não pode ser desfeita.');">
                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="bo-link bo-link-danger">🗑️ Apagar Todos os Cancelados (<?= (int)$counts['cancelado'] ?>)</button>
                        </form>
                    </div>
                <?php endif; ?>

                <!-- Lista de Pedidos -->
                <section id="orders-container">
                    <?php if (empty($orders)): ?>
                        <div style="text-align: center; padding: 40px 20px; background: #fff; border-radius: 14px; color: var(--bo-muted);">
                            <p style="font-size: 1.1rem;">Nenhum pedido encontrado nesta categoria.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($orders as $o): ?>
                            <?php $isNew = in_array($o['status'], ['novo', 'pendente'], true); ?>
                            <article class="order-card <?= $isNew ? 'is-new' : '' ?>" id="order-card-<?= (int)$o['id'] ?>">
                                <div class="order-head">
                                    <div>
                                        <span class="order-number">#<?= htmlspecialchars((string) $o['numero'], ENT_QUOTES, 'UTF-8') ?></span>
                                        <span style="color: var(--bo-muted); font-size: 0.84rem; margin-left: 8px;">
                                            <?= !empty($o['criado_em']) ? date('H:i', strtotime($o['criado_em'])) : '' ?>
                                        </span>
                                    </div>
                                    <span class="order-status-badge status-<?= $isNew ? 'pendente' : htmlspecialchars((string) $o['status'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= $isNew ? 'novo' : htmlspecialchars((string) $o['status'], ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </div>

                                <div class="order-customer">
                                    👤 <?= htmlspecialchars((string) $o['cliente_nome'], ENT_QUOTES, 'UTF-8') ?>
                                    <span style="font-weight: normal; color: var(--bo-muted); font-size: 0.85rem;">(<?= htmlspecialchars((string) $o['cliente_whatsapp'], ENT_QUOTES, 'UTF-8') ?>)</span>
                                </div>

                                <div class="order-meta">
                                    <span>🛒 <?= (int)$o['total_itens'] ?> itens</span> •
                                    <span>💰 R$ <?= number_format((float)$o['total'], 2, ',', '.') ?> (<?= htmlspecialchars((string)$o['forma_pagamento_nome'], ENT_QUOTES, 'UTF-8') ?>)</span> •
                                    <span>📍 <?= $o['tipo_recebimento'] === 'delivery' ? 'Delivery (' . htmlspecialchars((string)$o['bairro_nome'], ENT_QUOTES, 'UTF-8') . ')' : 'Retirada no Balcão' ?></span>
                                </div>

                                <div class="order-actions">
                                    <button type="button" class="bo-link bo-link-secondary" style="font-size: 0.82rem;" onclick="verDetalhes(<?= (int)$o['id'] ?>)">🔍 Detalhes</button>
                                    <a href="/painel/pedidos/<?= (int)$o['id'] ?>/imprimir" target="_blank" class="bo-link bo-link-secondary" style="font-size: 0.82rem; text-decoration:none;">🖨️ Imprimir</a>
                                    
                                    <?php if ($isNew): ?>
                                        <form method="post" action="/painel/pedidos/<?= (int)$o['id'] ?>/status" style="display:inline;">
                                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="status" value="aceito">
                                            <button type="submit" class="bo-link bo-link-primary" style="font-size: 0.82rem;">✅ Aceitar Pedido</button>
                                        </form>
                                    <?php elseif ($o['status'] === 'aceito'): ?>
                                        <form method="post" action="/painel/pedidos/<?= (int)$o['id'] ?>/status" style="display:inline;">
                                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="status" value="em_preparo">
                                            <button type="submit" class="bo-link bo-link-primary" style="font-size: 0.82rem;">👨‍🍳 Iniciar Preparo</button>
                                        </form>
                                    <?php elseif ($o['status'] === 'em_preparo'): ?>
                                        <form method="post" action="/painel/pedidos/<?= (int)$o['id'] ?>/status" style="display:inline;">
                                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="status" value="pronto">
                                            <button type="submit" class="bo-link bo-link-primary" style="font-size: 0.82rem;">🔔 Marcar Pronto</button>
                                        </form>
                                    <?php elseif ($o['status'] === 'pronto'): ?>
                                        <form method="post" action="/painel/pedidos/<?= (int)$o['id'] ?>/status" style="display:inline;">
                                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="status" value="<?= $o['tipo_recebimento'] === 'delivery' ? 'saiu_entrega' : 'finalizado' ?>">
                                            <button type="submit" class="bo-link bo-link-primary" style="font-size: 0.82rem;">
                                                <?= $o['tipo_recebimento'] === 'delivery' ? '🛵 Saiu p/ Entrega' : '📦 Entregue / Finalizar' ?>
                                            </button>
                                        </form>
                                    <?php elseif ($o['status'] === 'saiu_entrega' || $o['status'] === 'saiu_para_entrega'): ?>
                                        <form method="post" action="/painel/pedidos/<?= (int)$o['id'] ?>/status" style="display:inline;">
                                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="status" value="finalizado">
                                            <button type="submit" class="bo-link bo-link-primary" style="font-size: 0.82rem;">🏁 Finalizar Pedido</button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if ($o['status'] !== 'finalizado' && $o['status'] !== 'cancelado'): ?>
                                        <form method="post" action="/painel/pedidos/<?= (int)$o['id'] ?>/status" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja cancelar este pedido?');">
                                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="status" value="cancelado">
                                            <button type="submit" class="bo-link bo-link-danger" style="font-size: 0.82rem;">❌ Cancelar</button>
                                        </form>
                                    <?php elseif ($o['status'] === 'cancelado'): ?>
                                        <form method="post" action="/painel/pedidos/<?= (int)$o['id'] ?>/excluir" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja apagar este pedido do histórico?');">
                                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                            <button type="submit" class="bo-link bo-link-danger" style="font-size: 0.82rem;">🗑️ Apagar Pedido</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </main>

    <!-- Modal Detalhes do Pedido -->
    <div id="modal-detalhes-pedido" class="bo-modal-backdrop" aria-hidden="true">
        <div class="bo-modal bo-modal-lg" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title" id="modal-pedido-titulo">Detalhes do Pedido</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('modal-detalhes-pedido')">&times;</button>
            </div>
            <div class="bo-modal-body" id="modal-pedido-corpo" style="display: grid; gap: 16px;">
                <!-- Carregado via JS -->
            </div>
            <div class="bo-modal-footer">
                <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('modal-detalhes-pedido')">Fechar</button>
            </div>
        </div>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/backoffice.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script>
        let audioContext = null;

        function enableAudioAlert() {
            audioContext = new (window.AudioContext || window.webkitAudioContext)();
            alert('Alerta sonoro ativado para novos pedidos!');
        }

        function playBeep() {
            if (!audioContext) return;
            const osc = audioContext.createOscillator();
            const gain = audioContext.createGain();
            osc.connect(gain);
            gain.connect(audioContext.destination);
            osc.frequency.value = 880;
            gain.gain.setValueAtTime(0.5, audioContext.currentTime);
            osc.start();
            osc.stop(audioContext.currentTime + 0.4);
        }

        async function verDetalhes(id) {
            document.getElementById('modal-pedido-corpo').innerHTML = '<p>Carregando detalhes...</p>';
            openModal('modal-detalhes-pedido');

            try {
                const res = await fetch('/painel/pedidos/' + id);
                const data = await res.json();
                if (!data.success) {
                    document.getElementById('modal-pedido-corpo').innerHTML = '<p>Erro ao carregar detalhes.</p>';
                    return;
                }

                const o = data.order;
                document.getElementById('modal-pedido-titulo').textContent = 'Pedido #' + o.numero + ' (' + o.cliente_nome + ')';

                let html = `
                    <div>
                        <strong>Cliente:</strong> ${o.cliente_nome} (${o.cliente_whatsapp})<br>
                        <strong>Tipo:</strong> ${o.tipo_recebimento === 'delivery' ? 'Delivery' : 'Retirada Balcão'}<br>
                        ${o.tipo_recebimento === 'delivery' ? `<strong>Endereço:</strong> ${o.endereco}, ${o.numero_endereco} - ${o.bairro_nome} ${o.complemento ? '('+o.complemento+')' : ''}<br>` : ''}
                        <strong>Pagamento:</strong> ${o.forma_pagamento_nome} ${o.troco_para ? '- Troco para R$ ' + parseFloat(o.troco_para).toFixed(2) : ''}<br>
                        ${o.observacao ? `<div style="background:#fff7ed; padding:8px; border-radius:6px; margin-top:8px;"><strong>Obs:</strong> ${o.observacao}</div>` : ''}
                    </div>
                    <hr style="border:0; border-top:1px solid #eee;">
                    <h4>Itens do Pedido:</h4>
                    <div style="display:grid; gap:10px;">
                `;

                (o.itens || []).forEach(item => {
                    const qty = parseInt(item.quantidade) || 1;
                    const itemTotal = parseFloat(item.valor_total || 0);
                    html += `
                        <div style="border:1px solid #eee; padding:10px; border-radius:8px; background:#fafafa;">
                            <div style="display:flex; justify-content:space-between; font-weight:700;">
                                <span>${qty}x ${item.produto_nome} ${item.variacao_nome ? '('+item.variacao_nome+')' : ''}</span>
                                <span>R$ ${itemTotal.toFixed(2).replace('.', ',')}</span>
                            </div>
                            ${(item.adicionais || []).length ? `<div style="font-size:0.85rem; color:#666; margin-top:4px;">+ Adicionais: ${item.adicionais.map(a => a.adicional_nome).join(', ')}</div>` : ''}
                            ${item.observacao ? `<div style="font-size:0.85rem; color:#d97706; margin-top:4px;">Obs: ${item.observacao}</div>` : ''}
                        </div>
                    `;
                });

                html += `</div>
                    <div style="text-align:right; font-size:1.1rem; font-weight:800; margin-top:12px;">
                        Subtotal: R$ ${parseFloat(o.subtotal).toFixed(2).replace('.', ',')} | Frete: R$ ${parseFloat(o.taxa_entrega).toFixed(2).replace('.', ',')} <br>
                        <span style="color:var(--bo-primary);">Total: R$ ${parseFloat(o.total).toFixed(2).replace('.', ',')}</span>
                    </div>
                `;

                document.getElementById('modal-pedido-corpo').innerHTML = html;
            } catch (err) {
                document.getElementById('modal-pedido-corpo').innerHTML = '<p>Erro de conexão ao carregar pedido.</p>';
            }
        }

        // Polling para novos pedidos a cada 10 segundos
        let lastPendenteCount = <?= (int) $counts['pendente'] ?>;
        setInterval(async () => {
            try {
                const res = await fetch('/painel/pedidos/polling');
                const data = await res.json();
                if (data.success && data.counts) {
                    const newPendente = data.counts.pendente || 0;
                    if (newPendente > lastPendenteCount) {
                        playBeep();
                    }
                    lastPendenteCount = newPendente;
                    const badge = document.getElementById('badge-pendente');
                    if (badge) badge.textContent = newPendente;
                }
            } catch (e) {}
        }, 10000);
    </script>
</body>
</html>
