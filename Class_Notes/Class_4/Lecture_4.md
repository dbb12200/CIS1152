# Lecture 4

<!--TOC-->

## Functions

A function is a statement block that has been assigned a name. That name allows it to be called or referred to, meaning the function can be invoked by name to perform some task, or function. This means that you can create a piece of code that will not run until specifically called for or invoked by another piece of code.

Being able to defer the execution of code until it is called for is a very powerful tool. It allows us to step out of linear, batch processing mode and instead operate in an event driven environment.

For students coming directly from Java, think of a function as a classless method.

### Defining Functions

In PHP a function is defined as follows:

```php
function functionName(parameter)
{
    statements;
    return;

}
```

-   The definition starts with the keyword function.
-   This is followed by the name of the function.
-   After that comes a set of parentheses containing the parameters, or input values, the function is expecting to receive. Each parameter must be a variable name. These variables are created by declaring them as parameters and are local to the function. Sometimes you will hear parameters called arguments. Technically an argument is what is sent and a parameter is what the function is expecting to receive. Most textbooks authors pick one or the other term and just stick with it, so you can consider them to be interchangeable words.
-   After this comes the curly braces that delimit the statement block that makes up the body of the function.
-   The last statement in the statement block should be a return statement, which returns control back to whatever called the function. The keyword return can stand-alone or it can be followed (with no intervening line break) by a value to be returned. If no value is specified, then the function returns null.

```php
function testVal($x)
{
    if (!(is_int($x)))
    {
        echo "$x is not a number!";
    }
    return;
}

function strangeEquation($x, $y, $q)
{
    $z = $x * $y;
    $p = $q - 7;
    return ($z * $x % ($y + 1)) / $p;
}
```

When trying to figure out what to name your functions, you only need to remember a few basic rules.

-   PHP function names are not case sensitive. Therefore, fname(), Fname(), and FNAME() all refer to the same function.
-   The function name can only contain letters from the ASCII character set, digits, and the underscore.
-   The function name cannot begin with a digit.
-   You cannot give a function the same name as another function or reserved keyword. PHP does not support function overloading.

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
$x = fName(, ,$c); // incorrect
$x = fName(null, null, $c); // correct
```

#### Passing by Reference

PHP always passes by value, including objects and arrays. There are two primary models for passing data back and forth in a program. One is passing by value and the other is passing by reference. Passing by value means that when you pass the variable by sending it as an argument to a function, or assigning it to another variable using an assignment operator, a copy of the value of the variable is made and that is what is passed to the receiving function or variable.

It works like this: If I set `$a` equal to `7`, and then say `$b = $a`, I will then have two variables each storing the value if `7`. If I change either one, it won't affect the other one. It is like a photocopy. After I have made the copies, writing something on one copy won't affect the other copies.

Passing by reference is a little more complicated and normally only occurs in object oriented environments. To understand it, it first helps to understand that variables are actually just pointers pointing to values stored in memory. Passing by value works by creating a new pointer pointing to a new location in memory with a copy of the stuff from the old location copied over to the new location. Passing by reference created a new pointer but points it to the exact same location. It is not actually passing the value anywhere; it is just creating new variables pointing to the exact same thing. Another way of saying it is that it creates an alias for the current variable instead of making a copy.

Passing by reference is not something that is needed very often. So, I will not spend time covering it here. If you find yourself in need of this particular skill, please refer the PHP Manual section on this topic ([References Explained](http://php.net/manual/en/language.references.php)).

#### Global and Static Variables

PHP is slightly odd in that variables defined outside of functions, which we would normally consider to be global are not accessible from within functions. They are, in essence, local to the global environment. So how do we get at those values within a function without passing all of them in as arguments?

PHP provides two methods for getting global variables into functions.

The first is the `$GLOBALS[]` array, which is a super-global array that stores all user defined global variables. Thus, you can access a global variable called `$thisVar` within the function with `$GLOBALS["thisVar"]`.

The second method is to use the global keyword. It is used inside the function to create references to global variables into the function. Prefixing a variable, or list of variables, with the word global as its own complete statement declares that you want to use the variable within the function. Note, this does not pass a copy or a reference in to the function; it makes the variable available within the function. Changes to the variable will show up outside the function.

```php
function abc()
{
    global $x;
    global $a, $b, $c;
}
```

Static variables are variables that are local to the function but persist across instances of the functions execution. Normally local variables within functions are created when the function is called and destroyed when the function is finished. If you want local variables to persist across calls to the function, you can use the static keyword when declaring the variable. This will cause the variable to only be initialized during the first call to the function. During subsequent calls, the function will check to see if the variable already exists. If it does, it will work with the value that already exists.

```php
function abc()
{
    static $x;
    static $a = 7;
}
```

### Advanced Functions

#### Default Parameter Values

PHP allows you to set default parameter values in the function definition. This allows the parameters to be assigned values for when a value is not passed in for them. The format looks like this:

```
function withDef($x, $y = 12; $z = 24)
{

    [ ... statements ... ]

}
```

When you use default values for parameters, they become optional and do not have to be included in the function call. The rules regarding their use are pretty simple. Parameters with default values must be declared after parameters without default values. Which is to say, you have to specify the required parameters before you specify the optional ones.

You cannot leave any blank parameters between the start of the list and the last one specified. Every parameter up to the last one provided must have a value passed to it. Thus you should order arguments in the order of must common inclusion to least common inclusion.

#### Variable Length Argument Lists

If you don't know how many arguments you will need to provide, PHP does have methods for working with any number of arguments in a function. To make use of them you create a function with no parameters.

```php
function someFunc()
{
    [ ... statements ... ]
}
```

You then call the function with as many parameters as you want to pass to it. Within the function you make use of a set of system-defined functions that access the parameters passed in and allow you to work with them.

`func_get_args()` is a function returns the arguments that have been passed to the function as an array. You can then walk through the array normally.

```php
function foo()
{
    $numargs = func_num_args();
    echo "Number of arguments: $numargs<br />\n";
    if ($numargs >= 2) {
        echo "Second argument is: " . func_get_arg(1) . "<br />\n";
    }
    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {
        echo "Argument $i is: " . $arg_list[$i] . "<br />\n";
    }
}
```

func_num_args() is a function returns the number of arguments that were passed to the function. Useful to test whether any have been passed at all.

```php
function someFunc()
{
    if (func_num_args() == 0) { return false; }
    [ ... statements ...]
}
```

`func_get_arg()` returns a single argument for the arguments passed to the function. It takes as an argument the index position of the argument you want returned. Not that it is a separate function from `func_get_args()` and differs only by the absence of an *S* at the end.

```php
function someFunc()
{
    if (func_num_args() == 0)
    {
        return false;
    } else
    {
        for ($i =0; $i < func_num_args(); $i++)
        {
            $x = func_get_arg($i);
            [ ... statements ...]
        }
    }
}
```

The only caveat to these functions is that they cannot be used as arguments to be passed to another function. You can write the results to a variable and use that.

#### Variable Functions

As with variable variables, PHP allows you to create variable functions.

A variable function is one whose name has been assigned to a variable and which is then called through that variable.

```php
function fX($a)
{
    [ ... statements ... ]
}

$indirect = "fX";

$y = $indirect($x);
```

This allows you to dynamically determine function names to be executed from previous processing.

#### Anonymous Functions

PHP also allows you to generate anonymous functions, also called lambda functions. These functions do not have names. They are instead assigned directly to variables and called by the variable name. This allows you to create transient functions without worrying about having to think up a new function name each time you do.

To create an anonymous function, you use the `create_function()` function. It takes two strings as arguments. One represents the parameter list for the function, exactly as it would appear between the parentheses in a normal function definition. The other is a string contains the actual body of the function. As you might it expect, it is best used with shorter functions.

```php
$fX = create_function('$a, $b', 'return $a * $b;');
$z = $fX($x, $y);
```

Anonymous functions do have names, but they are randomly generated strings, which minimizes the chance of the function accidentally producing two functions with the same name.

The ability to create anonymous functions exists in PHP primarily for interacting with functions that expect other functions as their arguments. It makes the coding easier and most such functions are very contextual and tend to require variations if not within the same execution of a script than certainly between executions.

It is a little deep water and we will not heavily dwell here, but anonymous functions are incredibly useful and are becoming very common place in modern programming techniques.  A good example is when you need to map output of an array.

```php
$data = array(
        array('id' => 1, 'name' => 'Bob', 'position' => 'Clerk'),
        array('id' => 2, 'name' => 'Alan', 'position' => 'Manager'),
        array('id' => 3, 'name' => 'James', 'position' => 'Director')
);

$names = array_map(
        function($person) { return $person['name']; },
        $data
);
```

#### Nesting

In PHP, function definitions can be nested. This is a byproduct of support for the object-oriented environment. We will discuss what this means when we cover objects.

When you define a function within another function it does not exist until the parent function is executed. Once the parent function has been executed, the nested function is defined and as with any function, accessible from anywhere within the current document. If you have nested functions in your code, you can only execute the outer function once. Repeated calls will try to redeclare the inner functions, which will generate an error.

PHP functions can also be nested inside other statement blocks, such as conditional statements. As with nested functions, such functions will only be defined when that block of code is executed. You can use this to get around the lack of overloading in PHP by allowing multiple versions of the same function to be set up and then have an if statement to determine which one to actually define. Since a function can only be defined once, this will only work if the conditional is only executed once in the script.

## Arrays

***Program Note: We will cover arrays in much more detail after we complete the unit on objects***

An array is a collection of data values organized as an ordered collection of key-value pairs. It is one of the many included data structures in PHP. An array is like a filing cabinet. Each drawer can contain individual elements but they are held together as one object. Just as a file cabinet is not limited to just holding files, an array is not limited to holding just one type of data.

We will cover creating an array, adding and removing elements from an array, and looping over the contents of an array. We will discuss both associative and indexed arrays. You could say we are going to cover and array of arrays. Because arrays are very common and useful, there are many built-in functions that work with them in PHP. For example, if you want to send email to more than one email address, you’ll store the email addresses in an array and then loop through the array, sending the message to the current email address. Also, if you have a form that permits multiple selections, the items the user selected are returned in an array. If you access the Super Globals all of their data is held as arrays. You will see arrays over and over again. We better learn to like them!

### Indexed vs Associative Arrays
There are two kinds of arrays in PHP: indexed and associative. The keys of an indexed array are integers, beginning at 0. Indexed arrays are used when you identify things by their position. Associative arrays have strings as keys and behave more like two-column tables. The first column is the key, which is used to access the value.

PHP internally stores all arrays as associative arrays; the only difference between associative and indexed arrays is what the keys happen to be. Some array features are provided mainly for use with indexed arrays because they assume that you have or want keys that are consecutive integers beginning at 0. In both cases, the keys are unique. In other words, you can’t have two elements with the same key, regardless of whether the key is a string or an integer.

PHP arrays have an internal order to their elements that is independent of the keys and values, and there are functions that you can use to traverse the arrays based on this internal order. The order is normally that in which values were inserted into the array, but the sorting functions described later in this chapter let you change the order to one based on keys, values, or anything else you choose.

However, it is worth noting that there are many subtle differences in between associative and indexed arrays in PHP.

The most prevalent one that comes to mind is that an indexed array can be looped over using a traditional for loop, whereas an associative one cannot (because it does not have the numeric indexes):

```php
for ($i = 0; $i < count($indexed_array); $i++)
{
    echo $indexed_array[$i];
}
```

Of course, php also has a foreach keyword, which works the same on both types.

### Array Fundamentals
Before we look at creating an array, let’s look at the structure of an existing array. You can access specific values from an existing array using the array variable’s name, followed by the element’s key, or index, within square brackets:

```php
$person['Brian']
$shows[2]
```

The key can be either a string or an integer. String values that are equivalent to integer numbers (without leading zeros) are treated as integers. Thus, `$array[3]` and `$array['3']` reference the same element, but `$array['03']` references a different element. It is considered best practice to **use the integer without the quotes.**

You don’t have to quote single-word strings. For instance, $person['Brian'] is the same as $person[Brian]. However, it’s considered good PHP style to **always use quotes**, because quoteless keys are indistinguishable from constants. When you use a constant as an unquoted index, PHP uses the value of the constant as the index and emits a warning:

```php
define('index', 5);
echo $array[index]; // retrieves $array[5], not $array['index'];
```

You must use quotes if you’re using interpolation to build the array index:

```php
$person["Clone{$number}"]
```

Although sometimes optional, you should also quote the key if you’re interpolating an array lookup to ensure that you get the value you expect:

```php
// these are wrong
print "Hello, {$person['name']}";
print "Hello, {$person["name"]}";
```

### Multidimensional Arrays
The values in an array can themselves be arrays. This lets you easily create multidimensional arrays:

```php
$row0 = array(1, 2, 3);
$row1 = array(4, 5, 6);
$row2 = array(7, 8, 9);
$multi = array($row0, $row1, $row2);
```

You can refer to elements of multidimensional arrays by appending more `[]`s:

```php
$value = $multi[2][0]; // row 2, column 0. $value = 7
```

To interpolate a lookup of a multidimensional array, you must enclose the entire array lookup in curly braces:

```php
echo("The value at row 2, column 0 is {$multi[2][0]}\n");
```

Failing to use the curly braces results in output like this:

> The value at row 2, column 0 is Array[0]

## HTTP Basics
HTTP: the HyperText Transfer Protocol is the transmission protocol used to transmit Web pages on the Internet HTTP, or Hypertext Transfer Protocol is the network protocol used to transmit Web content over the Internet. It works with TCP/IP to transmit information. IP stands for Internet Protocol and handles packaging information for delivery. TCP is the Transmission Control Protocol and it handles packaging information for delivery. HTTP handles addressing the package and providing information that allows the client and server to effectively communicate over the Web.

Yes that's way too many acronyms.

Anyway, any online application has numerous layers that it is working in or through. Each layer handles a specific aspect of the task at hand. For instance, when you open a Web browser, you have your operating system, your user account and preferences, the application, and the actual display of the page you are viewing all working together on the screen. On the Internet you have separate layers handling the transmission of data, the packaging of data, and the addressing of data.

One way to grasp it is to imagine you work for a large wholesale company that delivers its own goods. The Transmission Control Protocol is like the delivery fleet that ships the goods. The Internet Protocol is the shipping room at the front of the warehouse, where things are pulled out of the warehouse (the server) and packaged for delivery to the client. Hypertext Transfer Protocol is the sales department that writes up the invoices and, more importantly, the shipping labels for the packers and drivers to use to figure out what to pack and where it goes.

Most of what we talk about when we talk about HTTP is the information it adds to the data package being shipped in order to increase the efficiency of delivery and the usability of the information on both sides of the transaction.

In its simplest form, we can think of HTTP as nothing more than a header, or shipping label, and the protocols for processing the data in this header. If you have ever sent a package by UPS, then you know there is more to a shipping label than just the address it is being sent to. The HTTP header is a protocol that tries to pass all the information an application on the client or server may need from the other end of the transaction.

An HTTP message can be broken into three parts.

the request/response line
the HTTP header
the body of the message
The body of the message is either the content being sent from the server to the client, or form data or an uploaded file being sent from the client to the server. In other words, it is the thing we think of as being the document we sent or received. Not much more needs to be said about that here. However, the other two sections can use some explanation.

### Request and Response

If the request line can be seen as a specification of what to order from whom, the response line can be seen as the receipt confirming that the transaction took place. There can only be one of the two in any message.

URI: the Uniform Resource Indicator, a superset of the URL, is a protocol for uniquely identifying every document accessible on the Internet. The request contains three critical pieces of information. The first is the method of request, which is to say, how the server is supposed to process it. The second is the path to the resource being requested. The third is the version number of HTTP being used.

The method tells the server how to handle the request. The three most common are GET, HEAD, and POST.

**GET**
This is a simple request for a document or resource residing at a specific URI (Uniform Resource Indicator). It is the most common type of Web request.

**HEAD**
This is similar to a GET request, except that it is only looking for HTTP header information on the resource, not the resource itself.

**POST**
Indicates that information is being sent the the server inside the HTTP body. The URI should point to a resource capable of handling the data being posted.

A typical request header might look something like this:
> GET /index.php HTTP/1.1

The reply line indicates whether the request was successful. It includes the protocol being used, a numeric status code, and a short description of the status code.
> HTTP/1.1 200 OK

The numeric status codes fall into the following ranges:

- 100-199 -> Information messages on the current status of processing.
- 200-299 -> Successful request.
- 300-399 -> Request cancelled because document or resource has been moved.
- 400-499 -> Client error. The request was incomplete, incorrect, or otherwise unresolvable.
- 500-599 -> Server error. Request appears valid, but server could not complete it.

The most common status message people get to see is 404 Not Found, which simply means that document you requested does not exists. This is either because it really doesn't exist or because you entered the URL wrong. When a 404 is returned it is usually displayed on the browser screen in whatever default format is used by that browser. The server may also transmit a detailed error report page along with an error message if the resource call was unsuccessful.

### The HTTP Header

People who know just enough HTML to be dangerous encounter the term HTTP header and may think that is corresponds in some way to the document header in an HTML document. This is not the case. The HTML document header is something you have coded into the document between `<head>` tags, and, as far as the server is concerned, is part of the document content being sent. The HTML header is information the author has provided for the client application about the document. The HTTP header, on the other hand, is information the client and server provide each other about the transmission process for the document.

If you need a concrete example, think of the HTML header as the date and address written at the top of a business letter, while the HTTP header is the address written on the outside of the envelope. They may both be addresses, but they are physically different things in physically different locations.

The HTTP header contains details about the transaction between the client and server, with slight variations depending on whether it is a request or a response. The header information can be grouped into three different categories. These are:

#### General
General information fields contain information about either the client or the server. General information can be as general as nothing but the current date and time.

#### Entity
Entity information fields contain information about the data being transmitted. Common entity information is the date on which the document or resource was last modified or the address of the document requesting this one.

#### Request/Response
The request/response fields contain information about the client and server configuration, including what sort of documents the client can accept and what sort of requests the server can accept. This information includes the server name and version for the server, and the client application name and version for the client. It also includes the platform being used by the client or the server. This information is often used by client or server applications to customize the request or response for the needs of the application on the other end of the connection. It can also be used to specify what sort of documents the client can receive, so, for example, the server knows not to try to send images or audio files to a text-only interface.

Each header field is delimited by a line break at the end. In other words, each data field is written on its own line. The end of the header section is delimited by one or more blank lines. In computer terms, a blank line is nothing but some form of newline character. So the end of the header section is actually delimited by a sequence of line break characters with nothing between them.

A sample request header might look as follows:

> GET /tutorials/utils/servervars.php HTTP/1.1
> Accept: text/html, image/png, image/jpeg, image/gif, */*
> Accept-Language: en
> Accept-Encoding: deflate, gzip, x-gzip, identity, *
> Connection: Keep-Alive
> Host: localhost
> Referer: http://localhost/tutorials/utils/
> User-Agent: Opera/6.05 (Windows XP; U) [en]

A sample response header might look as follows:

> HTTP/1.1 200 OK
> Date: Wed, 22nd Jan 2003 11:15:15 GMT
> Server: Apache/2.2.43 (Win32) PHP/5.3.0
> Last-modified: Mon, 19th Jan 2015 11:10:47 GMT


## Super Globals

***If you are not familiar with arrays, then you probably want to review those before looking at this section.***

In order to store information coming from both the client and server and pertaining to the current execution of a script, PHP has a series of arrays defined. These arrays are referred to as the super globals since, in a standard PHP configuration; they are directly accessible from any point in the code, within functions or without. Depending on your configuration, you may need to use the global keyword to include these arrays in a function, however, the super global array `$GLOBALS[]` is always accessible from anywhere in the code.

You will also find these arrays referred to as environmental variables, since they store information about the environment in which the script is running.

Each array gains it name from the portion of the environment it is responsible for tracking. Most global array values have three different ways of being referenced. The array element can be addressed individually as its own variable. There are differences on when you can use each format.

The global arrays are all associative arrays. This means the value is associated with a name that is the index key for the contents and, sensibly, describes what the value represents. For instance, `$_SERVER["SCRIPT_NAME"]` contains the URL path to the current page.

At its most basic, the screening process works like this:

```php
$formField1 = '';
foreach ($_POST as $key => $value)
{
    if (isset(${$key})
    {
        ${$key} = $value;
    }
}
```

What this could would do would be to only accept a value from the `$_POST[]` array if it had an index key of `$formField1` and assign it to the variable `$formField1`. Any variables the programmer was not expecting would be ignored, preventing the user from trying to pass bogus variables. The `isset()` function returns true if a variable already has a value, an empty string being a legal value, Thus the code would only overwrite existing variables and not allow any new ones to be created. Note the use of variable variables so we don't have to test each internal value separately.

The list of super globals is as follows (see [PHP Manual, Superglobals](http://www.php.net/manual/en/language.variables.superglobals.php)):
- $GLOBALS
- $_SERVER
- $_GET
- $_POST
- $_FILES
- $_COOKIE
- $_SESSION
- $_REQUEST
- $_ENV

### The `$_SERVER[]` Array

Most of the global arrays store various types of values defined by the programmer. This means there isn't much that can be said about their contents since that is entirely specific to the current script. The exceptions are the `$_SERVER[]` array, which stores system information related to the execution of the current script, and `$_ENV[]` which stores information about the general system environment. These have many predefined values, which we can talk about and of which it is useful to be aware. For now we will focus on the `$_SERVER[]` array. It has values that are of immediate use to us in learning PHP. The elements in the `$_ENV[]` array only come in to place for advanced PHP coding and server management. Although, if you want to know the default mail message for the system, it can found under `$_ENV["MAILMSG"]`

The $`_SERVER[]` array maintains server information that pertains to the current session and information received from the client in the HTTP header of the client request. The names of these elements, where relevant, adhere to the current standards for CGI scripting. Others come from the HTTP specifications, usually matching the names of the header fields.

`$_SERVER` is an array containing information such as headers, paths, and script locations. The web server creates the entries in this array. There is no guarantee that every web server will provide any of these; servers may omit some, or provide others not listed here.

#### HTTP Elements

Here are the most common HTTP elements. Note that there are many other HTTP headers, including many of no use to PHP, so it ignores them, but these are the ones that contain information useful to successfully serving up content to a client.

- `HTTP_ACCEPT` -> Contains a comma separated list of the MIME types the client is willing to accept. For instance: text/html, image/png, image/jpeg, image/gif
- `HTTP_ACCEPT_CHARSET` -> Contains a comma separated list of the character encodings the client is willing to accept. For instance: utf-8, utf-16, iso-8859-1
- `HTTP_ACCEPT_ENCODING` -> Contains a comma separated list of the file encodings the client is willing to accept. For instance: deflate, gzip, x-gzip, identity
- `HTTP_ACCEPT_LANGUAGE` -> Contains a comma-separated list of the languages the client is expected the text content to be presented in. For instance: en, ja, fr
- `HTTP_CONNECTION` -> Details the expected nature of the HTTP connection between the client and server. Normally it contains the value Keep-Alive.
- `HTTP_HOST` -> Contains the fully qualified name of the current server as defined by the Domain Name System.
- `HTTP_REFERER` -> Contains the complete URL of the document or resource that requested the current resource.
- `HTTP_USER_AGENT` -> Contains information on the browser other user agent being used to request content. A typical example is:
    > Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)

### CGI Elements

Many of the elements that show up are from the CGI specifications. Here is the list of those and what they contain.

- `SERVER_SOFTWARE` -> This contains a string that identifies the server. If the server is running PHP, this will also be specified here.
- `SERVER_NAME` -> The host name, DNS alias, or IP address of the server hosting the current script.
- `SERVER_ADDR` -> The IP address of the server.
- `GATEWAY_INTERFACE` -> The version of the CGI standard used by the server. Normally this is CGI/1.1.
- `SERVER_PROTOCOL` -> The name and version of the request protocol. Normally this is HTTP/1.1.
- `SERVER_PORT` -> The server port to which the request was sent. The default port for HTTP calls is port 80.
- `REQUEST_METHOD` -> The method used by the client to request the document. For most Web page requested, this will be either GET or POST.
- `PATH_INFO` -> Path information provided by the client pointing to the location of the requested resource on the server.
- `PATH_TRANSLATED` -> The requested path info as translated by the server to reflect any aliasing and redirection specified on the server.
- `SCRIPT_NAME` -> The name, including path, of the current resource, document, or script as specified in the URL. This is also aliased to the elements `REQUEST_URI` and `PHP_SELF` in the array. The first is the server version of the data field, the second the PHP version. The second is the more commonly used array element in PHP programming.
- `SCRIPT_FILENAME` -> The translated pathname for `SCRIPT_NAME`. This contains the server path to the resource. This is not really part of the CGI standard, but it is a good place to include it.
- `PHP_SELF` -> The filename of the currently executing script, relative to the document root. For instance, `$_SERVER['PHP_SELF']` in a script at the address `http://example.com/test.php/foo.bar` would be `/test.php/foo.bar`. The `__FILE__` constant contains the full path and filename of the current (i.e. included) file.
- `QUERY_STRING` -> Contains the query string, which is everything after the question mark (but before the hash mark) in the URL.
- `REMOTE_HOST` -> The name of the requesting host. If the requesting host has no DNS, this field is blank.
- `REMOTE_ADDR` -> The IP address of the requesting machine.
- `AUTH_TYPE` -> Specifies the authentication method for a restricted resource.
- `REMOTE_USER` -> Specifies the user name in a password protected session. The array does not store the password.
- `CONTENT_TYPE` -> The content type of queries with attachments from the client, such as a POST query.
- `CONTENT_LENGTH` -> The length of the attached content in a such a query.

### Other Server Elements

The `$_SERVER[]` array also includes some general info provided by the server for its own reference. Here is the basic set.

- `DOCUMENT_ROOT` -> The document root defines where the server is to look for documents when it isn't told to look elsewhere. It is the default resource directory.
- `PATH` -> The path is the path variable. It specifies where to look for object files and other executables.
- `REMOTE_PORT` -> The port on the client from which the request was made.
- `SERVER_ADMIN` -> This element normally contains the e-mail address of the administrator for the server.
- `SERVER_SIGNATURE` -> The signature of the server is comprised of the server software, the DNS alias and the port number.

## PHP Form Data

When you are using PHP to process information provided by the user, you are normally doing form processing. Thus, a discussion of how to retrieve data from the user is really about how to process form data submitted by the client to the server. To do this we make use one or more of the following four global arrays:
- `$_GET[]`
- `$_POST[]`
- `$_FILES[]`
- `$_REQUEST[]`

Since file processing is an advanced topic, using the `$_FILES[]` array
and managing files post by users will be its own topic later. There are
various reasons to be cautious about using the `$_REQUEST[]` array, like
what happens when we have a GET field and POST field with the same name.
So for now we will stick with talking about using `$_GET[]` and
`$_POST[]` to talk about how to process user data.

### The Basics

The basic concept is really simple. Data returned from the client using the POST method are stored in the `$_POST[]` array by PHP. Data returned from the client using the GET method, or as a query string in the URL, are stored in the `$_GET[]`. It is possible to have both if; for instance, you have a form using a POST method that is posting to a URL that includes a query string.

The name of the elements in the arrays directly corresponds to the field names in the form and/or query string. For instance:

```php
<form method="POST" action="myscript.php?flag=yes">

<p>

<input type="text" name="field1"> Sample field

</p> [...]
```

The above coding snippet would generate a `$_GET[]` elements called `$_GET["flag"]` and have the value of "yes". It would also create a `$_POST[]` element called `$_POST["field1"]` and having the value entered into the form field by the user.

To retrieve a value, you just check the array element in `$_GET[]` or `$_POST[]` with the same name as the form field. It is that simple. With a little creative coding, you don't even need to know what the form fields are called in advance; you can just walk the arrays. Although you do need to know what the fields are in order to know what to do with their content.

### Tips and Tricks

There are numerous little bits of information that go with the task of processing form data. You can improve your coding if you are ware of them. The following is a list of tips and tricks of for processing form data. They are not presented in any particular order.

#### General Tips

Forms do not return fields that don't have values, so blank fields with no default values will not be returned to the server. Thus PHP will have to account for the fact that not every form field may be accounted for in the reply from the client.

For checkboxes, if a value has not been provided in the HTML code, will return a value of "on". Usable, but you should always provide a value for these fields to return.

For compatibility with all systems, it is recommended that you write `GET` and `POST` in upper case, thus `method="POST"` and not `method="post"`.

If, for some reason, you don't know the requesting method the client is using, it is stored by name in `$_SERVER["REQUEST_METHOD"]`.

Data validation in PHP is more robust than data validation in JavaScript. Data validation on the server is in general more robust than client-side data validation. You should always revalidate form data on the server. Client-side validation is just to avoid unnecessary calls to the server.

`GET` requests are cached when received by the client. A call to the same resource with the same query string may return the cached version instead of rechecking the server. If using a `GET` method with extremely time sensitive data, you should make sure that caching is turned off for the page.

Here are the PHP commands to write out HTTP headers to tell the browser not to cache:

```php
// Set past expiration date
header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");

// Define mod date to indicate page is modified
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

// HTTP 1.1 cache commands
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

// HTTP 1.0 cache commands
header("Pragma: no-cache");
```

You can also use the following HTML meta tag to set a past expiration date.

```html
<meta http-equiv="expires" content="Sat, 01 Dec 2014 12:00:00 EST" \>
```

Resource requests using POST are always refreshed against the server. They are not cached. You should always use the POST method if the result data may change when the form data does not change.

### Form Field Names

If the name of the form filed contains characters that are illegal characters for the array index key names, the characters will be replaced with underscores. You should code your forms to not have illegal characters in the field names.

If a form field can have multiple values, such as a selection field with multiple turned on, or a set of checkboxes that all have the same name because they represent possible values for the same variable, you are going to have a situation of multiple values being sent back to the server. Under normal conditions, only the last one processed will be saved in the array. There is an easy work around for this.

To submit multiple values from a single field name to PHP end the field name with square brackets. To avoid URL encoding problems, the `POST` method is preferred. PHP will recognize that the values are a set of value and create an array to store them. The value of the `$_POST[]` array element by that name will be an array containing those values, i.e., a nested array.

```html
<form method="POST" action="myscript.php?flag=yes">
    <p>
    <input type="checkbox" name="field1[]" value="1">
    Sample 1
    <br>

    <input type="checkbox" name="field1[]" value="2">
    Sample 2
    <br>

    <input type="checkbox" name="field1[]" value="3">
    Sample 3 </p>
    [...]
```

The above form fields will generate an array that will be stored in `$_POST["field1"]` with a value stored for each one selected. The first value could be accessed with `$_POST["field1"][0]` or by assigning the element value to another array and accessing that.

```php
$field1Arr = $_POST["field1"];
$firstVal = $field1Var[0];
```

### Practicing Safe Data Processing

When working with user supplied data, you need to be aware of the fact that you are opening yourself up to attacks from malicious users and mistakes by users who are going to use your program in unexpected and sometimes downright silly ways. You need to be able take this into account when you code.

Coding for users who don't know what they are doing is a simple matter of thinking through the process carefully, providing clear directions, and testing everything to make sure the directions are followed. This is a guiding principle of good software design. Unfortunately, this is not the place for a detailed looked at best practices in GUI interface design. It is really a field of study in and of itself.

So, for now, let us say, make sure forms are clear, comprehensible and easy to use, and test everything coming back from the client for every eventuality. Then ask other people to try and break your code. You know how your code is supposed to work. Others have a much better chance of breaking it.

Instead we are going to look at how to reduce attacks on your system, intentional and accidental, instigated through HTML forms processing code. The biggest hazard involves posting files to the server, which we discuss elsewhere. For now we will focus on two issues:

- Users sending malicious code through HTML forms fields
- Users spoofing HTML form fields.

### Bad Data

It is possible for a user to send bad data through form fields. Properly conceived, this can be used to get confidential information back from the server or hack into the system.

The first step to avoiding this is to make sure that `register_globals` is not enabled. This is discussed below. The next step is to make sure there aren't any commands in the data being sent that could be accidentally executed by PHP.

We can get rid of most commands in content being sent to the server simply by getting rid of the angle brackets, since a PHP command would need to begin with `<?php` for it to execute. We can do this with the `htmlSpecialChars()` function. It takes a string as an argument and returns the string with all HTML special characters converted to their special character equivalents. Thus `<` becomes `&lt;` and so on. This will take care of most potential attacks.

It is, of course, preferable to not let users execute any commands on your system, but this is not always possible. Don't be afraid to test user data for every eventuality and to restrict it to clearly defined sets of values. Both of these make your security job easier.

### Form Field Spoofing

Users, with some clever coding, can send data to your server, which spoof a form submission from the page but contain field names that are not part of the form. This may seem pointless, but can be used to override system variables and thus allow them to hack into the server. For instance, by getting the server to echo out the password file.

The simplest solution to this is to make sure that `register_globals` is turned off in the PHP initialization file. For newer version of PHP this is the default. Registering globals is the process of taking all the values in the global arrays and assigning them to variables whose names match the index keys of those elements in their respective arrays.

When it comes right down to it, the only reason for having an automated process for registering globals is laziness. It is not worth the security risk. So, don't enable `register_globals`.

Even with `register_globals` turned off, it still pays to screen the input for spoofed fields. The best way to do this is only allow user data to be written to variables that already exist. You can do this by explicitly initializing the variables in your code than only accepting content from the user data arrays that are associated with variables that already exist in the code. The code would look something like this:

```php
$formField1 = '';

foreach ($_POST as $key => $value) {
    if (isset(${$key}) {
        ${$key} = $value;
    }
}
```

## Putting It All Together
Here is a simple example that takes everything that we have discussed and puts it all together. We have arrays, we have control structures, we use SUPER GLOBALS. What more could you ask for!

```php
<?php
// created by Brian Levin
if (isset($_POST['submit'])) {
    $first_name = $_POST["first_name"];
    $last_name  = $_POST["last_name"];
} else {
    $first_name = "";
    $last_name  = "";
}

$form_layout = <<< EOD
<p>
<form method="post" action="">
First Name: <input type="text" name="first_name">
<br>Last Name: <input type="text" name="last_name">
<br><input type="submit" value="submit" name="submit">
</form>
</p>

EOD;

$form_results = "<p> \nFirst Name: " . $first_name . "<br> \nLast Name: " . $last_name . "<br>\n</p>\n";

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
    // display the output
    echo $form_results;
}
?>

</body>
</html>
```
