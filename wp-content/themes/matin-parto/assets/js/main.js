document.addEventListener('DOMContentLoaded', () => {
    const currentUrl = window.location.href.split('#')[0];
    document.querySelectorAll('.mp-nav a').forEach((link) => {
        if (link.href.split('#')[0] === currentUrl) {
            link.closest('li')?.classList.add('is-current');
        }
    });
});
