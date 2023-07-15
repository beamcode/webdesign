import Vector from './Vector.js';
import { Player, Koopa, Shell, Coin, Star, Goomba, Boo, Surprise } from './Entities.js';

const Types = {
    // Obstacles
    WALL: "wall",
    GROUND: "ground",
    EARTH: "earth",
    LAVA: "lava",
    FLAG: "flag",
    // Characters
    PLAYER: "player",
    COIN: "coin",
    STAR: "star",
    SHELL: "shell",
    GOOMBA: "goomba",
    KOOPA: "koopa",
    BOO: "boo",
    SURPRISE: "surprise",
    BLOCK: "block"
}

const actorchars = {
    "@": Player,
    "O": Coin,
    "X": Star,
    "=": Shell,
    "G": Goomba,
    "K": Koopa,
    "B": Boo,
    "?": Surprise,
};

const obstaclechars = {
    "#": Types.WALL,
    "-": Types.GROUND,
    "E": Types.EARTH,
    "!": Types.LAVA,
    "F": Types.FLAG,
}

var maxStep = 0.05;

class Level {
    constructor(plan, data) {
        this.width = plan[0].length;
        this.height = plan.length;
        this.grid = [];
        this.actors = [];
        this.gravity = 150;
        this.score = data.score;
        this.coins = data.coins;
        this.stars = data.stars;
        this.life = data.life;
        for (var y = 0; y < this.height; y++) {
            var line = plan[y], gridLine = [];
            for (var x = 0; x < this.width; x++) {
                var ch = line[x];
                var Actor = actorchars[ch];
                if (Actor) {
                    this.actors.push(new Actor(new Vector(x, y), ch));
                }
                if (obstaclechars[ch]) {
                    gridLine.push(obstaclechars[ch]);
                } else {
                    gridLine.push(null);
                }
            }
            this.grid.push(gridLine);
        }
        this.player = this.actors.filter(function (actor) {
            return actor.type === Types.PLAYER;
        })[0];
        this.status = this.finishDelay = null;
    }



    collectStar(quantity=1) {
        this.stars += quantity;
        this.score += quantity * 50;
    }

    collectCoin(quantity=1) {
        this.coins += quantity;
        this.score += quantity * 10;
    }

    isFinished() {
        return this.status != null && this.finishDelay < 0;
    }
   
    setStatusLost() {
        this.status = "lost";
        this.finishDelay = 1;
    }
    
    setStatusWon() {
        this.status = "won";
        this.finishDelay = 1;
    }
    
    removeActor(actor) {
        this.actors = this.actors.filter(other => other !== actor);
    }

    addActor(actor) {
        this.actors.push(actor);
    }
    
    isAllCoinsCollected() {
        return !this.actors.some(actor => actor.type === Types.COIN);
    }

    obstacleAt(pos, size) {
        var xStart = Math.floor(pos.x);
        var xEnd = Math.ceil(pos.x + size.x);
        var yStart = Math.floor(pos.y);
        var yEnd = Math.ceil(pos.y + size.y);
        if (xStart < 0 || xEnd > this.width || yStart < 0)
            return Types.WALL;
        if (yEnd > this.height)
            return Types.LAVA;
        for (var y = yStart; y < yEnd; y++) {
            for (var x = xStart; x < xEnd; x++) {
                var fieldType = this.grid[y][x];
                if (fieldType)
                    return fieldType;
            }
        }
    }

    getHitbox(pos, size) {
        return {
            up: Math.round(pos.y * 100.0) / 100.0,
            down: Math.round((pos.y + size.y) * 100.0) / 100.0,
            right: pos.x + size.x,
            left: pos.x,
        }
    }

    actorAt(actor, pos, size) {
        const hitbox = this.getHitbox(pos, size);
        for (let i = 0; i < this.actors.length; i++) {
            const other = this.getHitbox(this.actors[i].pos, this.actors[i].size);
            if (this.actors[i] !== actor &&
                hitbox.right >= other.left &&
                hitbox.left <= other.right &&
                hitbox.down >= other.up &&
                hitbox.up <= other.down) {
                let colision = {
                    up: other.up < hitbox.up && hitbox.up < other.down,
                    down: other.up < hitbox.down && hitbox.down < other.down,
                    left: other.left < hitbox.left && hitbox.left < other.right,
                    right: other.left < hitbox.right && hitbox.right < other.right,
                };
                return {other: this.actors[i], colision: colision};
            }
        }
        return {other: null, colision: null};
    }
    
    animate(deltaTime, dirs) {
        if (this.status != null)
            this.finishDelay -= deltaTime;
        while (deltaTime > 0) {
            var step = Math.min(deltaTime, maxStep);
            this.actors.forEach(function (actor) {
                actor.act(step, this, dirs);
            }, this);
            deltaTime -= step;
        }
    }
}


export default Level;
export { Types };

