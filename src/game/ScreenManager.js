function element(name, className) {
    var elem = document.createElement(name);
    if (className) elem.className = className;
    return elem;
}

class ScreenManager {
    constructor(game, parent) {
        this.game = game;
        this.parent = parent;
        this.skins = ['skin0', 'skin1', 'skin2', 'skin3', 'skin4', 'skin5', 'skin6']; // List of skins to display
        this.wrap = null;
    }

    displayMenu() {
        this.wrap = this.parent.appendChild(element("div", "game-menu"));
        let title = document.createElement('h2');
        title.textContent = "Select your skin !";
        this.wrap.appendChild(title);
    
        let skinDisplay = document.createElement('div');
        skinDisplay.id = 'skins';
        let currentSkinButton = null;
        for (let i = 0; i < this.skins.length; i++) {
            let skin = this.skins[i];
            let skinButton = element('button');
            skinButton.classList.add('skin-button'); 
    
            let skinImg = document.createElement('img');
            skinImg.src = `./assets/images/${skin}.png`;
            skinButton.appendChild(skinImg);
    
            for (let j = 1; j <= 6; j++) {
                let star = document.createElement('div');
                star.classList.add('star-animation', `star-${j}`);
                skinButton.appendChild(star);
            }
    
            this.addOnClick(skinButton, () => {
                if (currentSkinButton) {
                    currentSkinButton.classList.remove('active');
                }
                skinButton.classList.add('active');
                currentSkinButton = skinButton;
                this.selectSkin(skin);
            });
            skinDisplay.appendChild(skinButton);
    
            if (i === 0) {
                skinButton.classList.add('active');
                currentSkinButton = skinButton;
                this.selectSkin(skin);
            }
        }
        this.wrap.appendChild(skinDisplay);
    
        let startButton = element('button', 'btn');
        startButton.textContent = 'Play';
        this.addOnClick(startButton, () => {
            this.wrap.parentNode.removeChild(this.wrap);
            this.game.play();
        });
        this.wrap.appendChild(startButton);
    }

    displayWinScreen(score) {
        this.wrap = this.parent.appendChild(element("div", "win"));
        let winMessage = document.createElement('h2');
        let scoreMessage = element('h1', "score");
        winMessage.textContent = `You Win!`;
        scoreMessage.textContent = score;
        this.wrap.appendChild(winMessage);
        this.wrap.appendChild(scoreMessage);
    
        let returnButton = element('button', 'btn');
        returnButton.textContent = 'Menu';
        this.addOnClick(returnButton, () => {
            this.wrap.parentNode.removeChild(this.wrap);
            this.displayMenu();
        });
        this.wrap.appendChild(returnButton);
    }
    
    displayLoseScreen(score) {
        this.wrap = this.parent.appendChild(element("div", "lose"));
        let winMessage = document.createElement('h2');
        let scoreMessage = element('h1', "score");
        winMessage.textContent = `You Lose!`;
        scoreMessage.textContent = score;
        this.wrap.appendChild(winMessage);
        this.wrap.appendChild(scoreMessage);
    
        let returnButton = element('button', 'btn');
        returnButton.textContent = 'Try Again';
        this.addOnClick(returnButton, () => {
            this.wrap.parentNode.removeChild(this.wrap);
            this.displayMenu();
        });
        this.wrap.appendChild(returnButton);
    }

    addOnClick(button, func) {
        button.addEventListener('click', func);
        // button.addEventListener('touchend', func);
    }

    selectSkin(skin) {
        document.documentElement.style.setProperty('--skin', `url(../assets/images/${skin}.png)`);
    }
}

export default ScreenManager;
