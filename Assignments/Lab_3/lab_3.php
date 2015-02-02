<?php

function tempWarning($temp_in_c)
{
    // Use an if else statement

    // Output the following text if the temp_in_c is above 32 degrees centigrade.

    echo "It's really hot out there, be careful!";

    // Alternately output if the temp_in_c is below 7 degrees centigrade

    echo "Brrrrr. Be sure to dress warmly.";
}

function quadraticEquation($a, $b, $c)
{
    // Use and if else statement

    $discrim = $b * $b - 4 * $a * $c;

    //if the discrim is less than zero echo the following

    echo "The equation has no real roots!";

    // if the discrim equals zero do the following

    $root = -$b / (2 * a);
    echo "There is a double root at " . $root;

    // if the discrim is greater than zero do the following

    $discRoot = sqrt($b * $b - 4 * $a * $c);
    $root1    = (-$b + $discRoot) / (2 * $a);
    $root2    = (-$b - $discRoot) / (2 * $a);
    echo "The solutions are: " . $root1 . "and " . $root2;

}

function consinantOrVowel($letter)
{
    // Use a switch statement here

    echo $letter . " is a vowel";

    echo $letter . " is a consonant";

    echo $letter . " is not a vowel or a consonant";

}

function oddOrEven($number)
{
    // Use the modulus and ternary operator to echo whether the number is odd or even

}

function countByThree()
{
    // Create a for loop that counts by threes to ninety-nine and outputs every increment from 3 up to and including ninety-nine

}

function indefiniteFactorialLoop($count)
{
    // write a loop that starts at 0 and calculates the factorial to to and including the value of count

    echo "The factorial is " . $factorial_product;

}

// Insert function calls below.
