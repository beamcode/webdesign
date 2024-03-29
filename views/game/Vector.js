class Vector {
    constructor(x, y) {
        this.x = x;
        this.y = y;
    }
    add(other) {
        return new Vector(this.x + other.x, this.y + other.y);
    }
    times(scale) {
        return new Vector(this.x * scale, this.y * scale);
    }
}

export default Vector;
