function element(name, className) {
    var elem = document.createElement(name);
    if (className) elem.className = className;
    return elem;
}
var scale = 16;

class Display {
    constructor(parent, level) {
        // this.parent = parent;
        this.level = level;
        this.wrap = parent.appendChild(element("div", "game-view"));
        this.map = this.wrap.appendChild(element("div", "map-wrapper"));
        this.map.appendChild(this.drawBackground());
        this.actorLayer = null;
        this.HUDLayer = null;
        this.drawFrame();
        this.drawControls();
    }

    drawBackground() {
        var map = element("div", "map");
        var table = element("table", "background");
        table.style.width = this.level.width * scale + "px";
        table.style.height = this.level.height * scale + "px";
        this.level.grid.forEach(function (row) {
            var rowElement = table.appendChild(element("tr"));
            rowElement.style.height = scale + "px";
            row.forEach(function (type) {
                rowElement.appendChild(element("td", type ? "cell " + type : null));
            });
        });
        map.appendChild(table);
        return map;
    }

    drawActors() {
        var wrap = element("div");
        this.level.actors.forEach(function (actor) {
            var rect = wrap.appendChild(element("div", "character " + actor.type));
            rect.style.width = actor.size.x * scale + "px";
            rect.style.height = actor.size.y * scale + "px";
            rect.style.left = actor.pos.x * scale + "px";
            rect.style.top = actor.pos.y * scale + "px";
        });
        return wrap;
    }

    drawHUD() {
        if (this.HUDLayer)
            this.wrap.removeChild(this.HUDLayer);
        this.HUDLayer = element("div", "hud-wrapper");
        var hud = element("div", "hud");
        var score = element("span", "score");
        var stars = element("span", "stars");
        var coins = element("span", "coins");
        var hearts = element("div", "hearts");
        for (var i = 0; i < this.level.life; i++) {
            var heart = element("span", "heart");
            heart.style.height = scale + "px";
            heart.style.width = scale + "px";
            hearts.appendChild(heart);
        }
        score.textContent = this.level.score;
        stars.textContent = this.level.stars;
        coins.textContent = this.level.coins;
        hud.appendChild(score);
        hud.appendChild(stars);
        hud.appendChild(coins);
        this.HUDLayer.appendChild(hud);
        this.HUDLayer.appendChild(hearts);
        this.wrap.prepend(this.HUDLayer);
    }

    drawControls() {
        var controls = document.querySelector('.controls');
        controls.classList.toggle('hidden');
    }
    

    drawFrame() {
        if (this.actorLayer)
            this.map.removeChild(this.actorLayer);
        this.drawHUD();
        this.actorLayer = this.map.appendChild(this.drawActors());
        this.wrap.className = "game-view " + (this.level.status || "");
        this.scrollPlayerIntoView();
    }

    scrollPlayerIntoView() {
        var width = this.wrap.clientWidth;
        var height = this.wrap.clientHeight;
        var margin = width / 3;
        // The viewport
        var left = this.wrap.scrollLeft, right = left + width;
        var top = this.wrap.scrollTop, bottom = top + height;
        var player = this.level.player;
        var center = player.pos.add(player.size.times(0.5)).times(scale);
        if (center.x < left + margin)
            this.wrap.scrollLeft = center.x - margin;
        else if (center.x > right - margin)
            this.wrap.scrollLeft = center.x + margin - width;
        if (center.y < top + margin)
            this.wrap.scrollTop = center.y - margin;
        else if (center.y > bottom - margin)
            this.wrap.scrollTop = center.y + margin - height;
    }

    clear() {
        this.wrap.parentNode.removeChild(this.wrap);
        // this.wrap.removeChild(this.HUDLayer);
        this.drawControls();
    }
}
export default Display;
