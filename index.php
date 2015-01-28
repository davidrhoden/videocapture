<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Video Capture</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </head>
    <body>
     <div id="container">
     <div id="oval"></div>
  <video id="screenshot-stream" class="videostream" autoplay></video>
  <div id="styler"></div>
  <img id="screenshot" src="">
  <canvas id="screenshot-canvas" style="display: none;"></canvas>
  <p><button id="screenshot-button">Capture</button> <button id="screenshot-stop-button">Stop</button></p>
</div>
<div class="styleselector">
<a id="cowboy" href="#">cowboy</a> 
<a id="girl" href="#">girl</a> 
</div>
<form action="greenscreen.php" method="POST" onSubmit="fillFields()">
<input type="hidden" name="underlay" id="underlay" value="">
<input type="hidden" name="overlay" id="overlay" value="">
<input type="submit" name="submit"  value="export photo">
</form>
</body>
<script>
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
  $('#overlay').attr("value") = $('#styler').attr('class');
  $('#underlay').attr("value") = $('#screenshot').attr('src');
  alert("value: " + $('#overlay').attr("value"));
}
</script>

</html>