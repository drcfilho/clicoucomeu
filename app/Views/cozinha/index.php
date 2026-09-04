<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KDS - Tela da Cozinha</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/backoffice.css'), ENT_QUOTES, 'UTF-8') ?>">
    <style>
        body.kds-body { background: #0f172a; color: #f8fafc; font-family: system-ui, -apple-system, sans-serif; }
        .kds-header { background: #1e293b; padding: 16px 24px; border-bottom: 2px solid #334155; display: flex; justify-content: space-between; align-items: center; }
        .kds-title { margin: 0; font-size: 1.5rem; font-weight: 800; color: #38bdf8; display: flex; align-items: center; gap: 10px; }
        
        .kds-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 16px; padding: 20px; }
        .kds-card { background: #1e293b; border: 2px solid #334155; border-radius: 16px; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
        .kds-card.is-preparing { border-color: #f59e0b; }
        .kds-card.is-new { border-color: #ef4444; animation: kdsPulse 1.8s infinite; }

        @keyframes kdsPulse {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.6); }
            70% { box-shadow: 0 0 0 12px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        .kds-card-head { padding: 14px 16px; background: #0f172a; border-bottom: 1px solid #334155; display: flex; justify-content: space-between; align-items: center; }
        .kds-card-num { font-size: 1.4rem; font-weight: 900; color: #f8fafc; }
        .kds-card-time { background: #334155; padding: 4px 10px; border-radius: 20px; font-size: 0.88rem; font-weight: 800; color: #fbbf24; }

        .kds-card-body { padding: 16px; flex: 1; display: grid; gap: 12px; }
        .kds-item { background: #0f172a; border: 1px solid #334155; border-radius: 10px; padding: 12px; }
        .kds-item-title { font-size: 1.15rem; font-weight: 800; color: #ffffff; }
        .kds-item-addons { color: #cbd5e1; font-size: 0.92rem; margin-top: 6px; }
        .kds-item-notes { background: #7c2d12; color: #fef08a; padding: 6px 10px; border-radius: 6px; margin-top: 8px; font-weight: 700; font-size: 0.9rem; }

        .kds-order-obs { background: #451a03; border: 1px solid #92400e; color: #fef08a; padding: 10px; border-radius: 8px; font-weight: 800; }

        .kds-card-foot { padding: 14px 16px; background: #0f172a; border-top: 1px solid #334155; }
        .kds-btn { width: 100%; padding: 14px; border-radius: 12px; border: 0; font-size: 1.1rem; font-weight: 900; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: transform 0.1s ease; }
        .kds-btn-start { background: #f59e0b; color: #000; }
        .kds-btn-ready { background: #22c55e; color: #000; }
    </style>
</head>
<body class="kds-body">
    <header class="kds-header">
        <h1 class="kds-title">👨‍🍳 KDS - Cozinha e Fila de Preparo</h1>
        <div style="display: flex; gap: 12px; align-items: center;">
            <a href="/painel" style="color: #94a3b8; text-decoration: none; font-weight: 700;">Voltar ao Painel</a>
        </div>
    </header>

    <main class="kds-grid" id="kds-container">
        <?php if (empty($orders)): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #94a3b8;">
                <h2>Nenhum pedido pendente na cozinha no momento. 🎉</h2>
            </div>
        <?php else: ?>
            <?php foreach ($orders as $o): ?>
                <?php 
                $createdTs = strtotime($o['criado_em']);
                $minutesAgo = floor((time() - $createdTs) / 60);
                $isPreparing = in_array($o['status'], ['em_preparo', 'preparando'], true);
                ?>
                <article class="kds-card <?= $isPreparing ? 'is-preparing' : 'is-new' ?>">
                    <div class="kds-card-head">
                        <span class="kds-card-num">#<?= htmlspecialchars((string)$o['numero'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars((string)$o['cliente_nome'], ENT_QUOTES, 'UTF-8') ?>)</span>
                        <span class="kds-card-time">⏱️ <?= (int)$minutesAgo ?> min</span>
                    </div>

                    <div class="kds-card-body">
                        <?php if (!empty($o['observacao'])): ?>
                            <div class="kds-order-obs">
                                ⚠️ OBS DO PEDIDO: <?= htmlspecialchars((string)$o['observacao'], ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        <?php endif; ?>

                        <div style="display: grid; gap: 10px;">
                            <?php foreach ($o['itens'] as $item): ?>
                                <div class="kds-item">
                                    <div class="kds-item-title">
                                        <?= (int)$item['quantidade'] ?>x <?= htmlspecialchars((string)$item['produto_nome'], ENT_QUOTES, 'UTF-8') ?>
                                        <?= !empty($item['variacao_nome']) ? ' (' . htmlspecialchars((string)$item['variacao_nome'], ENT_QUOTES, 'UTF-8') . ')' : '' ?>
                                    </div>
                                    
                                    <?php if (!empty($item['adicionais'])): ?>
                                        <div class="kds-item-addons">
                                            + <?= implode(', ', array_map(fn($a) => htmlspecialchars($a['adicional_nome'], ENT_QUOTES, 'UTF-8'), $item['adicionais'])) ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($item['observacao'])): ?>
                                        <div class="kds-item-notes">
                                            OBS: <?= htmlspecialchars((string)$item['observacao'], ENT_QUOTES, 'UTF-8') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="kds-card-foot">
                        <?php if ($isPreparing): ?>
                            <form method="post" action="/cozinha/<?= (int)$o['id'] ?>/status">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="status" value="pronto">
                                <button type="submit" class="kds-btn kds-btn-ready">✅ Marcar como Pronto</button>
                            </form>
                        <?php else: ?>
                            <form method="post" action="/cozinha/<?= (int)$o['id'] ?>/status">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars((string)$csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="status" value="preparando">
                                <button type="submit" class="kds-btn kds-btn-start">🔥 Iniciar Preparo</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <script>
        // Polling automatico da cozinha a cada 6 segundos com re-renderizacao dinamica
        let lastOrdersHash = '';

        async function updateKitchenOrders() {
            try {
                const res = await fetch('/cozinha/polling?_t=' + Date.now(), { cache: 'no-store' });
                const data = await res.json();
                if (!data.success) return;

                const currentHash = JSON.stringify(data.orders.map(o => ({ id: o.id, status: o.status, total_itens: (o.itens || []).length })));
                if (lastOrdersHash !== '' && currentHash !== lastOrdersHash) {
                    window.location.reload();
                }
                lastOrdersHash = currentHash;
            } catch (e) {}
        }

        setInterval(updateKitchenOrders, 6000);
    </script>
</body>
</html>
