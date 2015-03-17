<?php
/**
 * Lab 6, Forms lab
 *
 * This lab focuses on your understanding of classes.
 *
 * @version 1.0
 * @author Daniel Bingham <DBingham@vtc.edu>
 * @since 20150315
 */
/**
 * Outputs to the console a truncated float.
 *
 * Takes in a floating point number and truncates in to two places of precision.
 * Then returns to the output to the console.
 *
 * @param $float_value
 */
namespace VTC\Lab_5\MathFun;
class MathFun
{
    const GRAVITY = 9.8;
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
        return sqrt(2 * self::GRAVITY * $height);
    }
}