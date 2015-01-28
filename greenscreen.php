<?php 
error_reporting(E_ALL); 
ini_set( 'display_errors','1');
echo "over: "  . $_POST["overlay"];
echo "<br>under: " . $_POST["underlay"];
// header('Content-type: image/jpeg');

// $underlay = new Imagick("img/cowboy.png");
// $overlay = new Imagick("img/girl.png");


$underlay = new Imagick('<?php echo $_POST["underlay"]; ?>');
$overlay = new Imagick('<?php echo $_POST["overlay"]; ?>');

$underlay->compositeImage($overlay, Imagick::COMPOSITE_OVER, 0, 0);
echo $underlay;
?>

