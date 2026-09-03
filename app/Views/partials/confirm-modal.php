<?php
/**
 * Componente Reutilizavel de Dialogo de Confirmacao
 * 
 * Vars esperadas/opcionais:
 * - $confirmId (string, default: 'bo-confirm-modal')
 * - $confirmTitle (string, default: 'Confirmar acao')
 * - $confirmMessage (string, default: 'Tem certeza que deseja prosseguir?')
 * - $confirmBtnText (string, default: 'Confirmar')
 * - $confirmBtnClass (string, default: 'bo-link-danger')
 */
$confirmId = (string) ($confirmId ?? 'bo-confirm-modal');
$confirmTitle = (string) ($confirmTitle ?? 'Confirmar ação');
$confirmMessage = (string) ($confirmMessage ?? 'Tem certeza que deseja realizar esta operação?');
$confirmBtnText = (string) ($confirmBtnText ?? 'Confirmar');
$confirmBtnClass = (string) ($confirmBtnClass ?? 'bo-link-primary');
?>

<div id="<?= htmlspecialchars($confirmId, ENT_QUOTES, 'UTF-8') ?>" class="bo-modal-backdrop" aria-hidden="true">
    <div class="bo-modal bo-modal-sm" role="dialog" aria-modal="true">
        <div class="bo-modal-header">
            <h3 class="bo-modal-title"><?= htmlspecialchars($confirmTitle, ENT_QUOTES, 'UTF-8') ?></h3>
            <button type="button" class="bo-modal-close" onclick="closeModal('<?= htmlspecialchars($confirmId, ENT_QUOTES, 'UTF-8') ?>')" aria-label="Fechar">&times;</button>
        </div>
        <div class="bo-modal-body">
            <p style="margin: 0; color: var(--bo-muted); line-height: 1.5;"><?= htmlspecialchars($confirmMessage, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div class="bo-modal-footer">
            <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('<?= htmlspecialchars($confirmId, ENT_QUOTES, 'UTF-8') ?>')">Cancelar</button>
            <button type="button" id="<?= htmlspecialchars($confirmId, ENT_QUOTES, 'UTF-8') ?>-btn" class="bo-link <?= htmlspecialchars($confirmBtnClass, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($confirmBtnText, ENT_QUOTES, 'UTF-8') ?></button>
        </div>
    </div>
</div>
