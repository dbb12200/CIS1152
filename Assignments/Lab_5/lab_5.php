<?php
$header = <<< EOD
<html>
<head>
<title>Simple PHP Form Example</title>
</head>
<body>
EOD;

$footer = <<< EOD
</body>
</html>
EOD;

define('GRAVITY', 9.8);

function truncateFloat($float_value)
{
	return $truncate = (int) ($float_value*100)/100;
}

/**
 * @param $degrees_f
 */
function farenheit2Kelvin($degrees_f)
{
	return ($degrees_f-32)*5/9+273.15;
}

/**
 * @param $area
 */
function dodecahedronVolume($area)
{
	return((15+(7*sqrt(5)))/4)*pow($area,3);
}

/**
 * @param $height
 */
function impactVelocity($height)
{
	return sqrt(2*GRAVITY*$height);
}

$form_layout = <<< EOD
<p>
<form method = "post" action="">
<label name="truncateFloat">Floating Point Value</label><input type="text" name="truncateFloat"><br>
<label name="farenheit2Kelvin">Farenheit Value</label><input type="text" name="farenheit2Kelvin"><br>
<label name="dodecahedronVolume">Dodecahedron Side Value</label><input type="text" name="dodecahedronVolume"><br>
<label name="impactVelocity">Height of Fall Value</label><input type="text" name="impactVelocity"><br>
<input type="submit" value = "submit" name = "submit">
</form>
</p>
EOD;

if(isset($_POST['submit'])){
	$truncateFloatResult = truncateFloat($_POST["truncateFloat"]);
	$farenheit2KelvinResult = farenheit2Kelvin($_POST["farenheit2Kelvin"]);
	$dodecahedronVolumeResult = dodecahedronVolume($_POST["dodecahedronVolume"]);
	$impactVelocityResult = impactVelocity($_POST["impactVelocity"]);
} else {
	$truncateFloatResult = "";
	$farenheit2KelvinResult = "";
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
	if(!empty($farenheit2KelvinResult)){
		$form_results .= "the kelvin temperature is: " . $farenheit2KelvinResult . ".<br>";
	}
	if(!empty($dodecahedronVolumeResult)){
		$form_results .= "the volume of the dodecahedron is: " . $dodecahedronVolumeResult . ".<br>";
	}
	if(!empty($impactVelocityResult)){
		$form_results .= "the splat value is: " . $impactVelocityResult . ".<br>";
	}
	$form_results .= $footer;
	
	echo $form_results;
}
?>