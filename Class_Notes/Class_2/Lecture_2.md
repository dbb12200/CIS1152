# Lecture 2A

<!--TOC-->

## Debugging
### Introduction to Debugging
Rear Admiral Dr. Grace Hopper, the inventor of COBOL, is credited with observing the ﬁrst computer bug—literally, a moth caught in a relay in an early computer system. When asked to explain why the machine wasn’t behaving as intended, a technician reported that there was “a bug in the system,” and dutifully taped it, wings and all, into the logbook.

![The first bug report!](http://upload.wikimedia.org/wikipedia/commons/8/8a/H96566k.jpg)

Regrettably, we still have “bugs” in the system, albeit not the ﬂying kind. Software defects manifest themselves in a variety of ways. Unfortunately, modern computer systems are still limited to doing what you tell them to do, not necessarily what you want them to do.

No one writes perfect software, so it’s a given that debugging will take up a major portion of your day. Let’s look at some of the issues involved in debugging and some strategies to debug our code.

### Bug Classification System Used in This Class
In the existing writing on programming, many articles attempt to classify bugs into types. In fact, there have been roughly as many classifications as articles. One notable feature of the bug classification literature is that everyone feels the need to devise his or her own system.

The categorizations in this class are based on ones devised by Donald Knuth, who is the author of the typesetting package known as TeX.

Knuth is an expert programmer who kept a detailed log of all the code changes he made during the development of TeX—both bugs and enhancements. He later wrote a paper called “The Errors of TeX” in which he grouped the changes into 15 categories, 9 for bugs and 6 for enhancements, each assigned a letter of the alphabet for reference. We'll ignore the enhancement categories and focus on the 9 bug categories, which are as follows:

- **Algorithm Anomalies**: The code correctly follows the intent of the programmer, but the intent was wrong.
- **Blunders:** As Knuth put it, “thinking the right thing, but writing it wrong.” The algorithm was correct, but the code did not implement it correctly.
- **Data Disasters:** Data was incorrectly modified in some way such that the result did not reflect the programmer's intent.
- **Forgetfulness:** A simple error of omission; leaving out some code so that the program did not do all that it was supposed to do.
- **Language Lossage:** Errors related to misunderstanding or not considering the specific features of the syntax, such as the precedence of operators.
- **Mismatches:** Calling a subroutine with incorrect parameters in a way that the compiler won't report an error.
- **Robustness:** Crashing on bad input data, reporting uninformative error messages, and the like.
- **Surprises:** Unforeseen interaction between different sections of the program.
- **Typographic Trivia:** Simple errors when typing in the program.

In this class, when dealing with code, we will use this common vocabulary to discuss the issues in your assignments. It is important to understand what type of issue you are having so that you can correct it.

### Debugging Mindset
Debugging can be a very touchy subject amongst programmers. The mere fact that bugs exist implies that the programmers are fallible. Many programmers find it hard to accept this truth and rail against it.

Programmers who have not accepted the truth of their own fallibility are convinced that almost all defects in software are always cause by some external force for which they have no control. This external force could be the end user, the system, the programming language, other programmers, or even (gasp) their programming instructor. Even if it is any or all of those things, a programmer will be much happier if they embrace the truth that bugs are job security. The more bugs you have to fix the longer you get to keep coding.

So let us move past all the finger pointing that bugs are likely to incite and move on to how we should really view bugs. Bugs are really problems to be solved. The best debugging mindset is to view the debugging this way; fix the problem not the blame.

### Debugging Techniques
The first thing to do when you have an error is to deduce what you think is causing the error. Embrace the fact that debugging is just problem solving, and attack it as such. Now, I am going to give you the best debugging tip any one ever will give you.

### Don’t Panic
It’s easy to get into a panic. There is always a deadline, or an impatient teacher, or a nervous boss, or client breathing down your neck. However, it is very important to take a step back, and actually think about what could be causing the symptoms that you believe are indicative of a bug.

If your ﬁrst reaction on witnessing a bug is “that’s impossible,” you are wrong. Then stop and push your brain’s reset button. There is a bug and you should focus your thoughts on finding it.

Beware of myopia when debugging. Resist the urge to ﬁx just the symptoms you see: it is more likely that the actual fault may be several steps removed from what you are observing, and may involve a number of other related things. Always try to discover the root cause of a problem, not just this particular appearance of it.

When trying to solve any problem, you need to gather all the relevant data. Unfortunately, bug reporting isn’t an exact science. It’s easy to be misled by coincidences, and you can’t afford to waste time debugging coincidences. You ﬁrst need to be accurate in your observations.

What is the PHP interpreter telling you? Do you see an error? Is it returning the wrong results? You know what your program is supposed to do. Now, it is time to see what the interpreter thinks it is doing.

### Start with Clean Code
Before you start to look at the bug, make sure that you are working on code that runs cleanly, without any errors. All syntactical mistakes (see typographical trivia above) should be taken care of before we move on to other types of errors.

If you are getting an interpreter error, it will contain a line number. Use that line number as a starting place. It is more likely than not that the line number is just where the interpreter is erroring out. It is not where the actual error in the code resides.

Look at the line of code that the interpreter has returned as the offending line. Really look at the line. Is there a discernable issue? If not walk yourself through the basic programming mistakes. Are you missing a semicolon? Do you have any unbalanced braces or parenthesis? Did you forget to close a multiline comment? Did you use the assignment operator instead of the equality operator?

If it is none of the above, look at the line above and below the interpreter returned line number. Are these lines syntactically correct? If so, continue to the lines two above and two below the issue and check those lines syntax. Is it correct? If so keep iterating a line in both directions until you find the syntactical issue. Eventually you will come upon the offending line.

### Tracing
Now that we have nice clean code, and you are still having an issue we can move on to tracing. Collect all the variables in the piece of code you suspect is malfunctioning and write them down. Next to the variable names write down the value you would expect to find in that variable. Now return to your code. Add the appropriate `print` or `print_r` statements to your code to display the variables as your program runs.

Do the variables return the values you expected? If not what are the variables returned? Can you figure out how the interpreter arrived at that value? Is the variable being calculated correctly? Is a loop looping too much or too little? Is a conditional statement not operating as expected? Is a method or function call returning what you think it should? These are all questions you should ask when trying to figure out where the error is occurring.

This type of error that results from algorithm anomalies, data disasters, and language lossage are sometimes called logic errors. Logic errors result in the misimplementation, misapplication, or misinterpretation of a specific algorithm or language feature. These types of errors are almost always the hardest to correct, because they require a correction in how the programmer understands the language or the code, and not just how the programmer has written the code such as wen correcting a syntax error.

### Rubber Ducking
A very simple but particularly useful technique for ﬁnding the cause of a problem is simply to explain it to someone else. The other person should look over your shoulder at the screen, and nod his or her head constantly (like a rubber duck bobbing up and down in a bathtub). They do not need to say a word; the simple act of explaining, step by step, what the code is supposed to do often causes the problem to leap off the screen and announce itself.

It sounds simple, but in explaining the problem to another person you must explicitly state things that you may take for granted when going through the code yourself. By having to verbalize some of these assumptions, you may suddenly gain new insight into the problem.

### Debugging Checklist

- Am I in the right state of mind to debug? If not, take a break. Come back when you are in a better headspace to deal with debugging.
- Am I working with error free code? If not, work to find the issue and correct that first. The code should always run error free before moving onto other forms of debugging.
- Are the variables returning the values I expect? If not, how is the code getting that value? The code should always return the values you expect.
- If I explained the code to a friend or classmate what would they say? The act of explaining the issue usually helps you overcome assumptions that you may have incorrectly made.

## PHP Basics
### Embedding PHP

PHP is an embedded language. What is an embedded language you ask? An embedded language is a coding language that is embedded in the data file, which it is acting upon. Unlike some embedded scripting languages (JavaScript for instance), PHP can also be run as a script external to the data it is acting on, and can in fact pull data from multiple sources. However, it is technically a part of the document it produces.

You invoke PHP by making a call to an HTTP server for a document that ends in a `.php` suffix. The server, seeing the suffix, assumes that there is PHP code embedded in that document that needs to be processed and passes it to a PHP parser for processing before returning the document to the requesting client. (If there is no PHP code, nothing happens, and the document gets sent on as is.) Thus, PHP can modify, overwrite, or even replace the document, depending on circumstance.

As a for instance, I could have a file called `myfile.php` that would be a script that evaluates what type of browser the client is using and uses that information to substitute a document appropriate to that browser for itself. This would allow me to have one address for the page, even though there may be many different pages to address issues of browser incompatibilities.
On of the most common uses of PHP is to generate dynamic content that is adaptive. It can change the content on a page to suit different browsers. Another common use is assembling data from diverse data sources into a single document for return to the user.

### The XML Processing Directive

![Simplified History of Markup Language](http://csharpcomputing.com/XMLTutorial/xmlevolution.jpg)

For those who aren't familiar with XML, here is the quick overview. SGML, or the Standard Generalized Markup Language, is the original markup language. SGML was created to overcome electronic publish challenges. However, it is very complex and quite strict. It is the forerunner of the family of markup languages that includes HTML and XML and which are used for marking up online content for display.

HTML was derived from SGML to function as a markup language specifically for Web documents. HTML was created to fill the need for a simple markup language to create a webpage. It overcame SGMLs complexity by removing a substantial amount of its flexibility. This simplicity was seen as a disadvantage and so a new language was needed. One that maintained a level of flexibility like SGML but with the ease of use of HTML

The compromise was a new Web language called XML. It was derived from SGML. XML is stricter than HTML but infinitely more flexible. The relationship between the two is close enough that an HTML document, for our purposes, can be treated as a poorly written XML document.

The way in which you normally embed PHP in a document is through what is commonly called a PHP statement, but is actually an XML directive. PHP is designed to be compatible with many standards and commonly used scripting approaches, making it easier to code. Here we are going to code to standards. After we look at the standards-defined method, we will look at the other methods.

An XML processing directive is a command embedded in an XML document for some application to process. All XML processing directives take the form of:

```xml
<? application_name information for application ?>
```

Notice that the statement opens and closes with nested brackets and question marks, and that the name of the application being referenced must come right after the first question mark, with no space before it. The information for the application can be a short statement, or, in the case of PHP, can go on for pages and pages.

The PHP statement normally uses this form of inclusion in HTML documents. It looks like this:

```php
<?php some php statements ?>
```

Line breaks are allowed within the XML processing directive, so the following is also legal.

```php
<?php
 some php statements
and some more statements ?>
```

Since PHP is processed by the server, it can literally go anywhere in an HMTL document in question. The code is processed before the web browser sees the code, so the web browser never sees the PHP. Since you can put it anywhere, PHP can be used to write content, or tag attributes, or even tags. Any of the following might be valid PHP / HTML code combinations.

```php
<p><?php echo "Hello World!"; ?></p>
<?php echo "<h2>" . $item1 . "</h2>"; ?>
<table width="<?php echo $twidth; ?>">
<img src="linkimag.gif" height="10" width="100"
<?php if (!$strict) { echo border='0'; } ?> \>
```

### Introduction To Output
#### Echo and Print
Perhaps the most common use of PHP is to generate content, and the most common means of doing so is the echo and print commands, which writes information back to the document to be sent to the client.

```php
<?php echo "Rasputin" ?>
//or
<?php print "Rasputin" ?>
```

Either command can be used. For our purposes from here on out, I will use echo. I use echo because I am lazy and it is one letter shorter. We will explore output in great depth later on in the course.

### PHP Syntax
PHP is a C-style language. This means that much of its syntax is similar to C. If you are familiar with most any C-style language (C, C++, Java, JavaScript) then PHP should look very familiar. It does, however, have a few little twists and turns you need to know about.

#### The Semi-colon
The first rule is that every statement must end in a semi-colon `;`. The semi-colon is the programmatic equivalent of the period at the end of the sentence. There is only one exception to this rule.  If a statement ends in a curly bracket, then there is no semi-colon after the curly bracket.

```php
<?php
  if ($sometest) {
    echo "it seems that the";  // required
    echo " test is positive";  // required
  }// forbidden
  else {
    echo "it seems that the";  // required
    echo " test is negative";  // required
  }// forbidden
  echo " -- so now you know";  // required
  ?>
```

#### Case Sensitivity
In PHP, only user-defined variables are case sensitive. If you assume everything is case sensitive it makes life easier though. Convention is that predefined function and method names are written in lower case while predefined variable names are written in upper case. User defined variable names are traditionally written in lower case or C-style camelCase (multiWordVar) to differentiate them from the system variables.

#### Whitespace
White space is normally ignored in PHP. This means you can space the code out and put line breaks in as you see fit to make the code more readable.

White space can affect coding in certain circumstances. Normally, it should be a common sense issue in determining where white space is important. For instance, the following code snippet will yield an output of 2.5 -- 25 because the period is the string concatenation operator, but if it is between two numbers with no intervening space, it is a decimal point, just as you would expect it to be.

```php
<?php
  $xyz = 2.5;
  $abc = 2 . 5;
  echo $xyz;
  echo " -- ";
  echo $abc;
?>
```

### Comments
Comments are an important part of coding. They allow you to be able to quickly tell where parts of the program start and end when you are skimming through the code. They also explain how obscure bits of the code work. This not only helps people who have to read your code, but also helps you. Code you wrote a while ago can become very cryptic when you have to go back to modify it.

Coming out of multiple traditions, PHP allows multiple ways to put comments within its code.

#### Shell Style Comments
PHP allows Unix shell comments, which are preceded by a hash mark `#`. Shell comments are single line comments. Everything after it on that line is ignored.

```php
# a shell style comment

###############################################
# they are useful for marking off sections
# since hash marks stand out well in the code ###############################################

echo $this; # they can also occur after code
```

#### C Style Comments

##### Single Line Comments
Single line C-style comments are single line comments indicated by a double slash `//`.  Anything after the double slash is ignored.

```php
// a C-style comment

//========================================
// they don't stand out as well as hash
// marks but are more familiar to many
// people
//========================================

echo $this; // they also can occur after code
```

##### Multi-Line Comments
Multi-line C-style comments are comments meant to mark of large multi-line sections of the document. The begin and with a nested slash asterisk combination `/* */`. You should be careful using them to comment out things, since they cannot be nested.

```php
/* a C-style multi-line comment */

/* ****************************************
they are usually used to delimit large blocks **************************************** */

echo $this; /* they also can occur after code */

/* this on the other hand
/* is a mistake */
because this line isn't commented out */
```

## Variables

### Literals
We will look at some aspects of literals in more detail under data types, but here is a quick overview.  A literal is a data value that appears as itself in a program.  A literal is an expression that directly represents itself in the code. For instance, the number 2 is a numeric literal, appearing as a number in the code and representing the value of the number two.

Literals come in three flavors. These are:

- numeric literals
- string literals
- keyword literals

#### Numeric Literals
Numeric literals are numbers that appear as themselves. They may be integers or floating-point numbers. Floating point numbers may be represented with a decimal point. They may also be represented in base-10 scientific notation as [number]E[exponent], for instance, 1.75E-2.

Integers may be represented as decimal numbers or as octal (base-8) or hexadecimal (base-16) numbers.  A numeric literal integer beginning with zero is treated as an octal number.  A numeric literal integer preceded by a zero and an "x" (0x) is treated as a hexadecimal number. This means that integer numeric literals should not have leading zeros unless you want to signify a different type of enumeration that the base-10 that most people are used to.
All of the following are valid numeric literals:

- 0  -> integer
- 123 -> integer
- 1.23 -> floating point
- 0.123 -> floating point
- 1.23E5 -> scientific notation floating point
- 1.23E-7 -> scientific notation floating point
- 0123 -> octal
- 0x123 -> hexadecimal

#### String Literals
String literals are any value that appears in the code inside quotes. A string literal can be any valid character, including numbers. What makes it a string is its use in the code within single or double quote marks.

String literals can either have single or double quotes.  However, unlike some programming languages, which one you use makes a difference on PHP. Double-quoted string literals are parsed string literals while single-quoted string literals are not parsed. What this means is that single-quoted string literals are always represented exactly as entered (except for two special characters we will discuss later), while double-quoted strings can contain non-literal data to be processed at the time the program is run. In other words, PHP provides you with a way to embed variables in string literals.

#### Keyword Literals
A keyword is a word reserved by the language for its own use.  A keyword literal is a reserved word in the language that serves as representative of a single literal value. Examples of keyword literals are:

- true -> Equates to true in a conditional situation.
- false -> Equates to false in a conditional situation.
- null -> Is the value assigned to a variable that has no value. It is the value of no value.

### PHP Data Types
A data type is a general term to describe categories of values that a program or programming language can use.  A data type refers to the type of data a variable can store. PHP has eight (8) different data types you can work with.

These are…

- integer numbers
- floating point numbers
- strings
- booleans
- arrays
- objects
- resources
- null

PHP is a loosely typed language, so a variable does not need to be of a specific type and can freely move between types as demanded by the code it is being used in. But you still need to know your data types.

#### Resources And Null – The Special Cases
Resources are not an actual data type, but the storing of a reference to functions and resources external to PHP. The most common example of using the resource data type is a database call. We will not talk about them here, since they are an advanced topic.
Null is a special data type, which can have only one value, which is itself.  Which is to say, null is not only a data type, but also a keyword literal. A variable of data type null is a variable that has no value assigned to it. When a variable is created without a value, it is automatically assigned a value of null. This is so that whatever garbage was in that memory location before is cleared out. Otherwise the program may try to process it.

So why is there garbage in memory in the first place?  When computers assign a variable a value, they assign the variable a location in memory.  Then the computer stores the value in that location. The variable is really a reference to that location in memory, containing the memory address and what type of information the computer should expect to find there. It does not actually store the value, just a reference to its location. When the computer is done with the variable or is told to delete it, it does not delete the value in memory, but the reference to its location. This is far more efficient that deleting the actual values, but it means that whatever garbage was left in that location in memory is still there. This is also why you have to wrestle with pointers in programming courses, as they are how computers really work with variables and values.

Of the other two data types, we can lump everything into two categories. The first category is scalar, or primitive, data types. They are data types that can only hold a single value. These are integers, floating-point numbers, strings, and booleans. The second category is the compound data types, data types that store a collection of values. These are objects and arrays.

#### Integers
An integer is a whole number, a number with no fractional component. For those who are familiar with C, a PHP integer is the same as the long data type in C. It is a number between -2,147,483,648 and +2,147,483,647.

Integers can be written in decimal, octal, or hexadecimal. Decimal numbers are a string of digits with no leading zeros. Any integer may begin with a plus sign `+` or a minus sign `-` to indicate whether it is a positive or negative number. If there is no sign, then positive is assumed.

The decimal number system is a base ten numbering system.  This is the number system with which you are likely most familiar.  It is the number system that the human race instinctively gravitated toward.  If you are wondering why, count your fingers or your toes.

Valid decimal integers…

- 1 123 +7
- -1007395

An octal number is a base-8 number. Each digit can have a value between zero (0) and seven (7). Octal numbers are commonly used in computing because a three digit binary number can be represented as a one digit octal number. Octal numbers are preceded by a leading zero (e.g., 0123).

Valid octal integers…

- 01
- 0123
- +07
- -01007345

A hexadecimal number is a base-16 number. Each digit can have a value between zero (0) and F. Since we only have ten numbers in our numbering system (0-9), we use the letters A through F to make up the difference for hexadecimal values. Hexadecimal values are common in computing because each digit represents 4 binary numbers, which is four bits. Eight bits, or a two digit hexadecimal number, is one byte. Hexadecimal numbers are preceded by a leading zero and X (e.g., 0x123).

Valid hexadecimal integers…

- 0x1
- 0xff
- 0x1a3
- +0x7
- -0x1ab7345

So what about zero, you may ask. If anything beginning with a zero is octal then isn't zero octal? And how do we represent a decimal zero then? The answer is simple. It makes no difference. If you have zero of something, it doesn't matter how you count it, it is still zero.

If you want to find out whether a variable stores an integer you can use the `is_int()` to test whether something is an integer. If it is, then the function returns the value of true.

#### Floating Point Numbers
Floating-point numbers are also sometimes called real numbers. They are numbers that have a fractional component. Unlike basic math, all fractions are represented as decimal numbers. If you are familiar with C, PHP floating-point numbers are equivalent to the double data type. Floating-point numbers get their name from their decimal point. When using scientific notation to represent the number, the point floats in relation to the exponent being applied to the numeric component of the notation.

PHP recognizes two types of floating point numbers. The first is a simple numeric literal with a decimal point. The second is a floating-point number written in scientific notation. Scientific notation takes the form of [number]E[exponent], for example, 1.75E-2.

Some examples of valid floating-point numbers include…

- 3.14 0.001
- -1.234
- 0.314E2
- 1.234E-5
- -3.45E-3

If you want to know if a variable contains a floating-point number, you can use the `is_float()` function to test the value. If it is a floating point number, the function will return true.

#### Strings
A string is a text literal of an arbitrary length. Most of working with Web pages is about working with strings.  Being enclosed in quotes, either double or single quotes, indicates a string.

Unlike some programming languages, PHP differentiates between single and double quotes. Strings inside double quotes are parsed, or interpolated, while strings inside single quotes aren't. What this means is that if you include variables or special characters in double-quoted strings, those values are processed and become part of the string. Putting variable names and special characters in single-quoted strings causes the variable names and special character escape sequences to be written out exactly as you typed them. In other words, they are literals. This means that you can embed variables directly inside strings in PHP when using double quotes, but not when using single quotes. This make concatenating strings a little easier.

Thus we have the following situation…

```php
$myVar = "xyz";       // assign a value to $myVar
echo $myVar;          // writes 'xyz'
echo "abc to $myVar"; // writes 'abc to xyz'
echo 'abc to $myVar': // writes 'abc to $myVar'
```

This does make it easy to write PHP code out inside a string, as well as to process PHP code within a string.

##### Special Characters
Anything within quotes is part of a string, even numbers. Thus, "123" is a string, not a number. But there are special characters, which cannot be included directly in a quote. For instance, you can't have double quotes inside a double-quoted string, and you can't have single quotes inside a singe-quoted string. To include these special characters, you need to escape them so that the parser knows that they are literal characters and not string delimiters.

In PHP, you escape a character by preceding it with a backslash. There are two types of escaped characters in PHP. There are those that are a special character in the language and need to be escaped to get the parser to treat them as a literal. For instance, `\"` says that the quote after the backslash is a literal quote, and `\\` is used to include a literal backslash in a string. There are also those that are normal characters that serve as special characters when they are escaped. For instance, \n inserts a line break in the string at that location, and `\r` inserts a carriage return. Yes, they are the same thing for us, but they are different characters as far as the computer is concerned.

Line ending can be tricky.  Windows ends its lines with `\r\n`, Unix, Linux, and Mac OS X ends their lines with \n, and the Mac OS up to version 9 ends its lines with `\r`. This is why you can get garbage at the end of your lines when looking at your code in editors on a platform other than the one you wrote it in. Most code editors are smart enough to let you specify which format to save documents in.

Special characters can either be a single character preceded by a backslash or a numeric value in either octal or hexadecimal preceded by a backslash.

Some of the more common escape characters are…

- `\"` -> embeds a literal double quote in a string
- `\'`  -> embeds a literal single quote or apostrophe in a string
- `\\`  -> embeds a literal backslash in a string
- `\$` -> embeds a literal dollar sign in a string
- `\{` -> embeds a literal left brace in a string
- `\}` -> embeds a literal right brace in a string
- `\[` -> embeds a literal left bracket in a string
- `\]` -> embeds a literal right bracket in a string
- `\n` -> embeds a new line character in a string
- `\r` -> embeds a carriage return character in a string
- `\0` through `\777` -> represents and embeds any valid ASCII character value in octal format
- `\x0` through `\xff` -> represents and embeds any valid ASCII character value in hexadecimal format
- `\x0` through `\xffff` -> represents and embeds any valid Unicode character value in hexadecimal format

Strings in single quotes are not technically parsed, but you can use `\'` and `\\` to escape single quotes and backslashes in unparsed strings. No other escaped characters will work in single-quoted string literals. They will be treated as literal text.

One important thing you shouldn't have in a string is the sub-string `?>`, which ends that PHP script, even if it does occur inside a string. In fact, even `?\>` is a bad idea. It is recommended that you use the numeric value for the question mark and write it `\x3f>`. `3f` is the hex value for `?`.

You can use the `is_string()` function to test whether something is a string. If it is a string, it will return true.

PHP includes many string related functions, since much of what it does is string processing. These are discussed elsewhere.

#### Booleans
A boolean value assesses the truth value of something.  Booleans only have two values, true and false.  These two values are represented by the keyword literals of the same name. All conditionals return a true/false boolean value based on the condition being tested.
If a conditional is converted to a different data type, then true equates to one (1) and false equates to zero (0). The conversion in the other directions is a little more complex. If testing for the truth value of a non-boolean value, any of the following values will equate to false.

- The keyword literal false.
- The integer 0.
- The floating-point number 0.0.
- The empty string (""). Note, that is not a space, but a string with nothing in it.
- The string "0" (zero).
- An object with no values or methods.
- The null value.
- All other values are true, including all resource values.

#### Arrays
We will spend a lot more with arrays in a future chapter. This is just to make you aware that they exist.

An array is a variable that holds a group of values. Arrays are usually meant to store a collection of related data elements, although this is not a necessity. You access the individual elements by referring to their index position within the array. The position is either specified numerically or by name.

An array with a numeric index is commonly called an indexed array while one that has named positions is called an associative array. In PHP, all arrays are associative, but you can still use a numeric index to access them. Indexed arrays start at position zero, not at position one, so your first array element has an index of 0, and the highest position in the array is one less than the number of elements in the array.

Referencing array elements is done with the following notation…

```php
$arrayName[index];
```

You assign a value to an array position by specifying which array element you want to assign a value to:

```php
$listing[0] = "first item";
$listing[1] = "second item";
$listing[2] = "third item";
```

An individual array element can be of any type, including another array.  If you want to find out if a variable contains an array you can use the is_array() function.  We deal extensively with arrays in their own section. If you haven't gotten to it yet, beware of the fact that there are some counterintuitive elements in how PHP deals with arrays.

#### Objects
We will spend a lot more with objects in a future chapter. This is just to make you aware that they exist.

PHP is capable of functioning as an object-oriented programming language (or OOP). As such, it must be able to handle objects. An object is a data type that allows for the storage of not only data but also information on how to process that data. The data elements stored within an object are referred to as its properties, also sometimes called the attributes of the object. The code describing how to process the data is called the methods of the object.

Objects have two components to their construction. First, you must declare a class of object. It defines the structure of the object to be constructed. Then you instantiate the object, which means you declare a variable to be of a certain class and assign values to it appropriately.
Another way of looking at objects is that they allow you to create your own data types. You define the data type in the object class, and then you use the data type in instances of that class.  Yes, there is also an is_object() function to test whether a variable is on object instance.  Objects have their own section in these notes.

## Expressions
An expression is a piece of code that can be evaluated to produce a value.  The basic building block of a program is the statement. A statement is a piece of code that does something.  Statements themselves are made up of expressions and operators. An expression is a piece of code that evaluates to some value.

The simplest form of expression is a literal or a variable. A literal evaluates to itself. A variable evaluates to the value assigned to it.  For instance, any of the following are valid expressions…

- "abc"
- 123
- $a
- $x == 7
- ($a + $b) / $c

Although a literal or variable may be a valid expression, they are not expressions that do anything. The way you get expressions to do things is by linking simple expressions together with operators.
An operator combines simple expressions together into more complex expressions by creating relationships between the simple expressions that can be evaluated. For instance, if the relation you want to establish is the cumulative joining of two numeric values together, you could write `6 + 7`.

The numbers 6 and 7 are each valid expressions. The equation `6 + 7` is also a valid expression, whose value, in this case, happens to be 13.
The plus sign `+` is an operator. The numbers to either side of it are said to be its arguments, or operands. An argument or operand is something that an operator takes action on. Different operators have different types and numbers of operands. (You will also find that some operands are overloaded. This means that they will do different things in different contexts.)

Two or more expressions connected by operators are called an expression. You use operators to make complex expressions. The more sub-expressions and operators, the longer and more complex the expression, but as long as it is something that equates to a value, it is still and expression.

When expressions and operators are assembled in such a way as to produce to a piece of code that actually does something, you have a statement. Statements end in semi-colons and are the programming equivalent of the complete sentence.

For instance, `$a + $b` is an expression. It equates to something, the sum of the values of `$a` and `$b`, but it doesn't do anything. `$c = $a + $b;` is, on the other hand, a statement, because it does something. It assigns the sum of the values of `$a` and `$b` to `$c`.
Since there isn't really much to understand about expressions except for the assembly of them into compound expressions and statements using operators, we are going to look at the operators used to turn expressions into more complex expressions and statements.

### Operators
PHP has many operators and many types of operators. They can be categorized as…

- arithmetic operators
- string operators
- assignment operators
- increment and decrement operators
- casting operators
- relational operators
- logical operators
- bitwise operators
- a few others that don't really fit into any category

Except for bitwise operators, we are going to look at all of these in more detail. Bitwise operators allow you to manipulate integer values at the binary level. This is not something you will need for anything but the most advanced PHP programs. Bitwise operations also require a strong grounding in computer logic at the level of logic gates, registers and memory addressing. We are going to stick with things you can make use of almost immediately.

When working with operators, you must be careful about paying attention to four aspects of the operator…

- number of operands
- type of operands
- order of precedence
- operator associativity

### Number of Operands
Different operators take different numbers of operands. Most operators are binary operators, which means they are used to combine two expressions into a single, more complex expression. We are most familiar with binary operators since most mathematical operators are binary operators, for instance `$a + $b` or `$c / $d`.

Some operators are unary operators. This means that they only take one operand. For instance, the negation operator `-` turns a numeric value into its negative value `-7`. PHP also has increment and decrement as in C and C++ operators, which are unary operators.

There is one ternary operator in PHP, which is a shorthand form of the conditional statement. We will discuss it when we talk about conditional expressions.

### Types of Operands
When working with operators, you should pay attention to the type of operand an operator is meant to work on. Certain types of operators expect their operands to be of certain data types. Unlike some programming languages, PHP will try to convert the operands associated with an operator to the type of operand the operator is expecting. For instance, mathematical operators only work on numbers. Even though PHP will try to convert non-numeric values to numeric values for you, it still can't multiply two strings together if they are not numbers. `"abc" * "def"` is not a valid expression.

This process of converting from one type to another is known as casting. PHP will try to take care of casting for you. This process is known as implicit casting. Different operators have different rules for how they cast their operands. You can also explicitly cast operands. This is discussed a little later.

Some operators are overloaded. An overloaded operator does different things in different contexts. For instance, the period `.` is a concatenation operator for strings, but is also the decimal point for floating point numbers and the separator between object names and property names.

Some binary operators only accept certain values as their left hand operator. This is true of most of the assignment operators, which assign the value that is the result of the expression on the right to the expression on the left. This means that the expression on the left has to be something you can assign a value to.

The left-hand expression in assignment operations is known as an L-value. An L-value is, simply, an expression that occurs on the left hand side of an assignment operator. An L-value expression must be an expression that can legitimately have a value assigned to it. The only valid L-values in PHP are variables, properties of objects, and elements of arrays.

```php
// A legal PHP expression
$a = $b + $c;

// An illegal PHP expression
// You cannot use the assignment operator to
// assign a value to a complex expression
$a + $b = $c;

// A pointlessly complex, but legal expression
// The parentheses create a specific order of
// precedence, which is our next topic
$a = $b + ($c = $d / ($e = $f * $g));
```

### Order Of Precedence
The order of precedence is the order in which operators are acted upon.  Operators have an order or precedence, or an order in which they are processed in an expression. For instance, multiplication and division take precedence over addition and subtraction and everything else being equal will be processed first.

Operators that have the same precedence are processed in the order in which they appear in the expression. For instance, addition and subtraction have the same order of precedence, and so are processed in the order in which they appear.
Most operators that have the same precedence as one or another either normally only occur once in an expression or can be processed in any order in relation to each other. With addition and subtraction, if you start with 10 it does not matter whether you add 5 and subtract 3, or subtract 3 and add 5, the result is still 12.

You can use parentheses within an expression to clarify or override the default order of precedence.  Using parentheses to mark of the order the expression would be processed in anyway makes the code easier to read. It doesn't change the order of processing, but it does clarify it.
Overriding the order of precedence means you want the operators to be processed in an order different from the default order.  Operators with the same precedence can occur in any order without affecting the result.

```php
// $a == 12
$a = 10 + 5 - 3;

// $b == 12
10 - 3 + 5;

//$c == 4
$c = 10 * 2 / 5;

//$d ==4
$d = 10 / 5 * 2;
```

Operators with different orders of precedence must occur in a specific order or the results will be different.

```php
// default order $a = 20
$a = 10 + 5 * 2;

// same, with order specified $b = 20
$b = 10 + (5 * 2);

// order changed $c = 30
$c = (10 + 5) * 2;
```

For basic math, the operators with the highest order of precedence are multiplication and division, and the lowest is the assignment operator. The reality of programming is a bit more complex.

Here is a partial list of all operators in PHP by order of precedence. The list is in descending order, from highest to lowest. Operators in the same grouping have the same level of precedence. (The Associativity column lists those that are right to left, instead of left to right. See the next section for an explanation of this.)

The grouping numbers are entirely arbitrary and are just meant to make the table easier to read in print form.   You can find this table on the web here…

**Operator Precedence**

| Associativity | Operators |
|---------------|-----------|
| non-associative | `clone` `new` |
| left | `[` |
| right | `**` |
| right | `++` `--` `~` `(int)` `(float)` `(string)` `(array)` `(object)` `(bool)` `@` |
| non-associative | `instanceof` |
| right | `!` |
| left | `*` `/` `%` |
| left | `+` `-` `.` |
| left | `<<` `>>` |
| non-associative | `<` `<=` `>` `>=` |
| non-associative | `==` `!=` `===` `!==` `<>` |
| left | `&` |
| left | `^` |
| left | `|` |
| left | `&&` |
| left | `||` |
| left | `? :` |
| right | `=` `+=` `-=` `*=` `**=` `/=` `.=` `%=` `&=` `|=` `^=` `<<=` `>>=` `=>` |
| left | `and` |
| left | `xor` |
| left | `or` |
| left | `,` |

### Associativity
All operators have associativity. Associativity is the direction in which the operator is processed.  Most operators have left to right associativity, which is to say that they are processed from left to right. In the expression $a + $b - $c;, $a and $b are added together and then $c is subtracted from the result.
Some operators have right to left associativity. The most common of these is the assignment operator. For instance, in the expression $a = $b = $c;, the value of $b is set to the value of $c, then the value of $a is set to the value of $b. Looking at the code, you would expect all three values to be equal, and this is what the expression does. If left to right associativity were used for assignment, this would not be the case.
ARITHMETIC OPERATORS
Arithmetic operators fall into two categories, those that modify the value of an expression or set of expressions and those that take the value of one expression and assign it to another expression. These latter operators are also called assignment operators.
The following arithmetic operators are the basic math operators. They do not alter the values of their operands, and therefore need to have their result assigned to some variable in order to have any real effect.

- Addition `+` -> The addition operator adds two numeric operands or concatenates two string operands. Values need to be convertible to a number to work with the addition operator.
- Subtraction `-` -> The subtraction operator subtracts the value of the second operand (the one after the minus sign) from the value of the first operand (the one before the minus sign). It only works on numbers.
- Multiplication `*` -> The multiplication operator multiplies the numeric values of two operands together.
- Division `/` -> The division operator divides its first operand by its second operand. Division of integers that do not divide evenly will yield a floating-point result. Division by zero yields Infinity or -Infinity. The expression 0/0 evaluates to Nan.
- Modulo `%` -> The modulo operator divides its first operand by its second and returns the modulus. The modulus in division is the remainder, or what is left over.
- Unary Minus `-` -> The unary minus is a unary operator that negates the operand immediately following it, which is to say, converts it to its negative equivalent.
- Unary Plus `+` -> This operand does nothing, but exists to balance the unary minus.

The following arithmetic operators are unary operators that modify the value of their single operand.

- Increment `++` -> The increment operator increments the numeric value of its operand by one. If placed before the operand, it returns the incremented value. If placed after the operand, it returns the original value and then increments the operand.
- Decrement `--` -> The decrement operator decrements the numeric value of its operand by one. In other words, it counts backwards. If placed before the operand, it returns the decremented value. If placed after the operand, it returns the original value and then decrements the operand.

Unlike some languages, PHP allows you to increment certain strings as well as integers. Thus, the following code is legal.

```php
$i = 'a';
$i++;
```

The incrementing and decrementing works with strings and numbers is as follows…

- All numbers are either incremented or decremented by one each time the statement is invoked. Once a digit reaches a value of nine, it rolls back over to zero and the one is carried left to the next position. If it is decremented to zero, it rolls over to nine and one is subtracted from the position to the left.
- All letters in the range of A through Z, either upper or lower case, are incremented or decremented by one each time the statement is invoked. Thus 'A'++ would become 'B', and so forth. When a given character reaches a value of 'Z' it is rolled back over to 'A' and the one is carried left to the next position. If it is decremented to 'A', it rolls over to 'Z' and one is subtracted from the position to the left.
- This even works for mixed strings.

Increment and decrement examples…

```php
// result '4'
'5'--

// result 'F'
'E'++

// result 'xza'
'xyz'++

// result 'xZa'
'xYz'++

// result 'M0'
'L9'++

// result '11z'
'12a'--
```

The rest of the arithmetic operators are assignment operators. They assign the value of the operand on the right to the operand on the left. There are two types of assignment operators. The first is the simple assignment operator. It is represented by the single equals sign `=`. It is the assignment operator we are most familiar with.

The value to the left of the assignment operator must be an L-value, which is an expression that can have a value assigned to it.

```php
$a = $b + c$;
$validCheck = ($testVar == $myCond);
```

PHP also allows another type of operator that perform with is called assignment with operation. What this means is that they include both a math operator and an assignment operator in one operation. What is the purpose of such an operator? Well, many expressions you will end up writing may take the form of $a = $a + $b;, or the value of the first operand equals the value of the first operand as modified by a second operand. PHP allows a shorthand notation for these. $`a = $a + $b;` is equivalent to `$a += $b`. The same shortcut can be applied to subtraction, multiplication, division and modulus.

- `$a += $b;` is the same as `$a = $a + $b;`
- `$a -= $b;` is the same as `$a = $a - $b;`
- `$a *= $b;` is the same as `$a = $a * $b;`
- `$a /= $b;` is the same as `$a = $a / $b;`
- `$a %= $b;` is the same as `$a = $a % $b;`

Note that in each of these, the two characters form a single operator, and cannot have a space between them.

### Relational Operators
Relational operators allow you to test the relationship between two operands. They can test for equality between operands. They can compare operands to determine the relationship between them. There are even relational operators that test whether one operand is a property of another or of a given class of object.

The first relational operator you should know about is the equality operator.  The equality operator is represented by the double equals sign `==` It is used to assess whether two operands have the same value. If they do, then it returns a value of true. Otherwise it returns a value of false.

The equality operator will do data type conversion if necessary.  All of the following statements equate to true…

```php
'1' == '1'
'1' ==  1
'1' == true
// true equals one when converted to a number
```

Note that objects and arrays are compared by reference. Two objects are only equal if they are both references to the same object. If you want to test the properties of two different objects for equality, then you have to test the properties themselves, not the object.
Different arrays are never equal, even if they contain the same information. If you want to test the elements of the arrays for equality, you have to test the individual elements.

There is also an identity operator, represented by a triple equals sign `===`, which only equates to true when both operands have the same value and are of the same type.

```php
'1' === '1'   // true
'1' ===  1    // false
'1' === true  // false
```

Equality operators also have their opposites.  The inequality operator `!=` returns true where equality would return false. The non-identity operator ( !== ) returns true where identity would return false.

```php
'1' !== '1'   // false
'1' !==  1    // true
'1' != '2'    // true
'1' != '1'    // false
```

The next types of relational operators are the comparison operators. Comparison operators test the relationship, or relative order, of two values. These are:

- less than `<`
- greater than `>`
- less than or equal to `<=`
- greater than or equal to `>=`

### String Operators
There is really only one specific string operator, although the string object has many methods you can access.
The only string operator is the concatenation operator. It is represented by the period `.`. The concatenation is a special case of operator. It is an overloaded operator, since it serves more than once function depending on context. It concatenates strings, but it also serves as a decimal point and a separator for object property relationships.

When working with strings, the comparison operators test on a character-by-character basis, so two strings that are the same except for some trailing spaces, or a difference in capitalization, will be treated as different strings. This means that comparisons can get confusing. This is especially true of strings that contain numeric values.

```php
// compare two numeric strings compared as number to number
'11' < '3'       // false

// compare a numeric string and a number compared as number to number
'11' < 3        // false

// compare a non-numeric string to a number compared as a number
// 0 (or no number) is less than 3
'eleven' < 3    // true

// compare a non-numeric strings compared as a string
'eleven' < 'three'    // true

// compare a numeric string to a non-numeric string
// compare as a string ACSCII 'e' is greater than ASCII '3'
'eleven' < '3'  // false
```

### Logical Operators
There are four logical operators. Logical operators work with boolean values. The double characters for AND and OR are important, otherwise the operators mean something else.

- Logical AND `&&` or `and` -> The logical AND (double ampersands) compares two boolean operands and equates to true if they are both true.
- logical OR `||` or `or` -> The logical OR (double vertical bars) compares two boolean operands and equates to true if either one is true.
- logical XOR `xor` -> The logical XOR compares two boolean operands and equates to true if one and only one is true. The logical XOR does not have a symbolic construct in PHP, however, it can be simulated with `(a || b) && (!(a && b))`
- logical NOT `!` -> The logical NOT (exclamation point) negates the value of boolean operand, which is to say it returns true if the operand has a value of false.

Note that `and`, `xor`, and `or` have a significantly different position in order of precedence than `&&` and `||` do. Logical operators, without parentheses, will be processed in the following order…

- !
- &&
- ||
- and
- xor
- or

The fact that an `and` operator and an `or` operator occur twice at different points in the order of precedence can be useful in complex statements that include conditionals.

Since the expressions are evaluated in order, you can speed processing time of your scripts by coding the operand most likely to be the deciding factor first. For logical AND, if either one is false, than it returns false. Therefore, the operand most likely to be false should come first. For logical `or`, if either is true, it returns true, so it makes sense to put the operand most likely to be true first.

Note that when this happens, the second operand never gets evaluated. This is known as “short-circuit evaluation”.  This means you should not have any value changes in the second that may affect other parts of the code, since the expressions in the second operand may not get executed.

### Casting Operators
Although PHP handles implicit casting, there are times when you may want to determine the data type of a given variable or even specify the type you want to cast a variable to. PHP has two functions and some operators to help you with this.

### `gettype()` and `settype()`
`gettype()` and `settype()` allow you to determine the data type of a variable and set the data type of a variable, respectively.
`gettype()` returns a string that represents the name of that data type. In order to access that value, you either need to assign it to something or echo the result of the function.

```php
$result = gettype($mysterymeat);
echo gettype($whoknows);
```

`settype()` takes two arguments. The first is the variable to be cast. The second is a string representing the name of the data type to be cast to. The data type names are the same as the names of the casting operators below. So to cast something to an integer, you could use the string "integer" or "int". The `settype()` function changes the type of the variable it is passed, it does not return a new value of that type.

```php
settype($myNum, "string");
settype($myStr, "float");
```

The casting operators also allow you to cast variables to new types. Unlike the settype function, they return a value that is the value of the variable cast in the new type. The operator is used with the assignment operator as follows:

```php
$result = (operator) $original;
$res = (integer) $myStr;
```

The casting operators are…

- `(int)` or `(integer)` to cast to an integer
- `(float)` or `(real)` to cast to a floating-point number
- `(string)` to cast to a string
- `(bool)` or `(boolean)` to cast to a boolean
- `(array)` to cast to an array
- `(object)` to cast to an object

Be aware of the fact that casting will may change the value of the variable as well as its type. For instance, casting a floating-point number to an integer will truncate any fractional part.

```php
$a = (int) 4.1715   // $a == 4
$b = (int) "123abc" // $b == 123
```

Some casts may also not produce any meaningful results. For instance, casting an array to a string yields a string whose value is "array". However, you can switch back and forth between arrays and objects freely with the index values becoming the properties. If properties of the array cannot be cast to object properties, PHP will even keep those values so that they will be restored when the variable is cast back to an array. This most commonly occurs because it is possible to have index names that are not valid property names.

### A Few More Operators
There are just three more operators worth mentioning right now.

The ampersand `&` before a variable `&$abc` overrides pass by value to specify that you want to pass the variable by reference instead. The ampersand is an overloaded operator and character in PHP, so use carefully.

The at sign `@` before an operator or function call tells PHP to not report any errors from it should any errors arise.

The backtick, or grave accent `` ` `` , can be used to define a string as a command to be passed to the server. The string is executed as a command and its results are returned.

```php
$dirListing = `ls -l`;
```

## Advanced Output
One of the most commonly used features of PHP is to write content out for display over the Web. It can take data from most any data source and with proper coding format it for display in a Web browser.

PHP is designed to run on the server, behind the scenes. Not only should it not display in the Web browser window, but if someone views the source code for a PHP generated document that is currently displayed in their Web browser, the code should not be visible there either. Unless there is an error and the subsequent generation of an error message, a user should never see the PHP code. The PHP code is stripped from the document before it is sent to the user.

The way PHP works in a Web document is by treating the document it is embedded in as an output file. It inserts it output at the location in the code where the script is place. In other words, the output from the script replaces the script before the document is sent on to the user.

We have already encountered one way to do this sort of dynamic document generation with PHP using the `echo` statement. It echoes the content back to the current document. But PHP has more ways to write output than that. The statements used to write content back to the document in PHP is as follows:

- `echo`
- `print()`
- `printf()`
- `sprintf()`
- `print_r()`
- `heredoc`
- `nowdoc`
- `var_dump()`

### Echo
Echo is perhaps the most common command for writing output back to the containing document for transmission to the client. Unlike the other print commands, it is not a function. Rather it is a language construct. In other words it is a command that is used like an operator, rather than a function.

You will often see echo written to look like a function call, with parentheses after it, echo ($someVar);. The parentheses help to organize the code and are useful for marking the limits of longer strings and concatenations, but the parentheses are optional, and are even not allowed in some circumstances.

The echo command writes the values of one or more arguments to the screen. If there is more than one argument, then the arguments must occur in a comma separated list. Although the individual elements can have parentheses around them for grouping, the entire list cannot. This is, incidentally, because parentheses have a higher order of precedence than the echo command, so the parser would try to parse the comma separated list as an expression and pass the results to the command.

Correctly formed echo commands…

```php
echo $myVar;
echo ($myVar);
echo $myVar, $myOtherVar;
echo ($myVar), ($myOtherVar);
```

Incorrectly formed echo commands…

```php
// parentheses can’t be used this way
echo ($myVar, $myOtherVar);

// needs a separator between arguments
echo $myVar $myOtherVar;

// wrong separator between arguments
echo $myVar; $myOtherVar;
```

The echo command writes out the arguments to the document in the order in which they occur in the statement.

### Print
The print command is not a proper function.  It is a language construct.  Unlike the echo command, it only takes a single argument. This argument is written out to the document being processed.

### Formatting Output
PHP allows two variations on the C-style `printf()` commands, the `printf()` command itself and the `sprintf()`. Both allow you to format output strings based on formatting arguments passed to the function. Thus you can do things like specify alignment, padding characters, precision, and numbering system to display with.

The `sprintf()` command does the same thing as the `printf()` command, except that instead of return the results to the output document, it returns the results to be assigned to some variable. This allows you to then use the formatted output string in echo and print statements. So aside from a coding example, nothing more needs to be said about it.

```php
$myOut = sprintf('%.2f', $myNum);
echo "This number has two decimal places: " . $myOut;
```

So how does `printf()` work? It works by taking two or more arguments, which determine how the output string is to be generated. The first argument is the formatting string, which is a template that specifies how the output is to be formatted. The second argument and all other arguments after the second are data elements to be inserted into the output string where specified in the formatting string.

```php
printf('template', 'data'[...]);
printf('%d equal %x hex', 200, 200);
printf('%0.6f', $fpNum);
```

The purpose of the `printf()` statement is to format output for display. Since we are talking about PHP in the context of web development, its most common use for us is to format floating point numbers, but it has a wide variety of uses…

- Displaying integers in decimal, octal, or hexadecimal format.
- Insert values into string literals.
- Specify the sign of values.
- Set precision (the number of decimal places) in floating point numbers.
- Round floating point numbers.
- Set fixed width data fields.

The key element in the `printf()` statement is the formatting string. It contains one or more substation markers that specify what to do with the arguments that follow the formatting string. There should be one data element for each substitution marker. Each substitution maker begins with a percent sign ( % ) and ends with a character that indicates the display type for the data. Between the percent sign and the display type there can be a series of formatting modifiers that specify the formatting features of the output string.

### Formatting Modifiers
The formatting modifier change how the formatted output element is displayed. They are not required if the default settings are satisfactory for a given display type are satisfactory. If they are included, they must occur in the following order.

#### Padding Character
Sometimes you want to format elements so that they have some padding before or after them. The padding character allows you to specify what this is. The length and precision of the string are defined later. The padding character can have the following values…

- 0 (zero) -- a zero in this position indicates that the content, presumably a number, should be padded with leading zeros if shorter than the minimum display length or with trailing zeros if the precision is greater than the actual number of values after the decimal place. If you do not specify a length or a precision, then no padding will take place.
- (a blank space) -- a blank space in this position indicates that padding should be done with spaces. This is the default, so you don't actually have to specify it.
- 'x -- a single quote followed by some character specifies the character after the quote as being the padding character. In this case, the X would be a padding character.

#### Sign
The sign indicator is not exactly what it seems. What it does depends on the sign use. A minus sign `-` right justifies the output string, assuming the string is shorter than the specified length. A plus sign `+` forces a leading plus sign to appear in front of positive numbers.

#### Length
The length is a number that represents the minimum number of characters to output. The string will be padded to fit. The direction of the padding depends on the data type and the sign operator.

#### Precision
Precision only applies to floating point numbers and is used to specify how many positions to specify after the decimal place. It is represented by a period followed by a number representing the number of places desired.

An example using all of the formatting modifiers in a single statement…

```php
printf('The answer is %0+6.4f', $result);
```

Another example:

```php
printf("% 15S %'.-25d", $title, $page);
// which by the way would print the following
// for a table of contents or similar
// Some Title     .......................##
```

Also, if the percent sign is an operator in this situation, then how do you print a percent sign? You do this by putting two percent signs in the formatting string where you want the percent to occur.

```php
printf('%d%%', 25); // results is "25%"
```

#### Type Specifiers
The type specifier allows you to specify the data type the output string is supposed to represent. The data type of the output is actually a string, but the type specifier allows you to specify that the formatting in the string be appropriate to a given data type. For instance, you can specify that the output from the substitution be formatted as an integer, or a hexadecimal number, or a floating-point number with or without scientific format.

The type specifier must always be the last character as that it terminates the substitution string. Its values are as follows:

#### Strings
There is only one string specifier, S. The letter is capitalized. It is used to print out non-numeric values.

#### Integers
To display integers, any of the following values can be used…

- d -> display a decimal integer
- I -> display as decimal integer
- U -> display as unsigned integer
- B -> display as a binary value
- O (capital letter O) -> display as an octal value
- x -> display as a hexadecimal value with lower case letters
- X -> display as a hexadecimal value with upper case letters

#### Floating-Point Numbers
To display floating-point numbers any of the following can be used…

- f -> display as a floating-point number in standard decimal notation
- E -> display as floating-point number in scientific notation
- e -> same
- G -> if the requested precision is greater than or equal to the precision of the value to be written, then use standard decimal notation, otherwise use scientific notation
- g -> same

### Here Documents
The heredoc string structure is a method of including larger strings inside your code. You can use it to include content of any length. To create a heredoc, you use a special operator that is made up of three less than symbols `<<<`. The syntax is as follows…

```php
$longString = <<< termination_marker
any amount of content
termination_marker;
```

For instance…

```php
$longFellowNot = <<< End_of_verse
This short poem
May not fill a tome,
But it serves to show
How it is that heredoc goes.
End_of_verse;
```

Anything between the termination markers is preserved, included all white space, quote marks, and special characters. The last carriage return before the closing termination marker is omitted, so if you want one, you should leave a blank line after the end of the content and before the termination marker.  You just need to make sure that your termination string does not occur anywhere in the content being delimited.

Heredoc will also process the internal herdoc for variables.

An expample would be…

```php
$foo = new foo();
$name = 'MyName';

echo <<<EOT
My name is "$name". I am printing some $foo->foo.
Now, I am printing some {$foo->bar[1]}.
This should print a capital 'A': \x41
EOT;
```

The preceding would output the following…

> My name is "MyName". I am printing some Foo.
> Now, I am printing some Bar2.
> This should print a capital 'A': A

#### Now Documents

The books talks about heredoc on pages 51 - 52. In more recent versions of PHP[^1], there is a construct called the [nowdoc](http://php.net/manual/en/language.types.string.php#language.types.string.syntax.nowdoc). The syntax is subtly different. A nowdoc uses single quotes instead of double. It holds several advantages over the heredoc. The best example of this is that nowdoc, unlike a heredoc, will not process embedded code within the construct. This is useful if you are outputting code as it alleviates the code escape requirements of the heredoc.

```php
<?php
$foo = new foo();
$name = 'MyName';

echo <<<'EOT'
My name is "$name". I am printing some $foo->foo.
Now, I am printing some {$foo->bar[1]}.
This should not print a capital 'A': \x41
EOT;
?>
```
The preceding would output the following…

> My name is "$name". I am printing some $foo->foo.
> Now, I am printing some {$foo->bar[1]}.
> This should not print a capital 'A': \x41

### Data Dumps
Sometimes you are writing code that is not meant to format something nicely for the screen, but rather to display the values of elements within the code so that you can debug or track your scripts. PHP provides two commands to do this, `print_r()` and `var_dump()`.
Both attempt to display any variable passed to it, including arrays and objects, in a meaningful fashion. The other output statements will just print the string "Array" for arrays and "Object" for objects.

If you are using `print_r()` on an array, be aware of the fact that it does move the pointer indicating current array position to the end of the array. So of you are going to use that array later in the code, it will need to be reset.

Also, be careful not to use `print_r()` if there is any chance of the structure you are referencing might be recursive. Some objects do contain references back to themselves. This will yield an infinite loop. `var_dump()` is a little smarter. If it finds itself recursing, it stops after the third iteration.

What follows is a comparison of outputs for the different output statements (excluding `printf()`) so you can see how the deal with different data types. Note that if you use `print_r()` or `var_dump()` to write to a Web page, you need to put the output in `<pre>` tags to look like this, otherwise it will run together. This is because, as with anything in an HTML document, white space is ignored unless the browser is told otherwise.

What is represented here is the output of…

- a boolean,
- a floating-point number,
- a string,
- an array,
- and an object

These are our test variables:

```php
// a boolean
$testB = true;

// a floating-point number
$testN = 1.21715e12;

// a string
$testS = 'a test string';

// an array
$testA = array(1, 2, 3, 'cat', 'dog', 'bird');

// an object
class someObj {
   var $a = 10;
   var $b = '2';
   function ret_20() { return ($this->a * $this->b); }
} $testO = new someObj;
```

Output from echo

```php
// a boolean
1

// a floating-point number
1.21715E+012

// a string
a test string

// an array
Array

// an object
Object

Output from print
// a boolean
1

// a floating-point number
1.21715E+012

// a string
a test string

// an array
Array

// an object
Object

Output from print_r()
// a boolean
1

// a floating-point number
1.21715E+012

// a string
a test string

// an array
Array
   (
       [0] => 1
       [1] => 2
       [2] => 3
       [3] => cat
       [4] => dog
       [5] => bird
   )

// an object
someobj Object
   (
       [a] => 10
       [b] => 2
   )

Output from var_dump()
// a boolean
bool(true)

// a floating-point number
float(1.21715E+12)

// a string
string(13) "a test string"

// an array
array(6) {
     [0]=>
     int(1)
     [1]=>
     int(2)
     [2]=>
     int(3)
     [3]=>
     string(3) "cat"
     [4]=>
     string(3) "dog"
     [5]=>
     string(4) "bird"
   }

// an object
object(someobj)(2) {
     ["a"]=>
     int(10)
     ["b"]=>
     string(1) "2"
   }
```

## Conditional Statements
### The if Statement

In most C-style languages, there are two basic conditional statements, the if statement and the switch statement (also sometimes called the case statement). PHP is no exception. We are going to start with the if statement. It is the easier of the two.

The if statement is a simple concept. If something is true, then perform the statement block associated with it; otherwise skip the associated code. To use conditionals, you need to be evaluating an expression that evaluates to true or false. We have discussed conditional operators elsewhere, but we can also test for non-zero, non-null, non-empty values in variables, and many system defined functions return true or false depending on their successful execution.

The if statement takes the form of:

```php
if (conditional expression) {
    statement block;
}
```

If some conditional expression evaluates to true then PHP performs the associated statement block. For instance, the following statement will echo out a warning that the value of a variable is not an integer. It will only generate this message if the expression !is_int($x) evaluates to true, which is to say, if it is not a number.

```php
if (!is_int($x)) {
    echo ($x . ' is not an integer!');
}
```

If you just want to execute a single statement within an if statement, you do not technically need the curly brackets, but they are a good habit to get into so you don't forget them.

### The else Statement

The if statement executes a block of code if something is true.

What happens if you want to execute one block of code if something is true and another if it is false? In this case, PHP has something called the else statement.

The else statement can only follow an if statement and is used to mark off a statement block to execute if the conditional expression being tested evaluates to false. It does not take its own test condition expression because it executes in response to the if statement immediately preceding it returning false.

```php
if (!is_int($x)) {
    echo ($x . ' is not an integer!');
} else {
    echo $x . ' is a number we can work with!');
}
```

Don't forget the curly brackets around both expression blocks. Thinking that the else is part of the if statement (which technically it is) makes it easy to forget to close the if statement block before the else statement block.

### The elseif Statements

What happens if you want to test for more than simply whether a given expression equates to true or false, but want to test for and execute code based on a variety of possible conditions? Which is to say, what happens if there are three or more conditions.

PHP has an elseif statement. This allows us to test for another conditions if the first one wasn't true. The program will test each condition in sequence until:

- It finds one that is true. In which case it executes the code for that condition.
- It reaches an else statement. In which case it executes the code in the else statement.
- It reaches the end of the if … elseif … else structure. In this case it moves to the next statement after the conditional structure.

The elseif sturcture looks like this:

```php
if (is_int($x)) {
    echo ($x . ' is an integer');
} elseif (is_float($x)) {
    echo ($x . ' is a floating point number');
} elseif (is_string($x)) {
    echo ($x . ' is a string');
} elseif (is_bool($x)) {
    echo ($x . ' is a boolean');
} else {
    echo ($x . ' is not a primitive data type');
}
```

### The switch Statement

Although you can test for multiple conditions with a series of if statements, the if statement really does only test the truth of a single conditional expression at a time. It is a two state expression, either the statement block executes or it doesn't.

If you want to check a single variable for multiple values, you can do so with a series of if statements, but this is not always the best approach. PHP also provides a conditional statement for testing multiple values for a single variable or expression. This is the switch statement.

The switch statement, in its structure, is similar to the if statement. It takes an expression to be evaluated and a statement block.

The switch statement can only evaluate a single expression, but it can compare that single expression to a series of possible values. The expression to be evaluated is most likely not a conditional, since a conditional only has two possible states -- something best handled by an if … else statement. Rather it is usually some expression that can have a series of values, such as a variable that can have a number between 0 and 9, or a form field that can contain one of the fifty two-character abbreviations for the U.S. state names.

```php
switch (expression) {
    statements;
}
```

Although the shell of the statement is the same, the body of the statement block is significantly more complex and requires additional keywords to make the statement work. A full switch statement may look like the following example.

```php
switch ($myState) {
case "NY":
    echo "You're from New York";
    break;
case "VT":
    echo "You're from Vermont";
    break;
case "MA":
    echo "You're from Massachussetts";
    break;
default:
    echo "You're not from around here";
    break;
}
```

Let us look at the various elements.

#### The case Statement
A label is an identifier in the code used to assign a name to that specific location in the code. The case keyword is a label; it marks a point in the code to do something. Specifically it marks the point in the code to begin executing statements if the value of the expression being evaluated by the switch statement is equal to the value immediately following the case keyword or if the expression following the case keyword evaluates to true. The colon marks the end of the label. The entire label should be on one line.

In PHP, the case statement takes an expression, which must equate to true for the following code to be run. If you are doing simple equality then you can just provide the value you are checking for and it assumes that the expression is testing the switch expression against the value in question for equality. However, by allowing expressions, you can also test for other conditions, such as greater than and less than relationships. When using expressions, the expression you are testing against must be repeated in the case statement.

```php
switch ($someNumber) {
    case 0:
        echo "Zero is not a valid value.";
        break;

    case $someNumber \< 0:
        echo "I can't use negative numbers.";
        break;

    default:
        echo "Ready to compute.";
        break;
}
```

If an expression successfully evaluates to the values specified in more than one case statement, only the first one encountered will be executed. Once a match is made, PHP stops looking for more matches.

In the following case, the second case will never be executed, because anything greater than 1000 is also greater than 100.

```php
switch ($someNumber) {
    case $someNumber \> 100:
        echo "The number is greater than 100.";
        break;
    case $someNumber \> 1000:
        echo "The number is greater than 1000.";
        break;
}
```

The way around this is just to make sure that the conditions are specified in the correct order for what you want them to do.

```php
switch ($someNumber) {
    case $someNumber \> 1000:
        echo "The number is greater than 1000.";
        break;
    case $someNumber \> 100:
        echo "The number is greater than 100.";
        break;
}
```

#### The default Condition
The default keyword is a catchall case that marks the point to begin execution if none of the conditions being tested for are met. It is like the last else statement in a long string of elseif's.

Like the last else, it should always appear at the end of the switch statement, since it will always be executed if no previous match has been made, and since PHP stops looking when it finds a match. Default is always a match if it is reached. You should only use it if you have code that is to be run if none of the conditions are met. For instance, error code to report that the expression did not evaluate to an expected value.

#### The break Statement
The break keyword is a statement that says that we are done performing statements within this statement block and that we should exit immediately to the end of the statement block. If you forget the break statement, then the code will fall through, which is to say that the code will start executing at the label that matches the value of the expression being evaluated, and then will proceed to process all code until either the end of the switch statement or until it find a break statement, which ever comes first. If done intentionally, this can be useful. If done by mistake it can be a real problem.

Here is a good use of omitting break statements. It allows use to perform the same black of code for multiple possible values of the expression being evaluated.

```php
switch ($xyz) {
    // each of these three cases will process the same statements
    case $xyz \< 0:
    case 0:
    case 10:
        echo ($xyz . ' is not a value I can work with!');
        break;
    default:
        echo ($xyz . ' is ready for processing!');
        $abc = someFunc($xyz);
        break;
}
```

Here is a bad example of omitting break statements. The code will fall through and create a bit of a mess.

```php
// A poorly formed switch statement

switch ($xyz) {
    case is_int($xyz) == false:
        echo ($xyz . ' is not an integer!');
    case $xyz \<= 0:
        echo ($xyz . ' is too low!');
    case $xyz \>= 10:
        echo ($xyz .+ ' is too high!');
    default:
        echo ($ xyz . ' is within acceptable limits!');
        $abc = someFunc($xyz);
        break;
}
```

If we assume for right now that $xyz is not an integer:

- The code will report that $xyz is not an integer.
- Then report that it is too low a number.
- Then report it is too high.
- Then it report that it is an acceptable value.
- Then it will submit it to our function, which we can surmise from the code, was expecting a numeric value between 1 and 9,not something else. This, needless to say, would most probably generate an error.

Unless your goal is to confuse the user, what you would have is what is called a big mess.

The break statement can also be used in an odd way in PHP that can cause errors if you are not aware of it. If the break statement is the only statement following a given case statement, the code will skip to the default statement block instead of the end of the switch statement.

This may seem a little odd for experienced programmers because it raises the question, why include a separate case statement for case statement for something that should fall into the default. The primary reason is that it allows you to exclude certain values that might otherwise meet a later condition. For instance, if we go back to our previous example and wanted to code to run the default statements for a number between zero and nine or for any number divisible by 10, we could code:

```php
switch ($xyz) {
    case is_int($xyz) == false:
        echo ($xyz . ' is not an integer!');
        break;
    case $xyz \<= 0:
        echo ($xyz . ' is too low!');
        break; // the following statement will skip to the default
    case $xyz % 10 == 0:
        break;
    case $xyz \>= 10:
        echo ($xyz .+ ' is too high!');
        break;
    default:
        echo ($ xyz . ' is within acceptable limits!');
        $abc = someFunc($xyz);
        break;
}
```

### Alternate if
There is an alternate ways to code an if statement, one is a ternary operator.

The ternary operator takes the form of:

```php
(condition) ? value_if_true : value_if_false;

$hours = ($hours \< 13) ? $hours : $hours -= 12;
```

Since the ternary operator is, in fact, an operator, it returns a value, which is the value of one of the expressions. If the condition evaluates to true, then the first value is returned (value\_if\_true), otherwise the second value is returned (value\_if\_false). This means that the expressions for the true and false values need to be things that evaluate to values, not full blown statements, just simple expressions.

## Iteration
Some statements in PHP are known as iterative statements. These statements have control structures that delimit them and which determine how many times (zero or more) the delimited code is executed, based on some condition.

We will look at three structures here:

- the while statement and its variants
- the do … while statement
- the for statement

We will also look at some more advanced ways of working with iteration by being able to more freely move between nested iterative statements.

### The while Statement
The while statement is the most basic of iterative control structures. It is also known as a prefix look. It repeatedly runs a block of code until some condition is no longer true. If the condition is not true to begin with, then the code never runs. It takes the form of:

```php
while (expression) {
    statements;
}
```

For example, if we wanted to add together the first ten values from an array:

```php
$x = 0;
while ($x < 10) {
    $a = $a + $b[$x];
    $x++;
}
```

In the above code, we initialize a variable to zero (0) before beginning the loop. The while statement then evaluates the conditional expression. This expression must be inside parentheses. In this case, zero is less than 10, so the statement executes.

In the body of a while statement there must be some code that changes the value of the condition. Otherwise the loop will never terminate.

The last line in the statement block increments the variable we are testing in our conditional expression. In the body of a while statement there must be some code that changes the value of the condition. Otherwise the loop will never terminate. In the following code, the conditional expression will never become false, so the code will run forever (or until it crashes).

```php
// bad code -- an infinite loop
$x = 0;
$z = 0;
while ($x < 10) {
    $a = $a + $b[$z];
    $z++;
}
```

This state of endless execution is known as an infinite loop. An infinite loop is an iterative code element that has no valid termination condition, meaning it will never stop looping. A bit of trivia, it is also the street on which Apple’s headquarters is located ([Apple Computers Corporate Address](http://www.apple.com/contact/)). Anyone with any programming experience is all too familiar with them. Their causes are many, and they are far too easy to create.


### The do while Statement
A while statement will never execute if its conditional expression never evaluates to true. What happens if you want the code to always run at least once, regardless of the value of its conditional expression? The answer is use a do while statement. A do while statement is also known as a post fix loop.

A do while statement is like a while statement in reverse. First it runs the block of code, and then it evaluates the conditional expression. If the conditional expression is true, then it loops back to the beginning of the statement and starts again.

It takes the form of:

```php
do {
    statements;
} while (expression);
```

Note that since the curly brackets do not end the entire statement, we need a semi-colon at the end.

An example:

```php
$x = 0;
do {
    $a = $a + $b[$x];
    $x++;
} while ($x < 10);
```

This code will have the same effect as the equivalent while loop above. One that would work differently might be as follows:

```php
// will never run since the initial state of $x is $x != 10
$x = 0;
while ($x == 10) {
    $a = $a + $b[$x];
    $x++;
}

// will run once even though the initial state of $x is $x != 10
$x = 0;
do {
    $a = $a + $b[$x];
    $x++;
} while ($x == 10);
```

A more practical use for this loop might be to check whether something has a value. For instance, you could walk an array as long as you keep finding values.

```php
$x = 0;
do {
    if ($aName[$x]) {
        $bName[$x] = someProc($aName[$x]);
    }
    $x++;
} while (isset($aName[$x]));
```

In the preceding example, we take advantage of the fact that non-existent value return false. This example assumes all the array elements are contiguous, since it will stop executing with the first empty array element it finds.

The do while has no alternative syntax, partly since anything you can do with a do while statement you can also do with a while statement. The do while is just easier to read in certain circumstances. It is also partly because the while, in occurring at the end, would be indistinguishable from a nested while loop if the curly brackets were omitted.

### The for Statement
The for statement allows for incremental processing based on some incremental variable. The for statement is also known as an iterative loop. Unlike the while statement, the variable is incremented within the conditional expression itself. This means that you do not have to have code in the body of the statement to set the termination condition. This does not mean you that you cannot set the termination condition in the body, merely that you don't have to.

It takes the form of:

```php
for (init; condition; increment) {
    statements;
}
```

The three values that go inside the for statement conditional expression are:

- init -> The initial state of the variable to be tested. Normally done as an assignment, although the assigned value can be from any source, literal or variable.
- Condition -> The condition to be tested for. The statement keeps processing as long as it remains true.
- Increment -> The increment by which the variable being tested changes.

For example:

```php
for ($x = 0; $x < 10; $x++;) {
    $a = $a + $b[$x];
}
```

For and while are not one hundred percent interchangeable, so think about which one you want to use before coding.

The for statement assumes some sort of incrementation, such as counting through a set of something. It is designed for stepping through things.

Although any basic discussion of iteration tends to use incremental examples for both while and for statements, the while statement is better suited for testing some flag or condition. A flag, in programming terms, is a variable, usually boolean, that refers to the current state of something the in the program. Our example above of using a while statement to walk an array is an example where we are testing the contents of the elements of an array, not our position in it.

### The foreach Statement
The foreach construct provides an easy way to iterate over arrays. foreach works only on arrays and objects, and will issue an error when you try to use it on a variable with a different data type or an uninitialized variable. There are two syntaxes:

```php
foreach (array_expression as $value)
    statement
foreach (array_expression as $key => $value)
    statement
```
A foreach is really just a shorthand for a for statement to iterate over arrays.

## Termination Statements
Sometimes you want to break out of a control statement early, perhaps because of an error or some other condition that the conditional expression itself is not testing for. We have seen an example of this already with the break statement used in a switch statement-coding block.

Here we will look at various ways to prematurely terminate loops and conditionals by setting multiple exit points.

### The break Statement
Break breaks you out of the conditional statement and moves on to the first statement outside of the conditional statement. When using break to get out of a condition, be aware that it ignores if statements. This is so you can use an if statement to test whether you need to terminate the current conditional.

For instance, we could use it to modify a previous do while statement. In the following example, the code will now terminate if the value to be processed is not an integer.

```php
$x = 0;
$rVal = "";
do {
    if (isset($aName[$x])) {
        if (is_int($aName[$x])) {
            $rVal = "Bad Value";
            break;
        }
        $bName[$x] = someProc($aName[$x]);
    }
    $x++;
} while (isset($aName[$x]));
```

### The continue Statement
If you are using an iterative statement and don't want to terminate it, just skip the current instance or iteration, you can use the continue statement. Continue says that the current iteration is done and the next one should be started. This is useful if the statement block has multiple possible exit points.

```php
$i = 0;
while ($i++ < 5) {
    echo "Outer<br>\n";
    while (1) {
        echo "&nbsp;&nbsp;Middle<br>\n";
        while (1) {
            echo "&nbsp;&nbsp;Inner<br>\n";
            continue 3;
        }
        echo "This never gets output.<br>\n";
    }
    echo "Neither does this.<br>\n";
}
```

### Cautionary Note
 It is always best to build your code in such a way that the logic of your algorithm completes every possible outcome. While break and continue can be useful they are considered sloppy coding practice. The main reason for this is it obfuscates your code and makes it hard to follow. Break and continue statements should be avoided if at all possible. The only exception to this switch statement; where it is a construct of the control structure.

## Functions
A function is a statement block that has been assigned a name. That name allows it to be called or referred to, meaning the function can be invoked by name to perform some task, or function. This means that you can create a piece of code that will not run until specifically called for or invoked by another piece of code.

Being able to defer the execution of code until it is called for is a very powerful tool. It allows us to step out of linear, batch processing mode and instead operate in an event driven environment.

For students coming directly from and object orient language like Java or C#, think of a function as a classless method.

### Defining Functions
In PHP a function is defined as follows:

```php
function functionName(parameter) {
    statements;
return;
}
```

- The definition starts with the keyword function.
- This is followed by the name of the function.
- After that comes a set of parentheses containing the parameters, or input values, the function is expecting to receive. Each parameter must be a variable name. These variables are created by declaring them as parameters and are local to the function. Sometimes you will hear parameters called arguments. Technically an argument is what is sent and a parameter is what the function is expecting to receive. Most textbooks authors pick one or the other term and just stick with it, so you can consider them to be interchangeable words.
- After this comes the curly braces that delimit the statement block that makes up the body of the function.
- The last statement in the statement block should be a return statement, which returns control back to whatever called the function. The keyword return can stand-alone or it can be followed (with no intervening line break) by a value to be returned.If no value is specified, then the function returns null.

```php
function testVal($x) {
    if (!(is_int($x))) {
        echo "$x is not a number!";
    }
    return;
}

function strangeEquation(x, y, q) {
    var z = x * y;
    var p = q - 7;
    return (z * x % (y + 1)) / p;
}
```

When trying to figure out what to name your functions, you only need to remember a few basic rules.

- PHP function names are not case sensitive. Therefore, fname(), Fname(), and FNAME() all refer to the same function.
- The function name can only contain letters from the ASCII character set, digits, and the underscore.
- The function name cannot begin with a digit.
- You cannot give a function the same name as another function or reserved keyword. PHP does not support function overloading.

### Invoking Functions
You invoke, or call, a function by name. The name needs to be followed by a set of parentheses that contain zero or more values to be passed to the function, called the arguments for the function call. The number of values being passed should be equal to the number of parameters of the function. The values are assigned to the parameters in the order in which they appear defined in the function's parameter list.

Invoking a function:

```php
$x = 'bob';
testVal($x);
$x = 1;
$y = 2;
$q = 3;
strangeEquation($x, $y, $q);
```

If you want to pass values of a certain type, you need to test for this yourself since PHP, being a loosely typed language, does not check.

If you pass too many arguments, then the additional values do not get assigned to named parameters. They can still be accessed within the function, just not as named variables from the parameter list.

If you pass too few arguments, then the remaining parameters will be set to null. PHP will generate an error message about this, but will try to run the function anyway.

If you don't want to pass certain arguments, you cannot use the empty comma notation as you can in some languages. Instead you just need to put null values in those locations.

```php
$x = fName(,,$c); // incorrect
$x = fName(null,null,$c); // correct
```

### Passing by Reference
PHP always passes by value, including objects and arrays. There are two primary models for passing data back and forth in a program. One is passing by value and the other is passing by reference. Passing by value means that when you pass the variable by sending it as an argument to a function, or assigning it to another variable using an assignment operator, a copy of the value of the variable is made and that is what is passed to the receiving function or variable.

It works like this: If I set $a equal to 7, and then say $b = $a, I will then have two variables each storing the value if 7. If I change either one, it won't affect the other one. It is like a photocopy. After I have made the copies, writing something on one copy won't affect the other copies.

Passing by reference is a little more complicated and normally only occurs in object oriented environments. To understand it, it first helps to understand that variables are actually just pointers pointing to values stored in memory. Passing by value works by creating a new pointer pointing to a new location in memory with a copy of the stuff from the old location copied over to the new location. Passing by reference created a new pointer but points it to the exact same location. It is not actually passing the value anywhere; it is just creating new variables pointing to the exact same thing. Another way of saying it is that it creates an alias for the current variable instead of making a copy.

Passing by reference is not something that is needed very often. So, I will not spend time covering it here. If you find yourself in need of this particular skill, please refer the PHP Manual section on this topic ([References Explained](http://php.net/manual/en/language.references.php)).

## Variable Scope
A scope is the region of the program for which the variable is declared. All variables have scope. The scope of a variable is the portion of the script in which the variable can be referenced. PHP has four different variable scopes.

- local
- global
- static
- parameter

In PHP, all variables are local in scope, even the global ones. What this means is that all global variables not explicitly passed to a function are not accessible to that function.

### Local Scope
A local variable is on that is specific to a given instance of a given function. It is created when the function processing begins and is deleted as soon as the function is completed.

Local scope is specific to functions. PHP does not have a block level scope. If you want a block level scope, your best bet is to emulate it with a recursive function.

### Global Scope
Global scope refers to any variable that is defined outside of any function. They can be accessed from any part of the program that is not inside a function.

To access a global variable from within a function, you can call it into the function with the global keyword.

```php
global $varToInclude;
```

PHP also stores all global variables in an array called `$GLOBALS[]`. Its index is the name of the variable. This array is accessible from within functions and can be used to update global variables directly.

```php
global $somVar;
$someVar = 'abc'

// is the same as

$GLOBALS["someVar"] = 'abc';
```

### Static Scope
Normally when a function terminates, all of its variables are also cleaned up. Sometimes you want a local variable to persist between instances of a given function. To do this you use the static keyword when you first declare the variable. Then each time you call the function, that variable will still have the information it contained from the last time the function was called.

```php
static $aValueToRemember;
```

Even though the value persists, the variable is still local to the function.

### Parameters
A parameter is a local variable whose value is passed to the function by the calling code. Unlike other variables, parameters are declared in a parameter list as part of the function declaration. The scope of a parameter is only inside of the function it is being passed.

```php
function myFunc(\$para1, \$para2, [...]) {
// function code
}
```

#### Environment Variables (SuperGlobals)
Several predefined variables in PHP are "superglobals", which means they are available in all scopes throughout a script. There is no need to do global $variable; to access them within functions or methods. We already encountered one in the $GLOBALS array.

All of these environment variables are stored by PHP as arrays. Some you can address directly by using the name of the index position as a variable name. Other can only be accessed through their arrays. Which can be accessed which way is heavily dependent on how strict the security settings are for PHP on your server. We will discuss the methods of accessing these variables in more detail when we talk about processing user data, but using the arrays is a good coding practice.

Some of the environment variables include:

- `$_SERVER[]` -> Contains information about the server and the HTTP connection.
- `$_COOKIE[]` -> Contains any cookie data sent back to the server from the client. Indexed by cookie name.
- `$_GET[]` -> Contains any information sent to the server as a search string as part of the URL.
- `$ _POST []` -> Contains any information sent to the server as a POST style posting from a client form.
- `$ _FILES[]` -> Contains information about any uploaded files.
- `$ _ENV []` -> Contains information about environmental variables on the server.

We will go very much more indepth on the SuperGlobals in a future unit.

## Odds and Ends
### Anonymous Functions
PHP also allows you to generate anonymous functions, also called lambda functions. These functions do not have names. They are instead assigned directly to variables and called by the variable name. This allows you to create transient functions without worrying about having to think up a new function name each time you do.

To create an anonymous function, you use the `create_function()` function. It takes two strings as arguments. One represents the parameter list for the function, exactly as it would appear between the parentheses in a normal function definition. The other is a string contains the actual body of the function. As you might it expect, it is best used with shorter functions.

```php
$fX = create_function('$a, $b','return $a * $b;');

$z = $fX($x, $y);
```

Anonymous functions do have names, but they are randomly generated strings, which minimizes the chance of the function accidentally producing two functions with the same name.

The ability to create anonymous functions exists in PHP primarily for interacting with functions that expect other functions as their arguments. It makes the coding easier and most such functions are very contextual and tend to require variations if not within the same execution of a script than certainly between executions.

### Nesting
In PHP, function definitions can be nested. This is a byproduct of support for the object-oriented environment.

When you define a function within another function it does not exist until the parent function is executed. Once the parent function has been executed, the nested function is defined and as with any function, accessible from anywhere within the current document. If you have nested functions in your code, you can only execute the outer function once. Repeated calls will try to redeclare the inner functions, which will generate an error.

PHP functions can also be nested inside other statement blocks, such as conditional statements. As with nested functions, such functions will only be defined when that block of code is executed. You can use this to get around the lack of overloading in PHP by allowing multiple versions of the same function to be set up and then have an if statement to determine which one to actually define. Since a function can only be defined once, this will only work if the conditional is only executed once in the script.


[^1]: PHP 5.3 and newer