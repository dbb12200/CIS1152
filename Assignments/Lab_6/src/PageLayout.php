<?php

/**
 * Lab 6, Static Classes
 *
 * This lab focuses on your understanding of PHP forms and classes.
 *
 * @version 1.0
 * @author Daniel Bingham <DBingham@vtc.edu>
 * @since 20150303
 */

/**
 * Outputs to the console a truncated float.
 *
 * Takes in a floating point number and truncates in to two places of precision.
 * Then returns to the output to the console.
 *
 * @param $float_value
 */
 
namespace VTC\Lab_5\PageLayout;

require_once "src/math_fun.php";
use VTC\Lab_5\MathFun as Mathfun;

class PageLayout
{	


    public static $header = "<html>\n\t<head>\n\t\t<title>PHP Form Example</title>\n\t</head>\n\t<body>";
    public static $footer = "\n\t</body>\n</html>";
    public static $form_layout = <<< EOD
<p>
<form method="post" action="">
    <label name="truncateFloat">Floating Point Value</label><input type="text" name="truncateFloat"><br>
	<label name="impactVelocity">Height of Fall Value</label><input type="text" name="impactVelocity"><br>
	<label name="dodecahedronVolume">Dodecahedron Side Value</label><input type="text" name="dodecahedronVolume"><br>
    <label name="farenheit2Kelvin">Farenheit Value</label><input type="text" name="farenheit2Kelvin"><br>
    <input type="submit" value="submit" name="submit">
</form>
</p>
EOD;

public static function displayResults() {
		if (!empty($_POST["truncateFloat"])) {
			echo "The truncated value is: " . Mathfun\Mathfun::truncateFloat($_POST["truncateFloat"]) . ".<br>";
		}
		if (!empty($_POST["impactVelocity"])) {
			echo "The splat value is: " . Mathfun\Mathfun::impactVelocity($_POST["impactVelocity"]) . ".<br>";
		}
		if (!empty($_POST["dodecahedronVolume"])) {
			echo "The volume of a dodecahedron is: " . Mathfun\Mathfun::dodecahedronVolume($_POST["dodecahedronVolume"]) . ".<br>";
		}
		if (!empty($_POST["farenheit2Kelvin"])) {
			echo "The Kelvin value is: " . Mathfun\Mathfun::farenheit2Kelvin($_POST["farenheit2Kelvin"]) . ".<br>";
		}
	}
}
