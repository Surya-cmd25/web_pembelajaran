document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openBtn = document.getElementById('openSidebarBtn');
    const closeBtn = document.getElementById('closeSidebarBtn');

    const toggleSidebar = (open) => {
        if (!sidebar || !overlay) return;
        sidebar.classList.toggle('-translate-x-full', !open);
        overlay.classList.toggle('hidden', !open);
        document.body.classList.toggle('overflow-hidden', open);
    };

    if (openBtn) openBtn.addEventListener('click', () => toggleSidebar(true));
    if (closeBtn) closeBtn.addEventListener('click', () => toggleSidebar(false));
    if (overlay) overlay.addEventListener('click', () => toggleSidebar(false));

    const userMenuBtn = document.getElementById('userMenuBtn');
    const userMenu = document.getElementById('userMenu');
    if (userMenuBtn && userMenu) {
        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
        });
        userMenu.addEventListener('click', (e) => e.stopPropagation());
        document.addEventListener('click', () => userMenu.classList.add('hidden'));
    }

    const notifBellBtn = document.getElementById('notifBellBtn');
    const notifMenu = document.getElementById('notifMenu');
    if (notifBellBtn && notifMenu) {
        notifBellBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            notifMenu.classList.toggle('hidden');
        });
        notifMenu.addEventListener('click', (e) => e.stopPropagation());
        document.addEventListener('click', () => notifMenu.classList.add('hidden'));
    }
});
