function errorCallback(e) {
  if (e.code == 1) {
    alert('User denied access to their camera');
  } else {
    alert('getUserMedia() is not supported in your browser.');
  }
  //e.target.src = 'http://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.ogv';
}

function hasGetUserMedia() {
  return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia || navigator.msGetUserMedia);
}

(function() {
var video = document.querySelector('#screenshot-stream');
var button = document.querySelector('#screenshot-button');
var canvas = document.querySelector('#screenshot-canvas');
var img = document.querySelector('#screenshot');
var ctx = canvas.getContext('2d');
var localMediaStream = null;

function sizeCanvas() {
  // video.onloadedmetadata not firing in Chrome so we have to hack.
  // See crbug.com/110938.
  setTimeout(function() {
    canvas.width = 640;
    canvas.height = 480;
    img.width = 640;
    img.height = 480;
  }, 100);
}

function snapshot() {
  ctx.drawImage(video, 0, 0);
  img.src = canvas.toDataURL('image/png');
 // document.getElementById("dataurl").innerHTML = video.videoHeight + canvas.toDataURL('image/png');
  document.getElementById("screenshot").innerHTML = video.videoHeight + canvas.toDataURL('image/png');

}

button.addEventListener('click', function(e) {
  if (localMediaStream) {
    snapshot();
    return;
  }

  if (navigator.getUserMedia) {
    navigator.getUserMedia('video', function(stream) {
      video.src = stream;
      localMediaStream = stream;
      sizeCanvas();
      button.textContent = 'Take Shot';
    }, errorCallback);
  } else if (navigator.webkitGetUserMedia) {
    navigator.webkitGetUserMedia({video: true}, function(stream) {
      video.src = window.URL.createObjectURL(stream);
      localMediaStream = stream;
      sizeCanvas();
      button.textContent = 'Take Shot';
    }, errorCallback);
  } else {
    errorCallback({target: video});
  }
}, false);

video.addEventListener('click', snapshot, false);

document.querySelector('#screenshot-stop-button').addEventListener('click', function(e) {
  video.pause();
  localMediaStream.stop(); // Doesn't do anything in Chrome.
}, false);
})();


$("#cowboy").on("click", function( event ) {
  event.preventDefault();
  $('#styler').removeClass();
  $('#styler').addClass('cowboy');
});

$("#girl").on("click", function( event ) {
  event.preventDefault();
  $('#styler').removeClass();
  $('#styler').addClass('girl');
});

function fillFields() {
  alert($('#screenshot').attr('src'));
  $('#overlay').val($('#styler').attr('class'));
  $('#underlay').val($('#screenshot').attr('src'));
  alert("value: " + $('#overlay').attr('value'));
}