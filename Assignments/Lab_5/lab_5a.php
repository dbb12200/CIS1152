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

$form_layout = <<< EOD
<p>
<form method="post" action="">
<label name="truncateFloat">Floating Point Value</label><input type="text" name="truncateFloat"><br>
<label name="farenheit2Kelvin">Farenheit Value</label><input type="text" name="farenheit2Kelvin"><br>
<label name="dodecahedronVolume">Dodecahedron Side Value</label><input type="text" name="dodecahedronVolume"><br>
<label name="impactVelocity">Height of Fall Value</label><input type="text" name="impactVelocity"><br>
<input type="submit" value="submit" name="submit">
</form>
</p>
EOD;

function truncateFloat($float_value)
{
    return (int) floatval($float_value * 100) / 100;
}

/**
 * @param $degrees_f
 */
function farenheit2Kelvin($degrees_f)
{
    return ($degrees_f - 32) * 5 / 9 + 273.15;
}

/**
 * @param $area
 */
function dodecahedronVolume($area)
{
    return pow($area, 3) / 4 * (15 + 7 * sqrt(5));
}

/**
 * @param $height
 */
function impactVelocity($height)
{
    return sqrt(2 * GRAVITY * $height);
}

if (isset($_POST['submit'])) {
    $truncateFloatResult = truncateFloat($_POST["truncateFloat"]);
    $farenheit2KelvinResult = isset($_POST["farenheit2Kelvin"]) ? farenheit2Kelvin($_POST["farenheit2Kelvin"]) : "";
    $dodecahedronVolumeResult = dodecahedronVolume($_POST["dodecahedronVolume"]);
    $impactVelocityResult = impactVelocity($_POST["impactVelocity"]);
} else {
    $truncateFloatResults = "";
    $farenheit2KelvinResults = "";
    $dodecahedronVolumeResults = "";
    $impactVelocityResults = "";
}

if (!isset($_POST['submit'])) {
    // display the form
    echo $form_layout;
} else {
    $form_results = $header;
    if (!empty($truncateFloatResult)) {
        $form_results .= "The truncated floating point value is: " . $truncateFloatResult . ".<br>";
    }
    if (!empty($farenheit2KelvinResult)) {
        $form_results .= "The Kelvin value is: " . $farenheit2KelvinResult . ".<br>";
    }
    if (!empty($dodecahedronVolumeResult)) {
        $form_results .= "The dodecahedron volume value is: " . $dodecahedronVolumeResult . ".<br>";
    }
    if (!empty($impactVelocityResult)) {
        $form_results .= "The splat value is: " . $impactVelocityResult . ".<br>";
    }
    $form_results .= $footer;

    echo $form_results;

}
