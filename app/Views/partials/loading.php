<?php
/**
 * Componente Reutilizavel de Loading Overlay & Spinner
 * 
 * Vars esperadas/opcionais:
 * - $loadingText (string, default: 'Carregando...')
 * - $loadingId (string, opcional)
 */
$loadingText = (string) ($loadingText ?? 'Carregando...');
$loadingId = !empty($loadingId) ? 'id="' . htmlspecialchars((string)$loadingId, ENT_QUOTES, 'UTF-8') . '"' : '';
?>

<div <?= $loadingId ?> class="bo-loading-overlay">
    <div class="bo-spinner"></div>
    <?php if (!empty($loadingText)): ?>
        <span class="bo-loading-text"><?= htmlspecialchars($loadingText, ENT_QUOTES, 'UTF-8') ?></span>
    <?php endif; ?>
</div>
