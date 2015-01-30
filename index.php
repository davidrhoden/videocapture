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

<script src="scripts.js"></script>
</html>