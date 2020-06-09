
var bird;
var pipes = [];

function setup() {
  createCanvas(1000, 400);
  
  bird = new Bird();
  pipes.push(new Pipe());
}

function draw() {
  background(248, 194, 145);
  
  for (var i = pipes.length - 1; i >= 0; i--) {
    pipes[i].show();
    pipes[i].update();

    if (pipes[i].hits(bird)) {
      console.log('Colpito');
      //i.show();
    }

    if (pipes[i].offscreen()) {
      pipes.splice(i, 1);
    }
  }

  bird.update();
  bird.show();

  if (frameCount % 75 == 0) {
    pipes.push(new Pipe());
  }
}

function keyPressed() {
  if (key == ' ') {
    bird.up();
    //console.log("SPACE");
  }
}
