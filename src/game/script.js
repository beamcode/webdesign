import { runGame } from './Game.js';
import DOMDisplay from './DOMDisplay.js';

async function loadMap(fileName) {
    try {
        const response = await fetch(`../assets/maps/${fileName}`);
        return await response.text();
    } catch (error) {
        console.error('Error loading map:', error);
    }
}

async function loadAllMaps() {
    const mapFiles = ['map1.txt', 'map2.txt', 'map3.txt', 'map4.txt'];
    const levels = [];

    for (let file of mapFiles) {
        const map = await loadMap(file);
        console.log(map);
        const mapLines = map.split('\n');
        levels.push(mapLines);
    }

    return levels;
}

loadAllMaps().then(levels => {
    runGame(levels, DOMDisplay);
});