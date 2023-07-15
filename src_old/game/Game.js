import Level from './Level.js';
var arrowCodes = {
    37: "left",
    38: "up",
    39: "right"
};
function trackKeys(codes) {
    var touchstartX = 0;
    var touchstartY = 0;
    var touchendX = 0;
    var touchendY = 0;
    var pressed = Object.create(null);
    function handler(event) {
        console.log("key");
        if (codes.hasOwnProperty(event.keyCode)) {
            var down = event.type == "keydown";
            pressed[codes[event.keyCode]] = down;
            event.preventDefault();
        }
    }
    addEventListener('touchstart', function(event) {
        touchstartX =  event.touches[0].clientX;
        touchstartY =  event.touches[0].clientY;
        console.log("Start");
        console.log( event.touches[0].clientX);
        if (touchstartX > window.innerWidth / 2) {
            console.log("RIGHT !!!!!!!!!!!!");
            pressed["right"] = true;
            pressed["left"] = false;
        } else {
            console.log("LEFT !!!!!!!!!!!!");
            pressed["left"] = true;
            pressed["right"] = false;
        }
    }, false);
    addEventListener('touchend', function(event) {
        touchendX =  event.changedTouches[0].clientX;
        touchendY =  event.changedTouches[0].clientY;
        console.log("END");
        handleGesure();
        pressed["left"] = false;
        pressed["right"] = false;
    }, false); 
    function handleGesure() {
        var swiped = 'swiped: ';
        if (touchendX < touchstartX) {
            console.log(swiped + 'left!');
        }
        if (touchendX > touchstartX) {
            console.log(swiped + 'right!');
        }
        if (touchendY < touchstartY) {
            console.log(swiped + 'down!');
        }
        if (touchendY > touchstartY) {
            console.log(swiped + 'left!');
        }
        if (touchendY == touchstartY) {
            console.log('tap!');
        }
    }
    let lastTap = 0;
        function detectDoubleTap(event) {
            if (event.type == "touchend") {
                pressed["up"] = false;
                console.log("STOP--------------------------");
            } else {
                const curTime = new Date().getTime();
                const tapLen = curTime - lastTap;
                if (tapLen < 500 && tapLen > 0) {
                  console.log('Double tapped!');
                  pressed["up"] = true;
                  event.preventDefault();
                } else {
                  pressed["up"] = false;
                  console.log("-------------------------------------------");
                }
                lastTap = curTime;
            }
        };
      
    addEventListener("keydown", handler);
    addEventListener("keyup", handler);
    // addEventListener("doubletap", handlerUp);
    addEventListener('touchend', detectDoubleTap, { passive: false });
    addEventListener('touchstart', detectDoubleTap, { passive: false });
    // addEventListener("touchstart", handlerTouch);
    // addEventListener("touchstop", handlerTouch);
    return pressed;
}
function runAnimation(frameFunc) {
    var lastTime = null;
    function frame(time) {
        var stop = false;
        if (lastTime != null) {
            var timeStep = Math.min(time - lastTime, 100) / 1000;
            stop = frameFunc(timeStep) === false;
        }
        lastTime = time;
        if (!stop) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
}
var arrows = trackKeys(arrowCodes);
function runLevel(level, Display, andThen) {
    var display = new Display(document.querySelector(".game"), level);
    runAnimation(function(step) {
        level.animate(step, arrows);
        display.drawFrame(step);
        if (level.isFinished()) {
            display.clear();
            if (andThen) andThen(level.status);
            return false;
        }
    });
}
function runGame(plans, Display) {
    function startLevel(n) {
        runLevel(new Level(plans[n]), Display, function(status) {
            if (status == "lost") startLevel(n);
            else if (n < plans.length - 1) startLevel(n + 1);
            else alert("You win!");
        });
    }
    startLevel(0);
}
export { runGame };
