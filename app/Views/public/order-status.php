<?php
$statusLabels = [
    'novo' => 'Recebido',
    'aceito' => 'Confirmado',
    'preparando' => 'Preparando',
    'pronto' => 'Pronto',
    'saiu_para_entrega' => 'Saiu para entrega',
    'finalizado' => 'Finalizado',
    'retirado' => 'Retirado',
    'cancelado' => 'Cancelado',
];

$progressMap = [
    'novo' => 1,
    'aceito' => 2,
    'preparando' => 3,
    'pronto' => 4,
    'saiu_para_entrega' => 5,
    'finalizado' => 5,
    'retirado' => 5,
    'cancelado' => 0,
];

$status = (string) ($order['status'] ?? 'novo');
$statusLabel = $statusLabels[$status] ?? ucfirst($status);
$progress = $progressMap[$status] ?? 1;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido #<?= htmlspecialchars((string) $order['numero'], ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root {
            --bg: #f7f0e2;
            --card: #ffffff;
            --text: #2e241d;
            --muted: #746a61;
            --primary: #b47e11;
            --secondary: #935711;
            --line: #eadfcb;
            --success: #16a34a;
            --danger: #dc2626;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.75), transparent 28%),
                linear-gradient(180deg, #fffdfa 0%, var(--bg) 100%);
        }
        .wrap { width: min(760px, calc(100% - 24px)); margin: 0 auto; padding: 28px 0 48px; }
        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: 0 18px 40px rgba(36, 23, 11, 0.08);
            padding: 24px;
        }
        .hero { margin-bottom: 18px; }
        .eyebrow {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #fff7ed;
            color: var(--secondary);
            font-size: 12px;
            font-weight: 800;
        }
        h1 { margin: 12px 0 6px; font-size: clamp(1.5rem, 4vw, 2.2rem); }
        .muted { color: var(--muted); }
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 800;
            background: #fff7ed;
            color: var(--secondary);
        }
        .status-pill[data-status="cancelado"] {
            background: #fef2f2;
            color: var(--danger);
        }
        .status-pill[data-status="finalizado"],
        .status-pill[data-status="retirado"] {
            background: #ecfdf5;
            color: var(--success);
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin: 18px 0 24px;
        }
        .info {
            padding: 16px;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: #fffdfa;
        }
        .info small {
            display: block;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .info strong {
            display: block;
            font-size: 1.05rem;
        }
        .timeline {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }
        .step {
            text-align: center;
        }
        .dot {
            width: 16px;
            height: 16px;
            margin: 0 auto 10px;
            border-radius: 999px;
            border: 3px solid #d7cbb9;
            background: #fff;
        }
        .step.active .dot,
        .step.done .dot {
            border-color: var(--primary);
            background: var(--primary);
        }
        .step span {
            display: block;
            font-size: .82rem;
            color: var(--muted);
        }
        .step.active span,
        .step.done span {
            color: var(--text);
            font-weight: 700;
        }
        .alert {
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 16px;
            background: #eefbf3;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        .alert.is-cancelled {
            background: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }
        .refresh {
            margin-top: 18px;
            color: var(--muted);
            font-size: .9rem;
        }
        @media (max-width: 640px) {
            .grid { grid-template-columns: 1fr; }
            .timeline { grid-template-columns: 1fr; gap: 14px; }
            .step { display: flex; align-items: center; gap: 12px; text-align: left; }
            .dot { margin: 0; }
        }
    </style>
</head>
<body>
    <main class="wrap">
        <section class="hero">
            <span class="eyebrow">Acompanhamento do pedido</span>
            <h1>Pedido #<?= htmlspecialchars((string) $order['numero'], ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="muted">Token publico: <?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?></p>
        </section>

        <section class="card">
            <div class="status-pill" id="status-pill" data-status="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>">
                <span id="status-label"><?= htmlspecialchars($statusLabel, ENT_QUOTES, 'UTF-8') ?></span>
            </div>

            <div class="grid">
                <div class="info">
                    <small>Cliente</small>
                    <strong id="customer-name"><?= htmlspecialchars((string) $order['cliente_nome'], ENT_QUOTES, 'UTF-8') ?></strong>
                </div>
                <div class="info">
                    <small>Total</small>
                    <strong id="order-total">R$ <?= htmlspecialchars(number_format((float) $order['total'], 2, ',', '.'), ENT_QUOTES, 'UTF-8') ?></strong>
                </div>
                <div class="info">
                    <small>Tipo</small>
                    <strong id="order-type"><?= htmlspecialchars((string) $order['tipo_recebimento'], ENT_QUOTES, 'UTF-8') ?></strong>
                </div>
                <div class="info">
                    <small>Criado em</small>
                    <strong id="order-created"><?= htmlspecialchars((string) $order['criado_em'], ENT_QUOTES, 'UTF-8') ?></strong>
                </div>
            </div>

            <div class="timeline" id="order-timeline">
                <?php
                $steps = [
                    1 => 'Recebido',
                    2 => 'Confirmado',
                    3 => 'Preparando',
                    4 => 'Pronto',
                    5 => ((string) ($order['tipo_recebimento'] ?? '') === 'delivery') ? 'Entrega' : 'Concluido',
                ];
                foreach ($steps as $stepNumber => $stepLabel):
                    $class = '';
                    if ($status !== 'cancelado') {
                        $class = $progress > $stepNumber ? 'done' : ($progress === $stepNumber ? 'active' : '');
                    }
                ?>
                    <div class="step <?= $class ?>" data-step="<?= $stepNumber ?>">
                        <div class="dot"></div>
                        <span><?= htmlspecialchars($stepLabel, ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="alert<?= $status === 'cancelado' ? ' is-cancelled' : '' ?>" id="status-alert">
                <?= $status === 'cancelado'
                    ? 'Este pedido foi cancelado.'
                    : 'Status atualizado automaticamente a cada 5 segundos.' ?>
            </div>

            <div class="refresh" id="refresh-note">Atualizacao automatica ativa.</div>
        </section>
    </main>

    <script>
        (function () {
            const token = <?= json_encode($token, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
            const statusLabels = {
                novo: 'Recebido',
                aceito: 'Confirmado',
                preparando: 'Preparando',
                pronto: 'Pronto',
                saiu_para_entrega: 'Saiu para entrega',
                finalizado: 'Finalizado',
                retirado: 'Retirado',
                cancelado: 'Cancelado'
            };
            const progressMap = {
                novo: 1,
                aceito: 2,
                preparando: 3,
                pronto: 4,
                saiu_para_entrega: 5,
                finalizado: 5,
                retirado: 5,
                cancelado: 0
            };
            const finalStatuses = new Set(['finalizado', 'retirado', 'cancelado']);
            const statusPill = document.getElementById('status-pill');
            const statusLabel = document.getElementById('status-label');
            const customerName = document.getElementById('customer-name');
            const orderTotal = document.getElementById('order-total');
            const orderType = document.getElementById('order-type');
            const orderCreated = document.getElementById('order-created');
            const timeline = document.getElementById('order-timeline');
            const statusAlert = document.getElementById('status-alert');
            const refreshNote = document.getElementById('refresh-note');

            const formatCurrency = (value) => new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(Number(value || 0));

            const updateTimeline = (status, type) => {
                const progress = progressMap[status] ?? 1;
                timeline.querySelectorAll('[data-step]').forEach((step) => {
                    const stepNumber = Number(step.getAttribute('data-step'));
                    step.classList.remove('done', 'active');

                    if (status === 'cancelado') {
                        return;
                    }

                    if (progress > stepNumber) {
                        step.classList.add('done');
                    } else if (progress === stepNumber) {
                        step.classList.add('active');
                    }

                    if (stepNumber === 5) {
                        const label = step.querySelector('span');
                        label.textContent = type === 'delivery' ? 'Entrega' : 'Concluido';
                    }
                });
            };

            const updateOrder = (data) => {
                statusPill.dataset.status = data.status;
                statusLabel.textContent = statusLabels[data.status] || data.status;
                customerName.textContent = data.customer_name || '';
                orderTotal.textContent = formatCurrency(data.total);
                orderType.textContent = data.fulfillment_type || '';
                orderCreated.textContent = data.created_at || '';
                updateTimeline(data.status, data.fulfillment_type);

                if (data.status === 'cancelado') {
                    statusAlert.classList.add('is-cancelled');
                    statusAlert.textContent = 'Este pedido foi cancelado.';
                } else {
                    statusAlert.classList.remove('is-cancelled');
                    statusAlert.textContent = 'Status atualizado automaticamente a cada 5 segundos.';
                }

                if (finalStatuses.has(data.status)) {
                    refreshNote.textContent = 'Pedido encerrado. Atualizacao automatica pausada.';
                } else {
                    refreshNote.textContent = 'Atualizacao automatica ativa.';
                }
            };

            let pollId = null;

            const poll = async () => {
                try {
                    const response = await fetch(`/api/v1/public/orders/${token}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();
                    if (!response.ok || !result.success) {
                        throw new Error(result?.error?.message || 'Falha ao consultar pedido');
                    }

                    updateOrder(result.data);

                    if (finalStatuses.has(result.data.status) && pollId !== null) {
                        clearInterval(pollId);
                        pollId = null;
                    }
                } catch (error) {
                    refreshNote.textContent = 'Falha ao atualizar automaticamente. Recarregue a pagina.';
                }
            };

            updateTimeline(<?= json_encode($status, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>, <?= json_encode((string) ($order['tipo_recebimento'] ?? ''), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>);

            if (!finalStatuses.has(<?= json_encode($status, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>)) {
                pollId = window.setInterval(poll, 5000);
            } else {
                refreshNote.textContent = 'Pedido encerrado. Atualizacao automatica pausada.';
            }
        })();
    </script>
</body>
</html>
