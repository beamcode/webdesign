<div id="navWeb" class="navWeb">
    <div class="burgerContainer" onclick="toggleNav(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
    <div id="navWebLinks" class="navwebContainer">
        <div class="links">
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>
        <div class="logout">
            <span></span>
            <div class="logoutItems">
                <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="1.75 1.73 20.5 20.54">
                    <g fill="white">
                        <path d="m15.2405 22.27h-.13c-4.44 0-6.58-1.75-6.95-5.67-.04-.41.26-.78.68-.82.4-.04.78.27.82.68.29 3.14 1.77 4.31 5.46 4.31h.13c4.07 0 5.51-1.44 5.51-5.51v-6.52002c0-4.07-1.44-5.51-5.51-5.51h-.13c-3.71 0-5.19 1.19-5.46 4.39-.05.41-.4.72-.82.68-.42-.03-.72-.4-.69-.81.34-3.98 2.49-5.76 6.96-5.76h.13c4.91 0 7.01 2.1 7.01 7.01v6.52002c0 4.91-2.1 7.01-7.01 7.01z" />
                        <path d="m14.9991 12.75h-11.37996c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h11.37996c.41 0 .75.34.75.75s-.34.75-.75.75z" />
                        <path d="m5.84945 16.1001c-.19 0-.38-.07-.53-.22l-3.35-3.35c-.29-.29-.29-.77 0-1.06l3.35-3.35001c.29-.29.77-.29 1.06 0s.29.77 0 1.06l-2.82 2.82001 2.82 2.82c.29.29.29.77 0 1.06-.14.15-.34.22-.53.22z" />
                    </g>
                </svg>
                <a href="#">Log out</a>
            </div>
        </div>
    </div>
</div>

<div id="navMobile" class="navMobile">
    <div class="mobBurgerContainer" onclick="toggleMobNav(this)">
        <div class="mobbar1"></div>
        <div class="mobbar2"></div>
        <div class="mobbar3"></div>
    </div>

    <div id="navMobileLinks" class="navMobileLinks">
        <a href="#">Home</a>
        <a href="#">Profile</a>
        <a href="#">Game</a>
        <a href="#">Scores</a>
        <div class="navMobileWhiteBar"></div>
        <a class="navMobileLogout" href="#">Log out
            <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="1.75 1.73 20.5 20.54">
                <g fill="white">
                    <path d="m15.2405 22.27h-.13c-4.44 0-6.58-1.75-6.95-5.67-.04-.41.26-.78.68-.82.4-.04.78.27.82.68.29 3.14 1.77 4.31 5.46 4.31h.13c4.07 0 5.51-1.44 5.51-5.51v-6.52002c0-4.07-1.44-5.51-5.51-5.51h-.13c-3.71 0-5.19 1.19-5.46 4.39-.05.41-.4.72-.82.68-.42-.03-.72-.4-.69-.81.34-3.98 2.49-5.76 6.96-5.76h.13c4.91 0 7.01 2.1 7.01 7.01v6.52002c0 4.91-2.1 7.01-7.01 7.01z" />
                    <path d="m14.9991 12.75h-11.37996c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h11.37996c.41 0 .75.34.75.75s-.34.75-.75.75z" />
                    <path d="m5.84945 16.1001c-.19 0-.38-.07-.53-.22l-3.35-3.35c-.29-.29-.29-.77 0-1.06l3.35-3.35001c.29-.29.77-.29 1.06 0s.29.77 0 1.06l-2.82 2.82001 2.82 2.82c.29.29.29.77 0 1.06-.14.15-.34.22-.53.22z" />
                </g>
            </svg>
        </a>
    </div>
</div>

<script>
    function toggleNav(x) {
        var sideNavWeb = document.getElementById("navWeb")
        var links = document.getElementById("navWebLinks")
        x.classList.toggle("change");

        if (window.getComputedStyle(sideNavWeb).getPropertyValue("width") == "50px") {
            sideNavWeb.style.width = "200px";
            sideNavWeb.style.minWidth = "200px";
            links.style.opacity = 1;
        } else {
            sideNavWeb.style.minWidth = "50px";
            sideNavWeb.style.width = "50px";
            links.style.opacity = 0;
        }
    }

    function toggleMobNav(x) {
        var topMobBar = document.getElementById("navMobile")
        var mobNav = document.getElementById("navMobileLinks")
        x.classList.toggle("mobchange");

        if (window.getComputedStyle(topMobBar).getPropertyValue("height") == "50px") {
            topMobBar.style.height = "311px";
            mobNav.style.opacity = 1;
        } else {
            topMobBar.style.height = "50px";
            mobNav.style.opacity = 0;
        }
    }
</script>