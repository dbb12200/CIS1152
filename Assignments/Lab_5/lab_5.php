<?php
<<<<<<< HEAD
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
=======

/**
 * Lab 2, Arithmatic Lab
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
>>>>>>> upstream/master

define('GRAVITY', 9.8);

function truncateFloat($float_value)
{
<<<<<<< HEAD
	return $truncate = (int) ($float_value*100)/100;
=======
    echo (int) floatval($float_value * 100) / 100;
>>>>>>> upstream/master
}

/**
 * @param $degrees_f
 */
function farenheit2Kelvin($degrees_f)
{
<<<<<<< HEAD
	return ($degrees_f-32)*5/9+273.15;
=======
    echo ($degrees_f - 32) * 5 / 9 + 273.15;
>>>>>>> upstream/master
}

/**
 * @param $area
 */
function dodecahedronVolume($area)
{
<<<<<<< HEAD
	return((15+(7*sqrt(5)))/4)*pow($area,3);
=======
    echo pow($area, 3) / 4 * (15 + 7 * sqrt(5));
>>>>>>> upstream/master
}

/**
 * @param $height
 */
function impactVelocity($height)
{
<<<<<<< HEAD
	return sqrt(2*GRAVITY*$height);
=======
    echo sqrt(2 * GRAVITY * $height);
}

if (isset($_POST['submit'])) {
    $truncateFloatInput = $_POST["truncateFloat"];
    $farenheit2KelvinInput = $_POST["farenheit2Kelvin"];
    $dodecahedronVolumeInput = $_POST["dodecahedronVolume"];
    $impactVelocityInput = $_POST["impactVelocity"];
} else {
    $truncateFloatInput = "";
    $farenheit2KelvinInput = "";
    $dodecahedronVolumeInput = "";
    $impactVelocityInput = "";
>>>>>>> upstream/master
}

$form_layout = <<< EOD
<p>
<<<<<<< HEAD
<form method = "post" action="">
<label name="truncateFloat">Floating Point Value</label><input type="text" name="truncateFloat"><br>
<label name="farenheit2Kelvin">Farenheit Value</label><input type="text" name="farenheit2Kelvin"><br>
<label name="dodecahedronVolume">Dodecahedron Side Value</label><input type="text" name="dodecahedronVolume"><br>
<label name="impactVelocity">Height of Fall Value</label><input type="text" name="impactVelocity"><br>
<input type="submit" value = "submit" name = "submit">
=======
<form method="post" action="">
<label name="truncateFloat">Floating Point Value</label><input type="text" name="truncateFloat"><br>
<label name="farenheit2Kelvin">Farenheit Value</label><input type="text" name="farenheit2Kelvin"><br>
<label name="dodecahedronVolume"></label>Dodecahedron Side Value<input type="text" name="dodecahedronVolume"><br>
<label name="impactVelocity">Height of Fall Value</label><input type="text" name="impactVelocity"><br>
<input type="submit" value="submit" name="submit">
>>>>>>> upstream/master
</form>
</p>
EOD;

<<<<<<< HEAD
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
=======
?>

<html>
<head>
<title>Simple PHP Form Example</title>
</head>
<body>
<?php
if (!isset($_POST['submit'])) {
    // display the form
    echo $form_layout;
} else {
    if (!empty($truncateFloatInput)) {
        echo "The truncated floating point value is:";
        truncateFloat($truncateFloatInput);
        echo "<br>";
    }
    if (!empty($farenheit2KelvinInput)) {
        echo "The Kelvin value is:";
        farenheit2Kelvin($farenheit2KelvinInput);
        echo "<br>";
    }
    if (!empty($dodecahedronVolumeInput)) {
        echo "The dodecahedron volume value is:";
        dodecahedronVolume($dodecahedronVolumeInput);
        echo "<br>";
    }
    if (!empty($impactVelocityInput)) {
        echo "The splat value is:";
        impactVelocity($impactVelocityInput);
        echo "<br>";
    }

}
?>
</body>
</html>
>>>>>>> upstream/master
