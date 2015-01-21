<?php

/**
 * Lab 2, Arithmatic Lab
 *
 * This lab focuses on your understanding of arithmatic.
 *
 * @version 1.0
 * @author Daniel_Bingham <dbb12200@vtc.edi>
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
	$truncate = (int) ($float_value*100)/100;
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

impactVelocity(32);
echo "<br>";
truncateFloat(3.1415);
echo "<br>";
farenheit2Kelvin(32);
echo "<br>";
dodecahedronVolume(1.2);