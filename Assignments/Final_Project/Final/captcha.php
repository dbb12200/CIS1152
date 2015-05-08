<?php
//Starts the captcha session
session_start();
//generates a random number for our session
$randNum=rand(0,2000);
//Hands the session our random number
$_SESSION["code"]=$randNum;
//creates the picture variables for our captcha
$image = imagecreatetruecolor(50, 24);
$backgroud = imagecolorallocate($image, 171, 190, 204);
$font = imagecolorallocate($image, 255, 255, 0);
//creates the image for our captcha
imagefill($image, 0, 0, $background);
imagestring($image, 5, 5, 5,  $randNum, $font);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>