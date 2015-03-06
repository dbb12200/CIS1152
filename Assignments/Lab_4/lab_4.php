<?php
/**
 * Lab 4, Form and Post Lab
 *
 * This lab focuses on your understanding of arithmatic.
 *
 * @version 1.0
 * @author YOUR_NAME <YOUR_EMAIL_ADDRESS@vtc.edu>
 * @since 20150120
 */
/**
 * Outputs to the console a truncated float.
 *
 * Takes in a floating point number and truncates in to two places of precision.
 * Then returns to the output to the console.
 *
 * @param $float_value
 */
define('GRAVITY', 9.8);
function truncateFloat($float_value)
{	$truncate = (int) ($float_value*100)/100;
	echo "The truncated version of " . $float_value . " is: " . $truncate;
}
/**
 * @param $degrees_f
 */
function farenheit2Kelvin($degrees_f)
{
	$temp_k= ($degrees_f-32)*(5/9)+273.15;
	echo "The temperature of " . $degrees_f . " degrees F is: " . $temp_k;
}
/**
 * @param $area
 */
function dodecahedronVolume($area)
{
	$volume = ((15+(7*sqrt(5)))/4)*pow($area,3);
	echo "The area of a dodecahedron with a face area of " . $area . " is: " . $volume;
}
/**
 * @param $height
 */
function impactVelocity($height)
{
	$vel = sqrt(2*GRAVITY*$height);
	echo "The force the thingy at height " . $height . " will hit the ground at is: " . $vel;
}


<!DOCTYPE html>
<html>
<head>
    <title>Class 4 Lab</title>
</head>
<body>

</body>
</html>
$form_layout = <<< EOD
<p>
<form method = "post" action="">
<label name="truncateFloat">Floating Point Value</label><input type="text" name="truncateFloat"><br>
<label name="fahrenheit2Kelvin">Fahrenheit Value</label><input type="text" name="fahrenheit2Kelvin"><br>
<label name="dodecahedronVolume">Dodecahedron Side Value</label><input type="text" name="dodecahedronVolume"><br>
<label name="impactVelocity">Height of Fall Value</label><input type="text" name="impactVelocity"><br>
<input type="submit" value = "submit" name = "submit">
</form>
</p>
EOD;

if(isset($_POST[submit])){
	$truncateFloatResult = truncateFloat($_POST["truncateFloat"]);
	$fahrenheit2KelvinResult = fahrenheit2Kelvin($_POST["fahrenheit2Kelvin"]);
	$dodecahedronVolumeResult = dodecahedronVolume($POST["dodecahedronVolume"]);
	$impactVelocityResult = impactVelocity($_POST["impactVelocity"]);
} else {
	$truncateFloatResult = "";
	$fahrenheit2KelvinResult = "";
	$dodecahedronVolumeResult = "";
	$impactVelocityResult = "";
}

if(!isset($_POST['submit'])){
	echo $form_layout;
}
else{
	$form_results = $header;
	if(!empty($truncateFloatResult)){
		$form_results .= "the truncated floating point value is: " . $truncateFloatResult . ".<br>";
	}
	if(!empty($fahrenheit2Kelvin)){
		$form_results .= "the kelvin temperature is: " . $fahrenheit2KelvinResult . ".<br>";
	}
	if(!empty($dodecahedronVolume)){
		$form_results .= "the volume of the dodecahedron is: " . $dodecahedronVolumeResult . ".<br>";
	}
	if(!empty($impactVelocityResult)){
		$form_results .= "the splat value is: " . $impactVelocityResult . ".<br>";
	}
	$form_results .= $footer;
	echo form_results;
}
?>