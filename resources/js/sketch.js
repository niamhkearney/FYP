
new p5();

var stroke_color = '#000000';
var background_color = '#707070';
var stroke_weight = 10;
var pen_shape = ['dot', 'square'];

//gui setup
var visible = true;
var gui;

function setup() {
  let drawCanvas = createCanvas(600, 500);
  drawCanvas.parent('sketchCanvas');
  background(background_color);

  gui = createGui('Pen Tool');
  colorMode(HSB);
  gui.addGlobals('pen_shape', 'stroke_color');
  sliderRange(1, 100, 1);
  gui.addGlobals('stroke_weight');
}

function draw() {
  fill(255);
  stroke(stroke_color);
  strokeWeight(stroke_weight);
}

function mouseDragged() {
  switch (pen_shape) {
    case 'dot':
      line(mouseX, mouseY, pmouseX, pmouseY);
      break;

    case 'square':
      rect(mouseX, mouseY, stroke_weight, stroke_weight);
      line(mouseX, mouseY, pmouseX, pmouseY);
      break;
  }
}

function mouseClicked() {
  switch (pen_shape) {
    case 'dot':
      point(mouseX, mouseY);
      break;

    case 'square':
      rect(mouseX, mouseY, stroke_weight, stroke_weight);
      break;
  }
}

function randomiseName() {
  let name = "u";

  //Adding 9 extra, randomised numbers to the end of the file name
  for (let i = 0; i < 9; i++) {
    let x = Math.floor((Math.random() * 9) + 1);
    name += x;
  }
  return name;
}

function clearButton() {
  clear();
  background(background_color);
}

function saveButton() {
  save(randomiseName() + '.jpg');
}