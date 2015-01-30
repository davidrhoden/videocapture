<?php 
error_reporting(E_ALL); 
ini_set( 'display_errors','1');
//echo "over: "  . $_POST["overlay"];
//echo "<br>under: " . $_POST["underlay"];
// header('Content-type: image/jpeg');

// $underlay = new Imagick("img/cowboy.png");
// $overlay = new Imagick("img/girl.png");

if ($overlay="cowboy") {
	$overlay_src = "img/cowboy.png";
} else if ($overlay="cowboy") {
	$overlay_src = "img/girl.png";
}

$underlay_src = $_POST["underlay"];
//$underlay = new Imagick($underlay_src);
$overlay = new Imagick($overlay_src);
//echo $underlay_src;
echo $overlay;
$underlay->compositeImage($overlay, Imagick::COMPOSITE_OVER, 0, 0);
echo $underlay;
?>

<div id="underlay_container" style = "border: 1px solid black; height: 480px; width: 640px;"></div>
<script src="scripts.js"></script>
<script>
sizeCanvas();
snapshot();
</script>