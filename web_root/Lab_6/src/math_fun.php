<?php

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

define('GRAVITY', 9.8);

function truncateFloat($float_value)
{
    echo (int) floatval($float_value * 100) / 100;
}

/**
 * @param $degrees_f
 */
function farenheit2Kelvin($degrees_f)
{
    echo ($degrees_f - 32) * 5 / 9 + 273.15;
}

/**
 * @param $area
 */
function dodecahedronVolume($area)
{
    echo pow($area, 3) / 4 * (15 + 7 * sqrt(5));
}

/**
 * @param $height
 */
function impactVelocity($height)
{
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
}

$form_layout = <<< EOD
<p>
<form method="post" action="">
<label name="truncateFloat">Floating Point Value</label><input type="text" name="truncateFloat"><br>
<label name="farenheit2Kelvin">Farenheit Value</label><input type="text" name="farenheit2Kelvin"><br>
<label name="dodecahedronVolume"></label>Dodecahedron Side Value<input type="text" name="dodecahedronVolume"><br>
<label name="impactVelocity">Height of Fall Value</label><input type="text" name="impactVelocity"><br>
<input type="submit" value="submit" name="submit">
</form>
</p>
EOD;

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