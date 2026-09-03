<?php
/** @var \App\Helpers\Session|null $session */
$session = $session ?? null;

if (!$session && session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['_flash'])) {
    $flashes = $_SESSION['_flash'];
    unset($_SESSION['_flash']);
} elseif ($session && method_exists($session, 'getFlash')) {
    $flashes = $session->getFlash();
} else {
    $flashes = [];
}

if (empty($flashes)) {
    return;
}

$typeIcons = [
    'success' => '✓',
    'error' => '✕',
    'warning' => '⚠',
    'info' => 'ℹ'
];

$typeStyles = [
    'success' => 'background: #e6f4ea; color: #137333; border: 1px solid #ceebd5;',
    'error'   => 'background: #fce8e6; color: #c5221f; border: 1px solid #fad2cf;',
    'warning' => 'background: #fef7e0; color: #b06000; border: 1px solid #feefc3;',
    'info'    => 'background: #e8f0fe; color: #1a73e8; border: 1px solid #d2e3fc;'
];
?>

<div class="flash-messages-container" style="display: grid; gap: 10px; margin-bottom: 20px;">
    <?php foreach ($flashes as $type => $messages): ?>
        <?php 
        $style = $typeStyles[$type] ?? $typeStyles['info'];
        $icon = $typeIcons[$type] ?? $typeIcons['info'];
        ?>
        <?php foreach ((array) $messages as $msg): ?>
            <div class="flash-message flash-<?= htmlspecialchars((string)$type, ENT_QUOTES, 'UTF-8') ?>" 
                 style="padding: 12px 16px; border-radius: 10px; font-weight: 500; font-size: 0.94rem; display: flex; align-items: center; justify-content: space-between; gap: 12px; <?= $style ?>">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-weight: bold; font-size: 1.1rem;"><?= $icon ?></span>
                    <span><?= htmlspecialchars((string)$msg, ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; color: inherit; opacity: 0.7; padding: 0 4px;">&times;</button>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
