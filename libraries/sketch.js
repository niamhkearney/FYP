
  new p5();

  var stroke_color = '#000000';
  var background_color = '#707070';
  var stroke_weight = 10;
  var pen_shape = ['dot', 'square'];

//gui setup
  var visible = true;
  var gui;

  function setup() {
    let drawCanvas = createCanvas(600, 600);
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

  function keyTyped() {
    //eraser tool
    if (key === 'e') {
      c = 220;
    } else if (key === 'p') {
      c = 0;
    } else if (key === 'c') {
      clear();
      background(background_color);
    }
  }

  function clearButton() {
    clear();
    background(background_color);
  }