let c = 'black';

function setup() {
  createCanvas(400, 400);
  background(220);
}

function draw() {
  fill(255);
  stroke(c);
  strokeWeight(10);
}

function mouseDragged() {
  line(mouseX, mouseY, pmouseX, pmouseY);
}

function mouseClicked() {
  point(mouseX, mouseY);
}

function keyTyped() {
  //eraser tool
  if (key === 'e') {
    c = 220;
  }
  else if (key === 'p') {
    c = 0;
  }
}
