document.addEventListener('DOMContentLoaded', () => {
    const currentUrl = window.location.href.split('#')[0];
    document.querySelectorAll('.mp-nav a').forEach((link) => {
        if (link.href.split('#')[0] === currentUrl) {
            link.closest('li')?.classList.add('is-current');
        }
    });

    const toggle = document.querySelector('.mp-search-toggle');
    const panel = document.querySelector('.mp-search-panel');
    if (toggle && panel) {
        toggle.addEventListener('click', () => {
            const isOpen = !panel.hasAttribute('hidden');
            if (isOpen) {
                panel.setAttribute('hidden', '');
                toggle.setAttribute('aria-expanded', 'false');
            } else {
                panel.removeAttribute('hidden');
                toggle.setAttribute('aria-expanded', 'true');
                panel.querySelector('input[type="search"]')?.focus();
            }
        });
    }
});
