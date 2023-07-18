<div class="navbar">
    <div class="mobBurgerContainer" onclick="toggleLeftSidebar(this)">
        <div class="mobbar1"></div>
        <div class="mobbar2"></div>
        <div class="mobbar3"></div>
    </div>

    <button class="nav-chat-button" onclick="toggleRightSidebar(this)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 2 15 13" style="height: 100%">
            <path fill-rule=" evenodd" clip-rule="evenodd" d="M12.5 3L2.49999 3.00002C1.67157 3.00002 0.999999 3.67159 0.999999 4.50002V9.50002C0.999999 10.3284 1.67157 11 2.5 11H7.50002C7.63263 11 7.75981 11.0527 7.85358 11.1465L9.99999 13.2929V11.5C9.99999 11.2239 10.2239 11 10.5 11H12.5C13.3284 11 14 10.3284 14 9.50002V4.5C14 3.67157 13.3284 3 12.5 3ZM2.49999 2.00002L12.5 2C13.8807 2 15 3.11928 15 4.5V9.50002C15 10.8807 13.8807 12 12.5 12H11V14.5C11 14.7022 10.8782 14.8845 10.6913 14.9619C10.5045 15.0393 10.2894 14.9965 10.1464 14.8535L7.29292 12H2.5C1.11929 12 0 10.8807 0 9.50002V4.50002C0 3.11931 1.11928 2.00002 2.49999 2.00002Z" fill="#A9A9A9" />
        </svg>
    </button>
</div>

<div class="sidebarLeft" id="sidebarLeft">
    <!-- Add your sidebar content here -->
    <ul class="links-container">
        <a href="/about">
            <li>About</li>
        </a>
        <a href="/game">
            <li>Game</li>
        </a>
        <a href="/profile">
            <li>Profile</li>
        </a>
        <a href="/scores">
            <li>Scores</li>
        </a>
    </ul>

    <div class="logout">
        <a href="/scores">
            <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="1.75 1.73 20.5 20.54">
                <g fill="white">
                    <path d="m15.2405 22.27h-.13c-4.44 0-6.58-1.75-6.95-5.67-.04-.41.26-.78.68-.82.4-.04.78.27.82.68.29 3.14 1.77 4.31 5.46 4.31h.13c4.07 0 5.51-1.44 5.51-5.51v-6.52002c0-4.07-1.44-5.51-5.51-5.51h-.13c-3.71 0-5.19 1.19-5.46 4.39-.05.41-.4.72-.82.68-.42-.03-.72-.4-.69-.81.34-3.98 2.49-5.76 6.96-5.76h.13c4.91 0 7.01 2.1 7.01 7.01v6.52002c0 4.91-2.1 7.01-7.01 7.01z" />
                    <path d="m14.9991 12.75h-11.37996c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h11.37996c.41 0 .75.34.75.75s-.34.75-.75.75z" />
                    <path d="m5.84945 16.1001c-.19 0-.38-.07-.53-.22l-3.35-3.35c-.29-.29-.29-.77 0-1.06l3.35-3.35001c.29-.29.77-.29 1.06 0s.29.77 0 1.06l-2.82 2.82001 2.82 2.82c.29.29.29.77 0 1.06-.14.15-.34.22-.53.22z" />
                </g>
            </svg>
            Logout
        </a>
    </div>
</div>

<div class="sidebarRight" id="sidebarRight">
    <?php include './components/chatbox.php'; ?>
</div>

<script>
    function toggleLeftSidebar(element) {
        var sidebarLeft = document.getElementById("sidebarLeft");
        sidebarLeft.classList.toggle('active');
        element.classList.toggle('mobchange');
    }

    function toggleRightSidebar(element) {
        var sidebarRight = document.getElementById('sidebarRight');
        sidebarRight.classList.toggle('active');
        element.classList.toggle('mobchange');
    }
</script>