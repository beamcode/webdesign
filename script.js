function toggleSidebar(id) {
    const sidebar = document.getElementById(id);
    const otherSidebarId = id === 'sidebarLeft' ? 'sidebarRight' : 'sidebarLeft';
    const otherSidebar = document.getElementById(otherSidebarId);

    if (window.innerWidth < 900 && !otherSidebar.classList.contains('collapsed')) {
        otherSidebar.classList.add('collapsed');
    }
    
    sidebar.classList.toggle('collapsed');
}

function manageSidebars() {
    const sidebarLeft = document.getElementById('sidebarLeft');
    const sidebarRight = document.getElementById('sidebarRight');

    if (window.innerWidth > 1400) {
        if (sidebarLeft.classList.contains('collapsed')) {
            sidebarLeft.classList.remove('collapsed');
        }
        if (sidebarRight.classList.contains('collapsed')) {
            sidebarRight.classList.remove('collapsed');
        }
    } else if (window.innerWidth < 900) {
        if (!sidebarLeft.classList.contains('collapsed') && !sidebarRight.classList.contains('collapsed')) {
            sidebarLeft.classList.add('collapsed');
        }
    }
}

window.addEventListener('resize', manageSidebars);

manageSidebars();
