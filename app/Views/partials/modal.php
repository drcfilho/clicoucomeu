<?php
/**
 * Componente Reutilizavel de Modal
 * 
 * Vars esperadas/opcionais:
 * - $modalId (string, ex: 'modal-confirm')
 * - $modalTitle (string, ex: 'Confirmar Acao')
 * - $modalSize (string, opcional: 'sm' | 'lg' | '')
 * - $modalBody (string, conteudo HTML do corpo)
 * - $modalFooter (string, opcional, HTML dos botoes do rodape)
 */
$modalId = (string) ($modalId ?? 'bo-modal');
$modalTitle = (string) ($modalTitle ?? '');
$modalSize = (string) ($modalSize ?? '');
$modalBody = (string) ($modalBody ?? '');
$modalFooter = (string) ($modalFooter ?? '');
?>

<div id="<?= htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8') ?>" class="bo-modal-backdrop" aria-hidden="true">
    <div class="bo-modal <?= $modalSize ? 'bo-modal-' . htmlspecialchars($modalSize, ENT_QUOTES, 'UTF-8') : '' ?>" role="dialog" aria-modal="true" aria-labelledby="<?= htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8') ?>-title">
        <div class="bo-modal-header">
            <h3 id="<?= htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8') ?>-title" class="bo-modal-title"><?= htmlspecialchars($modalTitle, ENT_QUOTES, 'UTF-8') ?></h3>
            <button type="button" class="bo-modal-close" onclick="closeModal('<?= htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8') ?>')" aria-label="Fechar">&times;</button>
        </div>
        <div class="bo-modal-body">
            <?= $modalBody ?>
        </div>
        <?php if (!empty($modalFooter)): ?>
            <div class="bo-modal-footer">
                <?= $modalFooter ?>
            </div>
        <?php endif; ?>
    </div>
</div>
