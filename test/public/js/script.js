// function toggleSidebar(id) {
//     const sidebar = document.getElementById(id);
//     sidebar.classList.toggle('collapsed');
// }

function toggleSidebar(id) {
    const sidebar = document.getElementById(id);
    const otherSidebarId = id === 'sidebarLeft' ? 'sidebarRight' : 'sidebarLeft';
    const otherSidebar = document.getElementById(otherSidebarId);

    // Si la largeur de la fenêtre est inférieure à 900px, fermer l'autre sidebar
    if (window.innerWidth < 900 && !otherSidebar.classList.contains('collapsed')) {
        otherSidebar.classList.add('collapsed');
    }
    
    sidebar.classList.toggle('collapsed');
}

// Gère l'état des sidebars en fonction de la largeur de la fenêtre
function manageSidebars() {
    const sidebarLeft = document.getElementById('sidebarLeft');
    const sidebarRight = document.getElementById('sidebarRight');

    if (window.innerWidth > 1400) {
        // Si la largeur de la fenêtre est supérieure à 1400px, ouvrir les deux sidebars
        if (sidebarLeft.classList.contains('collapsed')) {
            sidebarLeft.classList.remove('collapsed');
        }
        if (sidebarRight.classList.contains('collapsed')) {
            sidebarRight.classList.remove('collapsed');
        }
    } else if (window.innerWidth < 900) {
        // Si la largeur de la fenêtre est inférieure à 900px et les deux sidebars sont ouvertes, fermer la sidebar de gauche
        if (!sidebarLeft.classList.contains('collapsed') && !sidebarRight.classList.contains('collapsed')) {
            sidebarLeft.classList.add('collapsed');
        }
    }
}

// Écoute les changements de taille de la fenêtre
window.addEventListener('resize', manageSidebars);

// Gère l'état initial des sidebars
manageSidebars();
