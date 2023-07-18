import Vector from './Vector.js';
var playerXSpeed = 10;
var gravity = 120;
var jumpSpeed = 45;
class Player {
    constructor(pos) {
        this.type = "player";
        this.pos = pos.add(new Vector(0, -.5));
        this.size = new Vector(.5, 1);
        this.speed = new Vector(0, 0);
    }
    moveX(step, level, keys) {
        this.speed.x = 0;
        if (keys.left)
            this.speed.x -= playerXSpeed;
        if (keys.right)
            this.speed.x += playerXSpeed;
        var motion = new Vector(this.speed.x * step, 0);
        var newPos = this.pos.add(motion);
        var obstacle = level.obstacleAt(newPos, this.size);
        if (obstacle)
            level.playerTouched(obstacle);
        else
            this.pos = newPos;
    }
    moveY(step, level, keys) {
        this.speed.y += step * gravity;
        var motion = new Vector(0, this.speed.y * step);
        var newPos = this.pos.add(motion);
        var obstacle = level.obstacleAt(newPos, this.size);
        if (obstacle) {
            level.playerTouched(obstacle);
            if (keys.up && this.speed.y > 0)
                this.speed.y = -jumpSpeed;
            else
                this.speed.y = 0;
        } else {
            this.pos = newPos;
        }
    }
    act(step, level, keys) {
        this.moveX(step, level, keys);
        this.moveY(step, level, keys);
        var otherActor = level.actorAt(this);
        if (otherActor)
            level.playerTouched(otherActor.type, otherActor);
        // Losing animation
        if (level.status == "lost") {
            this.pos.y += step;
            this.size.y -= step;
        }
    }
}
class Lava {
    constructor(pos, ch) {
        this.type = "Lava";
        this.pos = pos;
        this.size = new Vector(1, 1);
        if (ch === "=")
            this.speed = new Vector(2, 0);
        else if (ch === '|')
            this.speed = new Vector(0, 2);
        else if (ch === 'v') {
            this.speed = new Vector(0, 3);
            this.repeatPos = pos;
        }
    }
    act(step, level) {
        var newPos = this.pos.add(this.speed.times(step));
        if (!level.obstacleAt(newPos, this.size))
            this.pos = newPos;
        else if (this.repeatPos)
            this.pos = this.repeatPos;
        else
            this.speed = this.speed.times(-1);
    }
}
var wobbleSpeed = 8;
var wobbleDist = 0.07;
class Coin {
    constructor(pos) {
        this.type = "coin";
        this.basePos = this.pos = pos;
        this.size = new Vector(.6, .6);
        this.wobble = Math.random() * Math.PI * 2;
    }
    act(step) {
        this.wobble += step * wobbleSpeed;
        var wobblePos = Math.sin(this.wobble) * wobbleDist;
        this.pos = this.basePos.add(new Vector(0, wobblePos));
    }
}
export { Player, Lava, Coin };
