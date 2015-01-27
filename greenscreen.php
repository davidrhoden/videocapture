<?php phpinfo(); 
//header('Content-type: image/jpeg');

$topbar = new Imagick("img/cowboy.png");
$tapir = new Imagick("img/grnscrnmale.jpg");

$tapir->compositeImage($topbar, Imagick::COMPOSITE_OVER, 0, 0);
echo $tapir;
?>

<?php phpinfo(); ?>

