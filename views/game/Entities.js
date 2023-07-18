import Vector from './Vector.js';
import { Types } from './Level.js'

class Character {
    constructor(pos, type, size = new Vector(1, 1)) {
        this.type = type;
        this.pos = pos;
        this.size = size;
        this.speed = new Vector(0, 0);
        this.velocity = new Vector(5, 0);
        this.isStuck = false;
        this.dirs = { up: false, down: false, left: false, right: false };
        this.isAlive = true;
    }

    death() {
        this.isAlive = false;
    }

    handleDeath(level, step) {
        if (!this.isAlive) {
            this.pos.y += step * 10;
            this.size.y -= step * 10;
            if (this.size.y <= 0) {
                level.removeActor(this);
            }
        }
    }

    changeDirection(colision) {
        if (colision.left) {
            this.dirs.left = false;
            this.dirs.right = true;
        } else if (colision.right) {
            this.dirs.right = false;
            this.dirs.left = true;
        }
    }

    handleCollisionWithCharacter(level, character, colision) {
        if (level.status !== null) {
            this.isStuck = true;
            return;
        }

        switch (character.type) {
           case Types.SHELL:
                this.isStuck = true;
                if (character.speed.x) {
                    this.death();
                } else {
                    this.changeDirection(colision);
                }
                break;
            case Types.SURPRISE:
                this.isStuck = true;
                this.changeDirection(colision);
                break;
            case Types.BLOCK:
                this.isStuck = true;
                this.changeDirection(colision);
                break;
       }
    }

    handleCollisionWithObstacle(level, type, colision) {
        if (level.status !== null) {
            this.isStuck = true;
            return;
        }

        switch (type) {
            case Types.LAVA:
                this.isStuck = true;
                break;
            case Types.WALL:
                this.isStuck = true;
                break;
            case Types.EARTH:   
                this.isStuck = true;
                break;
            case Types.GROUND:
                this.isStuck = true;
                break;
            case Types.FLAG:
                break;
        }
    }

    handleCollisionsWithObstacles(level, pos) {
        const hitbox = this.getHitbox(pos, this.size, 1);
        if (hitbox.left < 0 || hitbox.right > level.width || hitbox.up < 0)
            return this.handleCollisionWithObstacle(level, Types.WALL, { up: hitbox.up < 0, down: false, left: hitbox.left < 0, right: hitbox.right > level.width });
        if (hitbox.down > level.height)
            return this.handleCollisionWithObstacle(level, Types.LAVA, { up: false, down: true, left: false, right: false });
        for (var y = hitbox.up; y < hitbox.down; y++) {
            for (var x = hitbox.left; x < hitbox.right; x++) {
                var type = level.grid[y][x];
                let colision = {
                    up: this.pos.y > pos.y,
                    down: this.pos.y < pos.y,
                    left: this.pos.x > pos.x,
                    right: this.pos.x < pos.x,
                };
                if (type)
                    this.handleCollisionWithObstacle(level, type, colision);
            }
        }
    }

    getHitbox(pos, size, float=100.0) {
        return {
            up: Math.floor(pos.y * float) / float,
            down: Math.ceil((pos.y + size.y) * float) / float,
            right: Math.ceil((pos.x + size.x) * float) / float,
            left: Math.floor(pos.x * float) / float,
        }
    }

    handleCollisionsWithCharacters(level, pos, axis) {
        const hitbox = this.getHitbox(pos, this.size);
        for (let i = 0; i < level.actors.length; i++) {
            const other = this.getHitbox(level.actors[i].pos, level.actors[i].size);
            if (level.actors[i] !== this &&
                hitbox.right > other.left &&
                hitbox.left < other.right &&
                hitbox.down > other.up &&
                hitbox.up < other.down) {
                let colision = {
                    up: other.up < hitbox.up && hitbox.up < other.down,
                    down: other.up < hitbox.down && hitbox.down < other.down,
                    left: other.left < hitbox.left && hitbox.left < other.right,
                    right: other.left < hitbox.right && hitbox.right < other.right,
                };
                this.handleCollisionWithCharacter(level, level.actors[i], colision);
            } else if (axis === "y" &&
                level.actors[i] !== this &&
                hitbox.right > other.left &&
                hitbox.left < other.right &&
                hitbox.down > other.up &&
                Math.abs(hitbox.up - other.down) < 0.1) { /* 0.1 to be sure it's above, despite rounding */
                this.onCharacter(level.actors[i]);
            }
        }
    }

    onCharacter(actor) {
    }

    handleCollision(level, pos, axis) {
        this.isStuck = false;
        this.handleCollisionsWithCharacters(level, pos, axis);
        this.handleCollisionsWithObstacles(level, pos);
        return this.isStuck ? this.pos[axis] : pos[axis];
    }

    getNewPosition(step, level) {
        this.speed.x = 0;
        if (this.dirs.left)
            this.speed.x -= this.velocity.x;
        if (this.dirs.right)
            this.speed.x += this.velocity.x;
        this.speed.y += step * level.gravity;
        var motion = this.speed.times(step);
        return this.pos.add(motion);
    }

    handleJump() {
        if (this.isStuck) { /* Check for any obstacle above or below */
            if (this.dirs.up && this.speed.y > 0) { /* Check if they have to jump and if they are already jumping */
                this.speed.y = -this.velocity.y;
                this.dirs.up = false;
            } else {
                this.speed.y = 0;
            }
        }
    }

    act(step, level) {
        var newPos = this.getNewPosition(step, level);
        // Handle Collision on the X axes
        this.pos.x = this.handleCollision(level, new Vector(newPos.x, this.pos.y), "x");
        // Handle Collision on the Y axes
        this.pos.y = this.handleCollision(level, new Vector(this.pos.x, newPos.y), "y");
        this.handleJump();
        this.handleDeath(level, step);
    }

    // method to be overridden by child classes
    // handleCollisionTMP(level, type, actor, colision) {
    //     throw new Error("Method 'handleCollisionTMP' must be implemented.");
    // }
}

class Player extends Character {
    constructor(pos) {
        super(pos, Types.PLAYER, new Vector(0.8, 0.8));
        this.arrowCodes = {
            37: "left",
            38: "up",
            39: "right"
        };
        this.DOUBLE_TAP_INTERVAL_MS = 100;
        this.lastTap = 0;
        this.startListeners();
        this.velocity = new Vector(10, 35);
    }

    startListeners() {
        addEventListener("keydown", this.keyHandler.bind(this));
        addEventListener("keyup", this.keyHandler.bind(this));

        var buttonLeft = document.querySelector('.button-left');
        var buttonRight = document.querySelector('.button-right');
        var buttonJump = document.querySelector('.button-jump');

        buttonLeft.addEventListener('mousedown', (event) => { 
            this.dirs.left = true;
            event.preventDefault();
        });
        buttonLeft.addEventListener('mouseup', (event) => { 
            this.dirs.left = false;
            event.preventDefault();
        });
        buttonLeft.addEventListener('touchstart', (event) => { 
            this.dirs.left = true;
            event.preventDefault();
        });
        buttonLeft.addEventListener('touchend', (event) => { 
            this.dirs.left = false;
            event.preventDefault();
        });
    
        buttonRight.addEventListener('mousedown', (event) => { 
            this.dirs.right = true;
            event.preventDefault();
        });
        buttonRight.addEventListener('mouseup', (event) => { 
            this.dirs.right = false;
            event.preventDefault();
        });
        buttonRight.addEventListener('touchstart', (event) => { 
            this.dirs.right = true;
            event.preventDefault();
        });
        buttonRight.addEventListener('touchend', (event) => { 
            this.dirs.right = false;
            event.preventDefault();
        });
    
        buttonJump.addEventListener('mousedown', (event) => { 
            this.dirs.up = true;
            event.preventDefault();
        });
        buttonJump.addEventListener('mouseup', (event) => { 
            this.dirs.up = false;
            event.preventDefault();
        });
        buttonJump.addEventListener('touchstart', (event) => { 
            this.dirs.up = true;
            event.preventDefault();
        });
        buttonJump.addEventListener('touchend', (event) => { 
            this.dirs.up = false;
            event.preventDefault();
        });
    }
    

    keyHandler(event) {
        if (this.arrowCodes.hasOwnProperty(event.keyCode)) {
            this.dirs[this.arrowCodes[event.keyCode]] = event.type === "keydown";
            event.preventDefault();
        }
    }

    touchHandler() {
        // const currentTime = new Date().getTime();
        // const timeDifference = currentTime - this.lastTap;

        // if (event.type === 'touchstart') {
        //     this.dirs.right = event.touches[0].clientX > window.innerWidth / 2;
        //     this.dirs.left = !this.dirs.right;
        //     this.dirs.up = timeDifference < this.DOUBLE_TAP_INTERVAL_MS && timeDifference > 0;
        // } else if (event.type === 'touchend') {
        //     this.dirs.left = false;
        //     this.dirs.right = false;
        //     this.dirs.up = false;
        // }

        // this.lastTap = currentTime;
        // event.preventDefault();
        // var buttonLeft = document.querySelector('.button-left');
        // var buttonRight = document.querySelector('.button-right');
        // var buttonJump = document.querySelector('.button-jump');

        // buttonLeft.addEventListener('mousedown', () => this.dirs.left = true);
        // buttonLeft.addEventListener('mouseup', () => this.dirs.left = false);
        // buttonLeft.addEventListener('touchstart', () => this.dirs.left = true);
        // buttonLeft.addEventListener('touchend', () => this.dirs.left = false);

        // buttonRight.addEventListener('mousedown', () => this.dirs.right = true);
        // buttonRight.addEventListener('mouseup', () => this.dirs.right = false);
        // buttonRight.addEventListener('touchstart', () => this.dirs.right = true);
        // buttonRight.addEventListener('touchend', () => this.dirs.right = false);

        // buttonJump.addEventListener('mousedown', () => this.dirs.up = true);
        // buttonJump.addEventListener('mouseup', () => this.dirs.up = false);
        // buttonJump.addEventListener('touchstart', () => this.dirs.up = true);
        // buttonJump.addEventListener('touchend', () => this.dirs.up = false);
    }

    handleCollisionWithCharacter(level, actor, colision) {
        if (level.status !== null) return;
    
        switch (actor.type) {
             case Types.STAR:
                actor.collect(level);
                break;
             case Types.COIN:
                actor.collect(level);
                break;
            case Types.KOOPA:
                this.isStuck = true;
                if (colision.down) {
                    actor.death();
                } else {
                    level.setStatusLost();
                }
                break;
            case Types.GOOMBA:
                this.isStuck = true;
                if (colision.down) {
                    actor.death();
                } else {
                    level.setStatusLost();
                }
                break;
            case Types.BOO:
                this.isStuck = true;
                level.setStatusLost();
                break;
            case Types.SHELL:
                this.isStuck = true;
                if (!colision.down && (actor.dirs.left || actor.dirs.right)) {
                    level.setStatusLost();
                }
                break;
            case Types.SURPRISE:
                this.isStuck = true;
                if (colision.up) {
                    actor.collect(level);
                }
                break;
            case Types.BLOCK:
                this.isStuck = true;
                break;
        }
    }

    handleCollisionWithObstacle(level, type, colision) {
        if (level.status !== null) {
            this.isStuck = true;
            return;
        }

        switch (type) {
            case Types.LAVA:
                this.isStuck = true;
                level.setStatusLost();
                break;
            case Types.WALL:
                this.isStuck = true;
                break;
            case Types.EARTH:
                this.isStuck = true;
                break;
            case Types.GROUND:
                this.isStuck = true;
                break;
            case Types.FLAG:
                level.setStatusWon();
                break;
        }
    }

    handleDeath(level, step) {
        if (level.status === "lost") {
            this.pos.y += step * 5;
            this.size.y -= step * 5;
        }
    }
}

class Enemy extends Character {
    constructor(pos, type, size) {
        super(pos, type, size);
        this.dirs = { up: false, down: false, left: true, right: false };
    }

    onCharacter(actor) {
        if (actor.type === Types.PLAYER) {
            this.death();
        }
    }

    handleCollisionWithObstacle(level, type, colision) {
        if (level.status !== null) {
            this.isStuck = true;
            return;
        }

        switch (type) {
            case Types.LAVA:
                this.isStuck = true;
                this.death();
                break;
            case Types.WALL:
                this.isStuck = true;
                this.changeDirection(colision);
                break;
            case Types.GROUND:
                this.isStuck = true;
                this.changeDirection(colision);
                break;
            case Types.EARTH:
                this.isStuck = true;
                this.changeDirection(colision);
                break;
        }
    }
}

class Koopa extends Enemy {
    constructor(pos) {
        pos.y -= 0.28;
        super(pos, Types.KOOPA, new Vector(1, 1.28));
    }

    shellTransformation() {
        if (this.type !== Types.SHELL) {
            this.type = Types.SHELL;
            this.size.y = 0.86;
            this.velocity.x = 8;
            this.dirs.left = false;
            this.dirs.right = false;
        }
    }

    death() {
        this.shellTransformation();
    }

    onCharacter(actor) {
        if (actor.type === Types.PLAYER) {
            if (this.dirs.left || this.dirs.right) {
                this.dirs.left = false;
                this.dirs.right = false;
            } else {
                const player = this.getHitbox(actor.pos, actor.size);
                const hitbox = this.getHitbox(this.pos, this.size);
                if (player.left < hitbox.left && hitbox.left < player.right) {
                    this.dirs.right = true;
                } else {
                    this.dirs.left = true;
                }
            }
            actor.dirs.up = true;
            actor.pos.y -= 0.1;
        }
    }

    handleCollisionWithCharacter(level, character, colision) {
        if (level.status !== null) {
            this.isStuck = true;
            return;
        }

        if (this.type !== Types.SHELL && character.type === Types.SHELL) {
            this.isStuck = true;
            if (character.speed.x) {
                this.death();
            } else {
                if (this.dirs.left) {
                    this.dirs.left = false;
                    this.dirs.right = true;
                } else if (this.dirs.right) {
                    this.dirs.right = false;
                    this.dirs.left = true;
                }
            }
        }
    }
}

class Shell extends Koopa {
    constructor(pos) {
        super(pos);
        this.shellTransformation();
        this.dirs.left = true;
    }
}

class Goomba extends Enemy {
    constructor(pos) {
        super(pos, Types.GOOMBA, new Vector(0.8, 0.8));
    }
}

class Boo extends Enemy {
    constructor(pos) {
        super(pos, Types.BOO, new Vector(1, 1));
        this.velocity = new Vector(2, 2);
    }

    act(step, level) {
        var player = level.player;
        this.speed.x = 0;
        this.speed.y = 0;

        if (player.pos.x > this.pos.x) {
            this.speed.x += this.velocity.x;
        } else {
            this.speed.x -= this.velocity.x;
        }
        if (player.pos.y > this.pos.y) {
            this.speed.y += this.velocity.y;
        } else {
            this.speed.y -= this.velocity.y;
        }
        var motion = this.speed.times(step);
        this.pos = this.pos.add(motion);
    }
}

var wobbleSpeed = 8;
var wobbleDist = 0.07;

class Coin {
    constructor(pos) {
        this.type = Types.COIN;
        this.basePos = this.pos = pos;
        this.size = new Vector(.8, .8);
        this.wobble = Math.random() * Math.PI * 2;
        this.point = 10;
    }

    collect(level) {
        level.collectCoin();
        level.removeActor(this);
    }

    act(step) {
        this.wobble += step * wobbleSpeed;
        var wobblePos = Math.sin(this.wobble) * wobbleDist;
        this.pos = this.basePos.add(new Vector(0, wobblePos));
    }
}
class Star {
    constructor(pos) {
        this.type = Types.STAR;
        this.basePos = this.pos = pos;
        this.size = new Vector(.8, .8);
        this.wobble = Math.random() * Math.PI * 2;
        this.point = 50;
    }

    collect(level) {
        level.collectStar();
        level.removeActor(this);
    }

    act(step) {
        this.wobble += step * wobbleSpeed;
        var wobblePos = Math.sin(this.wobble) * wobbleDist;
        this.pos = this.basePos.add(new Vector(0, wobblePos));
    }
}

class Surprise {
    constructor(pos) {
        this.type = Types.SURPRISE;
        this.possibilities = [
            {type: Types.COIN, quantity: 1},
            {type: Types.COIN, quantity: 10},
            {type: Types.STAR, quantity: 1}
        ];
        this.surprise = this.possibilities[Math.floor(Math.random() * this.possibilities.length)];
        this.pos = pos;
        this.size = new Vector(1, 1);
        this.active = true;
    }

    collect(level) {
        if (this.type === Types.SURPRISE) {
            switch (this.surprise.type) {
                case Types.COIN:
                    level.collectCoin(this.surprise.quantity);
                    break;
                case Types.STAR:
                    level.collectStar(this.surprise.quantity);
                    break;
            }
            this.type = Types.BLOCK;
        }
    }
       

    act(step) {}
}

export { Player, Koopa, Enemy, Shell, Coin, Star, Goomba, Boo, Surprise };
