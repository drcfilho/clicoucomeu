<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Impressão do Pedido #<?= htmlspecialchars((string)$order['numero'], ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Courier New', Courier, monospace, sans-serif; }
        body { background: #e2e8f0; padding: 20px; display: flex; flex-direction: column; align-items: center; }

        .no-print-bar { background: #1e293b; color: #fff; padding: 12px 24px; border-radius: 12px; margin-bottom: 20px; display: flex; gap: 14px; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .no-print-bar button, .no-print-bar select { padding: 8px 14px; border-radius: 6px; border: 0; font-weight: 700; cursor: pointer; }
        .btn-print { background: #22c55e; color: #000; font-size: 1rem; }

        /* Formatos de Impressão (58mm, 80mm, A4) */
        .ticket { background: #fff; color: #000; padding: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-size: 12px; line-height: 1.3; }
        .ticket.format-58mm { width: 58mm; font-size: 11px; }
        .ticket.format-80mm { width: 80mm; font-size: 13px; }
        .ticket.format-a4 { width: 210mm; min-height: 297mm; padding: 40px; font-size: 14px; line-height: 1.5; font-family: system-ui, sans-serif; }

        .divider { border-top: 1px dashed #000; margin: 8px 0; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }

        @media print {
            .no-print-bar { display: none !important; }
            body { background: #fff; padding: 0; }
            .ticket { box-shadow: none; margin: 0; padding: 4px; }
            .ticket.format-58mm { width: 100%; max-width: 58mm; }
            .ticket.format-80mm { width: 100%; max-width: 80mm; }
            .ticket.format-a4 { width: 100%; max-width: 210mm; padding: 0; }
        }
    </style>
</head>
<body>
    <div class="no-print-bar">
        <span>Formato:</span>
        <select id="format-selector" onchange="changeFormat(this.value)">
            <option value="80mm" <?= $format === '80mm' ? 'selected' : '' ?>>Cupom 80mm (Padrão)</option>
            <option value="58mm" <?= $format === '58mm' ? 'selected' : '' ?>>Cupom 58mm (Estreito)</option>
            <option value="a4" <?= $format === 'a4' ? 'selected' : '' ?>>Folha A4 / Relatório</option>
        </select>
        <button type="button" class="btn-print" onclick="window.print()">🖨️ Imprimir Pedido</button>
        <button type="button" onclick="window.close()">Fechar</button>
    </div>

    <div class="ticket format-<?= htmlspecialchars((string)$format, ENT_QUOTES, 'UTF-8') ?>" id="ticket-content">
        <div class="text-center bold" style="font-size: 1.2em;">
            <?= htmlspecialchars((string)$tenant['nome'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <?php if (!empty($tenant['whatsapp'])): ?>
            <div class="text-center">Tel: <?= htmlspecialchars((string)$tenant['whatsapp'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <div class="divider"></div>

        <div class="text-center bold" style="font-size: 1.4em;">
            PEDIDO #<?= htmlspecialchars((string)$order['numero'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <div class="text-center">
            Data: <?= date('d/m/Y H:i', strtotime($order['criado_em'])) ?>
        </div>

        <div class="divider"></div>

        <div>
            <span class="bold">CLIENTE:</span> <?= htmlspecialchars((string)$order['cliente_nome'], ENT_QUOTES, 'UTF-8') ?><br>
            <span class="bold">TELEFONE:</span> <?= htmlspecialchars((string)$order['cliente_whatsapp'], ENT_QUOTES, 'UTF-8') ?><br>
            <span class="bold">TIPO:</span> <?= strtoupper((string)$order['tipo_recebimento']) ?><br>
            <?php if ($order['tipo_recebimento'] === 'delivery'): ?>
                <span class="bold">ENDEREÇO:</span> <?= htmlspecialchars((string)$order['endereco'], ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars((string)$order['numero_endereco'], ENT_QUOTES, 'UTF-8') ?><br>
                <span class="bold">BAIRRO:</span> <?= htmlspecialchars((string)$order['bairro_nome'], ENT_QUOTES, 'UTF-8') ?><br>
                <?php if (!empty($order['complemento'])): ?>
                    <span class="bold">COMPL:</span> <?= htmlspecialchars((string)$order['complemento'], ENT_QUOTES, 'UTF-8') ?><br>
                <?php endif; ?>
                <?php if (!empty($order['referencia'])): ?>
                    <span class="bold">REF:</span> <?= htmlspecialchars((string)$order['referencia'], ENT_QUOTES, 'UTF-8') ?><br>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="divider"></div>

        <div class="bold">ITENS DO PEDIDO</div>
        <div class="divider"></div>

        <?php foreach ($order['itens'] as $item): ?>
            <div>
                <span class="bold"><?= (int)$item['quantidade'] ?>x <?= htmlspecialchars((string)$item['produto_nome'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php if (!empty($item['variacao_nome'])): ?>
                    (<?= htmlspecialchars((string)$item['variacao_nome'], ENT_QUOTES, 'UTF-8') ?>)
                <?php endif; ?>
                <span class="text-right" style="float: right;">R$ <?= number_format((float)$item['valor_total'], 2, ',', '.') ?></span>
            </div>
            
            <?php if (!empty($item['adicionais'])): ?>
                <?php foreach ($item['adicionais'] as $add): ?>
                    <div style="padding-left: 10px; font-size: 0.9em; color: #333;">
                        + <?= htmlspecialchars((string)$add['adicional_nome'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($item['observacao'])): ?>
                <div style="padding-left: 10px; font-weight: bold;">
                    OBS: <?= htmlspecialchars((string)$item['observacao'], ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>
            <div style="margin-bottom: 6px;"></div>
        <?php endforeach; ?>

        <div class="divider"></div>

        <div>
            Subtotal: <span style="float: right;">R$ <?= number_format((float)$order['subtotal'], 2, ',', '.') ?></span><br>
            Taxa Entrega: <span style="float: right;">R$ <?= number_format((float)$order['taxa_entrega'], 2, ',', '.') ?></span><br>
            <?php if ((float)$order['desconto'] > 0): ?>
                Desconto: <span style="float: right;">- R$ <?= number_format((float)$order['desconto'], 2, ',', '.') ?></span><br>
            <?php endif; ?>
            <div class="bold" style="font-size: 1.2em; margin-top: 4px;">
                TOTAL: <span style="float: right;">R$ <?= number_format((float)$order['total'], 2, ',', '.') ?></span>
            </div>
        </div>

        <div class="divider"></div>

        <div>
            <span class="bold">PAGAMENTO:</span> <?= htmlspecialchars((string)$order['forma_pagamento_nome'], ENT_QUOTES, 'UTF-8') ?><br>
            <?php if ((float)$order['troco_para'] > 0): ?>
                <span class="bold">TROCO PARA:</span> R$ <?= number_format((float)$order['troco_para'], 2, ',', '.') ?> (Troco: R$ <?= number_format((float)$order['troco_para'] - (float)$order['total'], 2, ',', '.') ?>)<br>
            <?php endif; ?>
        </div>

        <?php if (!empty($order['observacao'])): ?>
            <div class="divider"></div>
            <div class="bold">OBSERVAÇÕES DO PEDIDO:</div>
            <div><?= htmlspecialchars((string)$order['observacao'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <div class="divider"></div>
        <div class="text-center" style="font-size: 0.9em; margin-top: 8px;">
            www.clicoucomeu.com.br
        </div>
    </div>

    <script>
        function changeFormat(fmt) {
            const ticket = document.getElementById('ticket-content');
            ticket.className = 'ticket format-' + fmt;
        }
    </script>
</body>
</html>
