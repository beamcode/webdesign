<header>
    <button class="toggle-btn" id="toggleBtnLeft" onclick="toggleSidebar('sidebarLeft')">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <line x1="3" y1="12" x2="21" y2="12" />
            <line x1="3" y1="6" x2="21" y2="6" />
            <line x1="3" y1="18" x2="21" y2="18" />
        </svg>
    </button>

    <input type="text" autocomplete="off" name="text" class="input" placeholder="Search">

    <button class="toggle-btn" id="toggleBtnRight" onclick="">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="24" width="24">
            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="currentColor" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"></path>
            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="currentColor" d="M22 22L20 20"></path>
        </svg>
    </button>
    <button class="toggle-btn" id="toggleBtnRight" onclick="toggleSidebar('sidebarRight')">
        <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
            <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                <path d="m16 2h-8c-4 0-6 2-6 6v13c0 .55.45 1 1 1h13c4 0 6-2 6-6v-8c0-4-2-6-6-6z"/>
                <g stroke-miterlimit="10">
                    <path d="m7 9.5h10"/>
                    <path d="m7 14.5h7"/>
                </g>
            </g>
        </svg>
    </button>
</header>