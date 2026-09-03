/**
 * Helpers JS Globais do Backoffice (Modal & Confirm)
 */

function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
}

/**
 * Abre caixa de diálogo de confirmação via JS estático/dinâmico
 */
function confirmAction(options) {
    const {
        title = 'Confirmar Ação',
        message = 'Deseja realmente prosseguir?',
        confirmText = 'Confirmar',
        confirmClass = 'bo-link-primary',
        onConfirm = () => {}
    } = options;

    let backdrop = document.getElementById('bo-global-confirm-dialog');
    if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.id = 'bo-global-confirm-dialog';
        backdrop.className = 'bo-modal-backdrop';
        backdrop.setAttribute('aria-hidden', 'true');
        document.body.appendChild(backdrop);
    }

    backdrop.innerHTML = `
        <div class="bo-modal bo-modal-sm" role="dialog" aria-modal="true">
            <div class="bo-modal-header">
                <h3 class="bo-modal-title">${escapeHtml(title)}</h3>
                <button type="button" class="bo-modal-close" onclick="closeModal('bo-global-confirm-dialog')">&times;</button>
            </div>
            <div class="bo-modal-body">
                <p style="margin: 0; color: var(--bo-muted); line-height: 1.5;">${escapeHtml(message)}</p>
            </div>
            <div class="bo-modal-footer">
                <button type="button" class="bo-link bo-link-secondary" onclick="closeModal('bo-global-confirm-dialog')">Cancelar</button>
                <button type="button" id="bo-global-confirm-btn" class="bo-link ${confirmClass}">${escapeHtml(confirmText)}</button>
            </div>
        </div>
    `;

    openModal('bo-global-confirm-dialog');

    const btn = document.getElementById('bo-global-confirm-btn');
    if (btn) {
        btn.onclick = () => {
            closeModal('bo-global-confirm-dialog');
            onConfirm();
        };
    }
}

function escapeHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}

// Fechar modal ao clicar fora ou apertar ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const openModals = document.querySelectorAll('.bo-modal-backdrop.is-open');
        openModals.forEach(m => closeModal(m.id));
    }
});

document.addEventListener('click', (e) => {
    if (e.target.classList.contains('bo-modal-backdrop') && e.target.classList.contains('is-open')) {
        closeModal(e.target.id);
    }
});
