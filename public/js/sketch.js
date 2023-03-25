let drawCanvas;
let graphics;
// new p5();

var stroke_color = '#000000';
var background_color = '#707070';
var stroke_weight = 10;
var pen_shape = ['dot', 'square', 'erase'];
var layer = ['layer1', 'layer2'];

//gui setup
var visible = true;
var gui;

function setup() {
  drawCanvas = createCanvas(600, 500);
  drawCanvas.parent('sketchCanvas');

  graphics = createGraphics(600, 500);

  background(background_color);

  gui = createGui('Pen Tool');
  colorMode(HSB);
  gui.addGlobals('pen_shape', 'stroke_color');
  sliderRange(1, 100, 1);
  gui.addGlobals('stroke_weight');
  gui.addGlobals('layer');
  gui.setPosition(50, 100);
}

function draw() {
  fill(255);
  stroke(stroke_color);
  strokeWeight(stroke_weight);

  graphics.stroke(stroke_color);
  graphics.strokeWeight(stroke_weight);

  image(graphics, 0, 0);
}


function mouseDragged() {
    if(layer === 'layer2') {
        switch (pen_shape) {
            case 'dot':
                noErase();
                strokeCap(ROUND);
                line(mouseX, mouseY, pmouseX, pmouseY);
                break;

            case 'square':
                noErase();
                // rect(mouseX, mouseY, stroke_weight, stroke_weight)
                strokeCap(SQUARE);
                line(mouseX, mouseY, pmouseX, pmouseY);
                break;

            case 'erase':
                erase();
                strokeCap(ROUND);
                line(mouseX, mouseY, pmouseX, pmouseY);
                break;
        }
    }
    else {
        switch (pen_shape) {
            case 'dot':
                graphics.noErase();
                graphics.strokeCap(ROUND);
                graphics.line(mouseX, mouseY, pmouseX, pmouseY);
                break;

            case 'square':
                graphics.noErase();
                // rect(mouseX, mouseY, stroke_weight, stroke_weight)
                graphics.strokeCap(SQUARE);
                graphics.line(mouseX, mouseY, pmouseX, pmouseY);
                break;

            case 'erase':
                graphics.erase();
                graphics.strokeCap(ROUND);
                graphics.line(mouseX, mouseY, pmouseX, pmouseY);
                break;
        }
    }
}

function mousePressed() {
  switch (pen_shape) {
    case 'dot':
      point(mouseX, mouseY);
      break;

    case 'square':
      rect(mouseX, mouseY, stroke_weight / 10, stroke_weight / 10);
      break;
    }
}

function clearButton() {
    let text = "Are you sure you want to clear your canvas?";
    if(confirm(text) === true) {
        clear();
        graphics.clear();
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
