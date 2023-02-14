var Carro = {
  width: 100,     // Images are forced into a width of this many pixels.
  numVisible: 2,  // The number of images visible at once.
  duration: 600,  // Animation duration in milliseconds.
  padding: 2      // Vertical padding around each image, in pixels.
};
var carga = [];
function rotateForward() {
  var carro = Carro.carro,
    children = carro.children,
    firstChild = children[0],
    lastChild = children[children.length - 1];
  carro.insertBefore(lastChild, firstChild);
}
function rotateBackward() {
  var carro = Carro.carro,
    children = carro.children,
    firstChild = children[0],
    lastChild = children[children.length - 1];
  carro.insertBefore(firstChild, lastChild.nextSibling);
}

function animate(begin, end, finalTask) {
  var wrapper = Carro.wrapper,
    carro = Carro.carro,
    change = end - begin,
    duration = Carro.duration,
    startTime = Date.now();
  carro.style.top = begin + 'px';
  var animateInterval = window.setInterval(function () {
    var t = Date.now() - startTime;
    if (t >= duration) {
      window.clearInterval(animateInterval);
      finalTask();
      return;
    }
    t /= (duration / 2);
    var top = begin + (t < 1 ? change / 2 * Math.pow(t, 3) :
      change / 2 * (Math.pow(t - 2, 3) + 2));
    carro.style.top = top + 'px';
  }, 1000 / 60);
}
carga.push(load);

function load() {
  var carro = Carro.carro = document.getElementById('carro'),
    images = carro.getElementsByTagName('img'),
    numImages = images.length,
    imageWidth = Carro.width,
    aspectRatio = images[0].width / images[0].height,
    imageHeight = imageWidth / aspectRatio,
    padding = Carro.padding,
    rowHeight = Carro.rowHeight = imageHeight + 2 * padding;
  carro.style.width = imageWidth + 'px';
  for (var i = 0; i < numImages; ++i) {
    var image = images[i],
      frame = document.createElement('div');
    frame.className = 'pictureFrame';
    var aspectRatio = image.offsetWidth / image.offsetHeight;
    image.style.width = frame.style.width = imageWidth + 'px';
    image.style.height = imageHeight + 'px';
    image.style.paddingTop = padding + 'px';
    image.style.paddingBottom = padding + 'px';
    frame.style.height = rowHeight + 'px';
    carro.insertBefore(frame, image);
    frame.appendChild(image);
  }
  Carro.rowHeight = carro.getElementsByTagName('div')[0].offsetHeight;
  carro.style.height = Carro.numVisible * Carro.rowHeight + 'px';
  carro.style.visibility = 'hidden'; // Establecer la visibilidad como oculto inicialmente
  var wrapper = Carro.wrapper = document.createElement('div');
  wrapper.id = 'carroWrapper';
  wrapper.style.width = carro.offsetWidth + 'px';
  wrapper.style.height = carro.offsetHeight + 'px';
  carro.parentNode.insertBefore(wrapper, carro);
  wrapper.appendChild(carro);
  var prevButton = document.getElementById('prev'),
    nextButton = document.getElementById('next');
  prevButton.onclick = function () {
    prevButton.disabled = nextButton.disabled = true;
    rotateForward();
    animate(-Carro.rowHeight, 0, function () {
      carro.style.top = '0';
      prevButton.disabled = nextButton.disabled = false;
    });
  };

  var carrito = document.getElementsByClassName('carrito')[0];
  carrito.onmouseover = function () {
    carro.style.visibility = 'visible';
  }

  carrito.onmouseout = function () {
    carro.style.visibility = 'hidden';
  }

  nextButton.onclick = function () {
    prevButton.disabled = nextButton.disabled = true;
    animate(0, -Carro.rowHeight, function () {
      rotateBackward();
      carro.style.top = '0';
      prevButton.disabled = nextButton.disabled = false;
    });
  };
};