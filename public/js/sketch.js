let drawCanvas;
new p5();

var stroke_color = '#000000';
var background_color = '#707070';
var stroke_weight = 10;
var pen_shape = ['dot', 'square', 'erase'];

//gui setup
var visible = true;
var gui;

function setup() {
  drawCanvas = createCanvas(600, 500);
  drawCanvas.parent('sketchCanvas');
  background(background_color);
  gui = createGui('Pen Tool');
  colorMode(HSB);
  gui.addGlobals('pen_shape', 'stroke_color');
  sliderRange(1, 100, 1);
  gui.addGlobals('stroke_weight');
  gui.setPosition(50, 100);
}

function draw() {
  fill(255);
  stroke(stroke_color);
  strokeWeight(stroke_weight);
}

function mouseDragged() {
  switch (pen_shape) {
    case 'dot':
        noErase();
      line(mouseX, mouseY, pmouseX, pmouseY);
      break;

    case 'square':
        noErase();
      rect(mouseX, mouseY, stroke_weight, stroke_weight);
      line(mouseX, mouseY, pmouseX, pmouseY);
      break;

      case 'erase':
        erase();
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

function keyPressed() {
    if (value === 'E') {
        value = 255;
    } else {
        value = 0;
    }
}

function clearButton() {
    let text = "Are you sure you want to clear your canvas?";
    if(confirm(text) === true) {
        clear();
        background(background_color);
    }
}

function saveButton() {
  save('myHexSketch' + '.png');
}

function uploadButton() {
    document.getElementById("uploadForm2").style.display = "block";
}

function submitButt() {
    console.log("hi");
    document.getElementById("myIMG").value = drawCanvas.elt.toDataURL('image/png');
    let form = document.getElementById("uploadForm");
    form.submit();
}
