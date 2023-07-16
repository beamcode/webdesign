const spriteUrls = {
    score: 'public/assets/images/score.png',
    skin: 'public/assets/images/skin0.png',
    goomba: 'public/assets/images/goomba.png',
    koopa: 'public/assets/images/koopa.png',
    shell: 'public/assets/images/shell.png',
    wall: 'public/assets/images/wall.png',
    star: 'public/assets/images/star.png',
    coin: 'https://64.media.tumblr.com/34ecb97af549396ce54461835a63d1b3/1fe59baa06bb8c17-d9/s540x810/041f293db97d977df5ccd2cd8b94995aa2f9a34a.gif',
    flag: 'public/assets/images/flag.png',
    lava: 'public/assets/images/lava.png',
    ground: 'public/assets/images/ground.png',
    earth: 'public/assets/images/earth.png',
    boo: 'public/assets/images/boo.png',
    surprise: 'public/assets/images/surprise.png',
    block: 'public/assets/images/block.png',
    heart: 'public/assets/images/heart.png',
};

function element(name, className) {
    var elem = document.createElement(name);
    if (className) elem.className = className;
    return elem;
}
var scale = 16;

class Display {
    constructor(parent, level) {
        this.level = level;
        this.canvas = document.createElement("canvas");
        this.canvas.width = level.width * scale;
        this.canvas.height = level.height * scale;
        this.ctx = this.canvas.getContext('2d');
        this.viewport = {
            left: 0,
            top: 0,
        };
        this.spriteImages = {};
        this.imagesLoaded = false; // Ajoutez cette ligne
        let loadedImages = 0;
        let numImages = Object.keys(spriteUrls).length;
        for (let actorType in spriteUrls) {
            let img = new Image();
            img.src = spriteUrls[actorType];
            img.onload = () => {
                if (++loadedImages >= numImages) {
                    this.imagesLoaded = true;
                }
            };
            this.spriteImages[actorType] = img;
        }
        parent.appendChild(this.canvas);
        console.log("ADD");

        this.drawFrame();
        this.drawControls();
    }

    drawBackground() {
        console.log("drawBackground");
        this.ctx.save();
        this.ctx.translate(-this.viewport.left, -this.viewport.top);
        // draw the background here
        this.ctx.restore();
    }
    

    drawActors() {
        this.ctx.save();
        this.ctx.translate(-this.viewport.left, -this.viewport.top);
        this.level.actors.forEach(actor => {
            let x = actor.pos.x * scale;
            let y = actor.pos.y * scale;
            let width = actor.size.x * scale;
            let height = actor.size.y * scale;

            // actor.type corresponds to the actor type (like "goomba", "koopa", etc.)
            let sprite = this.spriteImages[actor.type];

            this.ctx.drawImage(sprite, x, y, width, height);
        });
        this.ctx.restore();
    }
    

    drawHUD() {
        console.log("drawHUD");
        // Simplified: replace this with your actual HUD rendering code
        this.ctx.fillStyle = "white";
        this.ctx.font = "16px Arial";
        this.ctx.fillText(`Score: ${this.level.score}`, 10, 20);
        this.ctx.fillText(`Stars: ${this.level.stars}`, 10, 40);
        this.ctx.fillText(`Coins: ${this.level.coins}`, 10, 60);
        this.ctx.fillText(`Life: ${this.level.life}`, 10, 80);
    }

    drawControls() {
        console.log("drawControls");
        var controls = document.querySelector('.controls');
        controls.classList.toggle('hidden');
    }

    drawFrame() {
        if (!this.imagesLoaded) { // Ajoutez cette vérification
            requestAnimationFrame(() => this.drawFrame());
            return;
        }
        this.ctx.drawImage(this.frameBuffer, 0, 0);
        this.drawActors();
        this.updateViewport();
        this.clear();
        this.drawBackground();
        this.ctx.drawImage(this.frameBuffer, 0, 0);
        requestAnimationFrame(() => this.drawFrame());
    }
    

    getFillStyle(type) {
        // Replace this with your actual fill style mapping
        let fillStyles = {
            "wall": "black",
            "ground": "green",
            "player": "blue",
            "coin": "yellow",
            "star": "white",
            "goomba": "red",
            // add more as necessary
        };
        return fillStyles[type];
    }

    scrollPlayerIntoView() {
        console.log("scrollPlayerIntoView");
        var width = this.canvas.width;
        var height = this.canvas.height;
        var margin = width / 3;
        var player = this.level.player;
        var center = player.pos.add(player.size.times(0.5)).times(scale);
        
        if (center.x < this.viewport.left + margin) {
            this.viewport.left = center.x - margin;
        } else if (center.x > this.viewport.left + width - margin) {
            this.viewport.left = center.x + margin - width;
        }
        if (center.y < this.viewport.top + margin) {
            this.viewport.top = center.y - margin;
        } else if (center.y > this.viewport.top + height - margin) {
            this.viewport.top = center.y + margin - height;
        }
        console.log("End scrollPlayerIntoView");
    }
    

    clear() {
        console.log("clear");
        this.canvas.parentNode.removeChild(this.canvas);
        this.drawControls();
    }
}
export default Display;
