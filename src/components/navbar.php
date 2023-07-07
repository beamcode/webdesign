<div id="mySidenav" class="sidenav">
    <div class="container" onclick="toggleNav(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

    <div id="navLinks" class="links">
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>
</div>

<script>
    function toggleNav(x) {
        var sideNav = document.getElementById("mySidenav");
        var main = document.getElementById("mainContainer")
        var links = document.getElementById("navLinks")
        x.classList.toggle("change");

        if (window.getComputedStyle(sideNav).getPropertyValue("width") == "50px") {
            sideNav.style.width = "200px";
            main.style.marginLeft = "200px";
            links.style.opacity = 1;
        } else {
            sideNav.style.width = "50px";
            main.style.marginLeft = "50px";
            links.style.opacity = 0;
        }
    }
</script>