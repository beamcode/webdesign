import Level from './Level.js';
import Display from './Display.js';
import ScreenManager from './ScreenManager.js';

class Game {
    constructor(plans, parent) {
        this.plans = plans;
        this.parent = parent;
        this.data = null;
        this.screenManager = new ScreenManager(this, parent);
        this.screenManager.displayMenu();
    }

    init() {
        this.data = {
            life: 1,
            levelNum: 0,
            score: 0,
            coins: 0,
            stars: 0
        }
    }

    save(level) {
        this.data.score = level.score;
        this.data.coins = level.coins;
        this.data.stars = level.stars;
        this.data.life  = level.life;
    }

    handleLevelCompletion(status) {
        if (status === "lost") {
            this.data.life -= 1;
            if (this.data.life <= 0) {
                this.handleDefeat();
            }
            this.run();
        } else if (this.data.levelNum < this.plans.length - 1) {
            this.data.levelNum++;
            this.run();
        } else {
            this.handleVictory();
        }
    }

    handleVictory() {
        console.log("You win!", this.data.score);
        this.screenManager.displayWinScreen(this.data.score);
    }

    handleDefeat() {
        console.log("You lose!", this.data.score);
        this.screenManager.displayLoseScreen(this.data.score);
    }

    play() {
        console.log(this.data);
        this.init();
        console.log(this.data);
        this.run();
    }

    run() {
        let level = new Level(this.plans[this.data.levelNum], this.data);
        let display = new Display(this.parent, level);
        let lastTime = null;

        const frame = (timestamp) => {
            if (lastTime !== null) {
                let deltaTime = Math.min(timestamp - lastTime, 100) / 1000;
                level.animate(deltaTime, this.dirs);
                display.drawFrame(deltaTime);
                if (level.isFinished()) {
                    this.save(level);
                    display.clear();
                    this.handleLevelCompletion(level.status);
                    return;
                }
            }
            lastTime = timestamp;
            if (this.data.life > 0)
                requestAnimationFrame(frame);
            else
                display.clear();
        }

        requestAnimationFrame(frame);
    }
}

export { Game };