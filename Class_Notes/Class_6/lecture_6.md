# Lecture 6

<!--TOC-->

## Importing External Files

PHP provides two constructs to load code and HTML from another module: require and include. Both load a file as the PHP script runs, work in conditionals and loops, and complain if the file being loaded cannot be found. The main difference is that attempting to require a nonexistent file is a fatal error, while attempting to include such a file produces a warning but does not stop script execution.

A common use of include is to separate page-specific content from general site design. Common elements such as headers and footers go in separate HTML files, and each page then looks like:

```php
<?php include "header.html"; ?>
content
<?php include "footer.html"; ?>
```

We use include because it allows PHP to continue to process the page even if there's an error in the site design file(s). The require construct is less forgiving and is more suited to loading code libraries, where the page cannot be displayed if the libraries do not load. For example:

```php
require "codelib.php";
mysub();               // defined in codelib.php
```

A marginally more efficient way to handle headers and footers is to load a single file and then call functions to generate the standardized site elements:

```
<?php require "design.php";
header(); ?>
content
<?php footer();
```


If PHP cannot parse some part of a file added by include or require, a warning is printed and execution continues. You can silence the warning by prepending the call with the silence operator (`@`) for example, `@include`.

If the `allow_url_fopen` option is enabled through PHP's configuration file, `php.ini`, you can include files from a remote site by providing a URL instead of a simple local path:

```
include "http://www.example.com/codelib.php";
```

If the filename begins with `http://` or `ftp://`, the file is retrieved from a remote site and loaded. Files included with include and require can be arbitrarily named. Common extensions are `.php`, .`php5`, and `.html`. Note that remotely fetching a file that ends in .php from a web server that has PHP enabled fetches the output of that PHP script, it executes the PHP code in that file.

If a program uses include or require to include the same file twice (mistakenly done in a loop, for example), the file is loaded and the code is run, or the HTML is printed twice. This can result in errors about the redefinition of functions, or multiple copies of headers or HTML being sent. To prevent these errors from occurring, use the include_once and require_once constructs. They behave the same as include and require the first time a file is loaded, but quietly ignore subsequent attempts to load the same file. For example, many page elements, each stored in separate files, need to know the current user's preferences. The element libraries should load the user preferences library with require_once. The page designer can then include a page element without worrying about whether the user preference code has already been loaded.

Code in an included file is imported at the scope that is in effect where the include statement is found, so the included code can see and alter your code's variables. This can be useful for instance, a user tracking library might store the current user's name in the global $user variable:

```
// main page
include "userprefs.php";
echo "Hello, {$user}.";
```

The ability of libraries to see and change your variables can also be a problem. You have to know every global variable used by a library to ensure that you don't accidentally try to use one of them for your own purposes, thereby overwriting the library's value and disrupting how it works. If the include or require construct is in a function, the variables in the included file become function-scope variables for that function.

Because include and require are keywords, not real statements, you must always enclose them in curly braces in conditional and loop statements:

```
for ($i = 0; $i < 10; $i++) {
  include "repeated_element.html";
}
```

Use the `get_included_files()` function to learn which files your script has included or required. It returns an array containing the full system path filenames of each included or required file. Files that did not parse are not included in this array.

## Objects
### Introduction
Object-oriented programming (OOP) opens the door to cleaner designs, easier maintenance, and greater code reuse. The proven value of OOP is such that few today would dare to introduce a language that wasn't object-oriented. PHP supports many useful features of OOP, and this chapter shows you how to use them.

OOP acknowledges the fundamental connection between data and the code that works on that data, and it lets you design and implement programs around that connection. For example, a content management system usually keeps track of many users. In a procedural programming language, each user would be a data structure, and there would probably be a set of functions that work with users' data structures (create the new users, get their information, etc.). In an object-oriented programming language, each user would be an object (a data structure with attached code). The data and the code are still there, but they're treated as an inseparable unit.

The object, as union of code and data, is the modular unit for application development and code reuse.

### Terminology

Every object-oriented language seems to have a different set of terms for the same old concepts. This section describes the terms that PHP uses, but be warned that in other languages these terms may have other meanings.

Let's use the example of the users of a content management system. You need to keep track of the same information for each user, and the same functions can be called on each user's data structure. When you design the program, you decide the fields for each user and come up with the functions. In OOP terms, you're designing the user class. A class is a template for building objects. An object is an instance (or occurrence) of a class. In this case, it's an actual user data structure with attached code.

Objects and classes are a bit like values and data types. There's only one integer data type, but there are many possible integers. Similarly, your program defines only one user class but can create many different (or identical) users from it. The data associated with an object are called its properties. The functions associated with an object are called its methods. When you define a class, you define the names of its properties and give the code for its methods.

Debugging and maintenance of programs is much easier if you use encapsulation. This is the idea that a class provides certain methods (the interface) to the code that uses its objects, so the outside code does not directly access the data structures of those objects. Debugging is thus easier because you know where to look for bugs (the only code that changes an object's data structures is within the class) and maintenance is easier because you can swap out implementations of a class without changing the code that uses the class, as long as you maintain the same interface.

Any nontrivial object-oriented design probably involves inheritance. This is a way of defining a new class by saying that it's like an existing class, but with certain new or changed properties and methods. The old class is called the superclass (or parent or base class), and the new class is called the subclass (or derived class). Inheritance is a form of code reuse (the base) class code is reused instead of being copied and pasted into the new class. Any improvements or modifications to the base class are automatically passed on to the derived class.

### Static Class vs Instantiated Object

A static class is essentially an object container for variables and functions. An instantiated class is a variable containing an object. An instantiated class must be assigned to a variable.  There can only be one static class. There can be many instance of an instantiated class.

The simplest way to consider things might be :

- Use an instantiated class where each object has data on its own (like a user has a name).
- Use a static class when it's just a tool that works on other stuff (like, for instance, repetitious code snippets or a syntax checker).

### Creating an Object
It's much easier to create objects and use them than it is to define object classes, so before we discuss how to define classes, let's look at creating objects. To create an object of a given class, use the new keyword:

```php
$object = new Class;
```

Assuming that a Person class has been defined, here's how to create a Person object:

```php
$rasmus = new Person;
```

Do not quote the class name, or you'll get a compilation error:

```
$rasmus = new "Person"; // does not work
```

Some classes permit you to pass arguments to the new call. The class's documentation should say whether it accepts arguments. If it does, you'll create objects like this:

```php
$object = new Person("Fred", 35);
```

The class name does not have to be hard-coded into your program. You can supply the class name through a variable:

```php
$class = "Person";
$object = new $class;
// is equivalent to
$object = new Person;
```

Specifying a class that doesn't exist causes a runtime error. Variables containing object references are just normal variables (they can be used in the same ways as other variables). Note that variable variables work with objects, as shown here:

```php
$account = new Account;
$object = "account";
${$object}->init(50000, 1.10);  // same as $account->init
```

### Accessing Properties and Methods
Once you have an object, you can use the -> notation to access methods and properties of the object:

```php
$object->propertyname $object->methodname([arg, ... ])
```

For example:

```php
echo "Rasmus is {$rasmus->age} years old.\n";   // property access
$rasmus->birthday();                            // method call
$rasmus->setAge(21);                            // method call with arguments
```

Methods act the same as functions (only specifically to the object in question), so they can take arguments and return a value:

```php
$clan = $rasmus->family("extended");
```

Within a class's definition, you can specify which methods and properties are publicly accessible and which are accessible only from within the class itself using the public and private access modifiers. You can use these to provide encapsulation.
You can use variable variables with property names:

```php
$prop = 'age';
echo $rasmus->$prop;
```

A static method is one that is called on a class, not on an object. Such methods cannot access properties. The name of a static method is the class name followed by two colons and the function name. For instance, this calls the p() static method in the HTML class:

```php
HTML::p("Hello, world");
```

When declaring a class, you define which properties and methods are static using the static access property.
Once created, objects are passed by reference that is, instead of copying around the entire object itself (a time and memory consuming endeavor), a reference to the object is passed around instead. For example:

```php
$f = new Person("Fred", 35);

$b = $f; // $b and $f point at same object
$b->setName("Barney");

printf("%s and %s are best friends.\n", $b->getName(), $f->getName());
```

>>> Barney and Barney are best friends.

If you want to create a true copy of an object, you use the clone operator:

```php
$f = new Person("Fred", 35);

$b = clone $f; // make a copy
$b->setName("Barney");// change the copy

printf("%s and %s are best friends.\n", $b->getName(), $f->getName());
```

>>>Fred and Barney are best friends.

When you use the clone operator to create a copy of an object and that class declares the __clone() method, that method is called on the new object immediately after it's cloned. You might use this in cases where an object holds external resources (such as file handles) to create new resources, rather than copying the existing ones.

## Declaring a Class

To design your program or code library in an object-oriented fashion, you'll need to define your own classes, using the class keyword. A class definition includes the class name and the properties and methods of the class. Class names are case-insensitive and must conform to the rules for PHP identifiers. The class name stdClass is reserved. Here's the syntax for a class definition:

```php
class classname [ extends baseclass ] [ implements interfacename ,
    [interfacename, ... ] ]
{
  [ use traitname, [ traitname, ... ]; ]

  [ visibility $property [ = value ]; ... ]

  [ function functionname (args) {
    // code
    }
    ...
  ]
}
```

#### Declaring Methods

A method is a function defined inside a class. Although PHP imposes no special restrictions, most methods act only on data within the object in which the method resides.

Within a method, the `$this` variable contains a reference to the object on which the method was called. For instance, if you call `$rasmus->birthday()`, inside the `birthday()` method, $this holds the same value as `$rasmus`. Methods use the `$this` variable to access the properties of the current object and to call other methods on that object.

Here's a simple class definition of the Person class that shows the $this variable in action:

```php
class Person
{
  public $name = '';

  function getName()
  {
    return $this->name;
  }

  function setName($newName)
  {
    $this->name = $newName;
  }
}
```

As you can see, the `getName()` and `setName() `methods use `$this` to access and set the $name property of the current object.
To declare a method as a static method, use the static keyword. Inside of static methods the variable $this is not defined. For example:

```php
class HTMLStuff
{
  static function startTable()
  {
    echo "<table border=\"1\">\n";
  }
  static function endTable()
  {
    echo "</table>\n";
  }
}

HTMLStuff::startTable();
  // print HTML table rows and columns
HTMLStuff::endTable();
If you declare a method using the final keyword, subclasses cannot override that method. For example:
class Person
{
  public $name;

  final function getName()
  {
    return $this->name;
  }
}

class Child extends Person
{
  // syntax error
  function getName()
  {
    // do something
  }
}
```

Using access modifiers, you can change the visibility of methods. Methods that are accessible outside methods on the object should be declared public; methods on an instance that can only be called by methods within the same class should be declared private. Finally, methods declared as protected can only be called from within the object's class methods and the class methods of classes inheriting from the class. Defining the visibility of class methods is optional; if a visibility is not specified, a method is public. For example, you might define:

```php
class Person
{
  public $age;

  public function __construct()
  {
    $this->age = 0;
  }

  public function incrementAge()
  {
    $this->age += 1;
    $this->ageChanged();
  }

  protected function decrementAge()
  {
    $this->age −= 1;
    $this->ageChanged();
  }

  private function ageChanged()
  {
    echo "Age changed to {$this->age}";
  }
}

class SupernaturalPerson extends Person
{
  public function incrementAge()
  {
    // ages in reverse
    $this->decrementAge();
  }
}

$person = new Person;
$person->incrementAge();
$person->decrementAge();   // not allowed
$person->ageChanged();     // also not allowed

$person = new SupernaturalPerson;
$person->incrementAge();   // calls decrementAge under the hood
```

You can use type hinting when declaring a method on an object:

```php
class Person
{
  function takeJob(Job $job)
  {
    echo "Now employed as a {$job->title}\n";
  }
}
```

#### Declaring Properties
In the previous definition of the Person class, we explicitly declared the $name property. Property declarations are optional and are simply a courtesy to whomever maintains your program. It's good PHP style to declare your properties, but you can add new properties at any time.
Here's a version of the Person class that has an undeclared $name property:
class Person
{
  function getName()
  {
    return $this->name;
  }

  function setName($newName)
  {
    $this->name = $newName;
  }
}
You can assign default values to properties, but those default values must be simple constants:

```php
public $name = "J Doe";      // works
public $age  = 0;            // works
public $day  = 60 * 60 * 24; // doesn't work
```

Using access modifiers, you can change the visibility of properties. Properties that are accessible outside the object's scope should be declared public; properties on an instance that can only be accessed by methods within the same class should be declared private. Finally, properties declared as protected can only be accessed by the object's class methods and the class methods of classes inheriting from the class. For example, you might declare a user class:

```php
class Person
{
  protected $rowId = 0;

  public $username = 'Anyone can see me';

  private $hidden = true;
}
```

In addition to properties on instances of objects, PHP allows you to define static properties, which are variables on an object class, and can be accessed by referencing the property with the class name. For example:

```php
class Person
{
  static $global = 23;
}

$localCopy = Person::$global;
```

Inside an instance of the object class, you can also refer to the static property using the self keyword, like `echo self::$global;`. If a property is accessed on an object that doesn't exist, and if the `__get()` or `__set()` method is defined for the object's class, that method is given an opportunity to either retrieve a value or set the value for that property. For example, you might declare a class that represents data pulled from a database, but you might not want to pull in large data values (such as BLOBs) unless specifically requested. One way to implement that, of course, would be to create access methods for the property that read and write the data whenever requested. Another method might be to use these overloading methods:

```php
class Person
{
  public function __get($property)
  {
    if ($property === 'biography') {
      $biography = "long text here..."; // would retrieve from database

      return $biography;
    }
  }

  public function __set($property, $value)
  {
    if ($property === 'biography') {
      // set the value in the database
    }
  }
}
```

#### Declaring Constants
Like global constants, assigned through the define() function, PHP provides a way to assign constants within a class. Like static properties, constants can be accessed directly through the class or within object methods using the self notation. Once a constant is defined, its value cannot be changed:

```php
class PaymentMethod
{
  const TYPE_CREDITCARD = 0;
  const TYPE_CASH = 1;
}

echo PaymentMethod::TYPE_CREDITCARD;
```

As with global constants, it is common practice to define class constants with uppercase identifiers.

#### Inheritance

To inherit the properties and methods from another class, use the extends keyword in the class definition, followed by the name of the base class:

```php
class Person
{
  public $name, $address, $age;
}

class Employee extends Person
{
  public $position, $salary;
}
```

The Employee class contains the `$position` and `$salary` properties, as well as the `$name`, $address, and `$age` properties inherited from the Person class. If a derived class has a property or method with the same name as one in its parent class, the property or method in the derived class takes precedence over the property or method in the parent class. Referencing the property returns the value of the property on the child, while referencing the method calls the method on the child.

To access an overridden method on an object's parent class, use the `parent::method()` notation:

```php
parent::birthday(); // call parent class's birthday() method
```

A common mistake is to hardcode the name of the parent class into calls to overridden methods:

```php
Creature::birthday(); // when Creature is the parent class
```

This is a mistake because it distributes knowledge of the parent class's name throughout the derived class. Using parent:: centralizes the knowledge of the parent class in the extends clause. If a method might be subclassed and you want to ensure that you're calling it on the current class, use the `self::method()` notation:

```php
self::birthday(); // call this class's birthday() method
```

To check if an object is an instance of a particular class or if it implements a particular interface (see the section Interfaces), you can use the instanceof operator:

```php
if ($object instanceof Animal) {
  // do something
}
```

#### Interfaces
Interfaces provide a way for defining contracts to which a class adheres; the interface provides method prototypes and constants, and any class that implements the interface must provide implementations for all methods in the interface. Here's the syntax for an interface definition:

```php
interface interfacename
{
  [ function functionname();
  ...
  ]
}
```

To declare that a class implements an interface, include the implements keyword and any number of interfaces, separated by commas:

```php
interface Printable
{
   function printOutput();
}

class ImageComponent implements Printable
{
  function printOutput()
  {
    echo "Printing an image...";
  }
}
```

An interface may inherit from other interfaces (including multiple interfaces) as long as none of the interfaces it inherits from declare methods with the same name as those declared in the child interface.

#### Traits

Traits provide a mechanism for reusing code outside of a class hierarchy. Traits allow you to share functionality across different classes that don't (and shouldn't) share a common ancestor in a class hierarchy. Here's the syntax for a trait definition:

```php
trait traitname [ extends baseclass ]
{
  [ use traitname, [ traitname, ... ]; ]

  [ visibility $property [ = value ]; ... ]

  [ function functionname (args) {
    // code
    }
    ...
  ]
}
```

To declare that a class should include a trait's methods, include the use keyword and any number of traits, separated by commas:

```php
trait Logger
{
  public function log($logString)
  {
    $className = __CLASS__;
    echo date("Y-m-d h:i:s", time()) . ": [{$className}] {$logString}";
  }
}

class User
{
  use Logger;

  public $name;

  function __construct($name = '')
  {
    $this->name = $name;
    $this->log("Created user '{$this->name}'");
  }

  function __toString()
  {
    return $this->name;
  }
}

class UserGroup
{
  use Logger;

  public $users = array();

  public function addUser(User $user)
  {
    if (!$this->includesUser($user)) {
      $this->users[] = $user;
      $this->log("Added user '{$user}' to group");
    }
  }
}

$group = new UserGroup;
$group->addUser(new User("Franklin"));

```
>>>2012-03-09 07:12:58: [User] Created user 'Franklin'
>>>2012-03-09 07:12:58: [UserGroup] Added user 'Franklin' to group

The methods defined by the Logger trait are available to instances of the UserGroup class as if they were defined in that class. Traits can be composed of other traits by including the use statement in the trait's declaration, followed by one or more trait names separated by commas, as shown here:

```php
trait First
{
  public function doFirst(
  {
    echo "first\n";
  }
}

trait Second
{
  public function doSecond()
  {
    echo "second\n";
  }
}

trait Third
{
  use First, Second;

  public function doAll()
  {
    $this->doFirst();
    $this->doSecond();
  }
}

class Combined
{
  use Third;
}

$object = new Combined;
$object->doAll();
```

>>>first
>>>second

Traits can declare abstract methods. If a class uses multiple traits defining the same method, PHP gives a fatal error. However, you can override this behavior by telling the compiler specifically which implementation of a given method you want to use. When defining which traits a class includes, use the `insteadof` keyword for each conflict:

```php
trait Command
{
  function run()
  {
    echo "Executing a command\n";
  }
}

trait Marathon
{
  function run()
  {
    echo "Running a marathon\n";
  }
}

class Person
{
  use Command, Marathon {
    Marathon::run insteadof Command;
  }
}

$person = new Person;
$person->run();
```

>>>Running a marathon

Instead of picking just one method to include, you can use the as keyword to alias a trait's method within a class including it to a different name. You must still explicitly resolve any conflicts in the included traits. For example:

```php
trait Command
{
  function run()
  {
    echo "Executing a command";
  }
}

trait Marathon
{
  function run()
  {
    echo "Running a marathon";
  }
}

class Person
{
  use Command, Marathon {
    Command::run as runCommand;
    Marathon::run insteadof Command;
  }
}

$person = new Person;
$person->run();
$person->runCommand();
```

>>>Running a marathon
>>>Executing a command

#### Abstract Methods

PHP also provides a mechanism for declaring that certain methods on the class must be implemented by subclasses the implementation of those methods is not defined in the parent class. In these cases, you provide an abstract method; in addition, if a class has any methods in it defined as abstract, you must also declare the class as an abstract class:

```php
abstract class Component
{
  abstract function printOutput();
}

class ImageComponent extends Component
{
  function printOutput()
  {
    echo "Pretty picture";
  }
}
```

Abstract classes cannot be instantiated. Also note that unlike some languages, you cannot provide a default implementation for abstract methods. Traits can also declare abstract methods. Classes that include a trait that defines an abstract method must implement that method:

```php
trait Sortable
{
  abstract function uniqueId();

  function compareById($object)
  {
    return ($object->uniqueId() < $this->uniqueId()) ? −1 : 1;
  }
}

class Bird
{
  use Sortable;

  function uniqueId()
  {
    return __CLASS__ . ":{$this->id}";
  }
}

class Car
{
  use Sortable;
}

// this will fatal
$bird = new Bird;
$car = new Car;
$comparison = $bird->compareById($card);
```

When implementing an abstract method in a child class, the method signatures must match that is, they must take in the same number of required parameters, and if any of the parameters have type hints, those type hints must match. In addition, the method must have the same or less restricted visibility.

#### Constructors
You may also provide a list of arguments following the class name when instantiating an object:
```php
$person = new Person("Fred", 35);
```

These arguments are passed to the class's constructor, a special function that initializes the properties of the class.
A constructor is a function in the class called `__construct()`. Here's a constructor for the Person class:

```php
class Person
{
  function __construct($name, $age)
  {
    $this->name = $name;
    $this->age  = $age;
  }
}
```

PHP does not provide for an automatic chain of constructors; that is, if you instantiate an object of a derived class, only the constructor in the derived class is automatically called. For the constructor of the parent class to be called, the constructor in the derived class must explicitly call the constructor. In this example, the Employee class constructor calls the Person constructor:

```php
class Person
{
  public $name, $address, $age;

  function __construct($name, $address, $age)
  {
    $this->name = $name;
    $this->address = $address;
    $this->age = $age;
  }
}

class Employee extends Person
{
  public $position, $salary;

  function __construct($name, $address, $age, $position, $salary)
  {
    parent::__construct($name, $address, $age);

    $this->position = $position;
    $this->salary = $salary;
  }
}
```

#### Destructors
When an object is destroyed, such as when the last reference to an object is removed or the end of the script is reached, its destructor is called. Because PHP automatically cleans up all resources when they fall out of scope and at the end of a script's execution, their application is limited. The destructor is a method called `__destruct()`:

```php
class Building
{
  function __destruct()
  {
    echo "A Building is being destroyed!";
  }
}
```

## Namespaces
If there is one modern PHP feature I want you to know, it is namespaces. Introduced in PHP 5.3.0, namespaces are an important tool that organizes PHP code into a virtual hierarchy, comparable to your operating system's filesystem directory structure. Each modern PHP component and framework organizes its code beneath its own globally unique vendor namespace so that it does not conflict with, or lay claim to, common class names used by other vendors.

Unlike your operating system's physical filesystem, PHP namespaces are a virtual concept and do not necessarily map 1:1 with filesystem directories. That being said, most PHP components do, in fact, map subnamespaces to filesystem directories for compatibility with the popular PSR-4 autoloader standard.

### Example from real life

Don't you hate it when you walk into a coffee shop and this one obnoxious person has a mess of books, cables, and whatnot spread across several tables? Not to mention he's sitting next to, but not using, the only available power outlet. He's wasting valuable space that could otherwise be useful to you. Figuratively speaking, this person is not using namespaces. Don't be this person.

### Why We Use Namespaces

Namespaces are important because they let us create sandboxed code that works alongside other developers' code. This is the cornerstone concept of the modern PHP component ecosystem. Component and framework authors build and distribute code for a large number of PHP developers, and they have no way of knowing or controlling what classes, interfaces, functions, and constants are used alongside their own code. This problem applies to your own in-house projects, too. If you write custom PHP components or classes for a project, that code must work alongside your project's third-party dependencies.

Library components, your code and other developers' code might use the same class, interface, function, or constant names. Without namespaces, a name collision causes PHP to fail. With namespaces, your code and other developers' code can use the same class, interface, function, or constant name assuming your code lives beneath a unique vendor namespace.

If you're building a tiny personal project with only a few dependencies, class name collisions probably won't be an issue. But when you're working on a team building a large project with numerous third-party dependencies, name collisions become a very real concern. You cannot control which classes, interfaces, functions, and constants are introduced into the global namespace by your project's dependencies. This is why namespacing your code is important.

### Declaration

Every PHP class, interface, function, and constant lives beneath a namespace (or subnamespace). Namespaces are declared at the top of a PHP file on a new line immediately after the opening `<?php` tag. The namespace declaration begins with namespace, then a space character, then the namespace name, and then a closing semicolon `;` character.

Remember that namespaces are often used to establish a top-level vendor name. This example namespace declaration establishes the CISS1152 vendor name:

```
<?php
namespace CISS1152;
```

All PHP classes, interfaces, functions, or constants declared beneath this namespace declaration live in the CISS1152 namespace and are, in some way, related to CISS1152. What if we wanted to organize code related to this lab? 

We use a subnamespace. Subnamespaces are declared exactly the same as in the previous example. The only difference is that we separate namespace and subnamespace names with the `\` character. The following example declares a subnamespace named Lab_6 that lives beneath the topmost CISS1152 vendor namespace:

```
<?php
namespace CISS1152\Lab_6;
```

All classes, interfaces, functions, and constants declared beneath this namespace declaration live in the `CISS1152\Lab_6` subnamespace and are, in some way, related to this class.

All classes in the same namespace or subnamespace don't have to be declared in the same PHP file. You can specify a namespace or subnamespace at the top of any PHP file, and that file's code becomes a part of that namespace or subnamespace. This makes it possible to write multiple classes in separate files that belong to a common namespace.

### Import and Alias

Before we had namespaces, PHP developers solved the name collision problem with Zend-style class names. This was a class-naming scheme popularized by the Zend Framework where PHP class names used underscores in lieu of filesystem directory separators. This convention accomplished two things: it ensured class names were unique, and it enabled a naive autoloader implementation that replaced underscores in PHP class names with filesystem directory separators to determine the class file path.

For example, the PHP class `Zend_Cloud_DocumentService_Adapter_WindowsAzure_Query` corresponds to the PHP file `Zend/Cloud/DocumentService/Adapter/WindowsAzure/Query.php`. A side effect of the Zend-style naming convention, as you can see, is absurdly long class names. Call me lazy, but there's no way I'm typing that class name more than once.

Modern PHP namespaces present a similar problem. For example, the full Response class name in the `symfony\httpfoundation` component is `\Symfony\Component\HttpFoundation\Response`. Fortunately, PHP lets us import and alias namespaced code.

By import, I mean that I tell PHP which namespaces, classes, interfaces, functions, and constants I will use in each PHP file. I can then use these without typing their full namespaces.

By alias, I mean that I tell PHP that I will reference an imported class, interface, function, or constant with a shorter name.

***TIP***
You can import and alias PHP classes, interfaces, and other namespaces as of PHP 5.3. You can import and alias PHP functions and constants as of PHP 5.6.
The code shown in the next example creates and sends a 400 Bad Request HTTP response without importing and aliasing.

**Namespace without alias**

```
<?php
$response = new \Symfony\Component\HttpFoundation\Response('Oops', 400);
$response->send();
```

This isn't terrible, but imagine you have to instantiate a Response instance several times in a single PHP file. Your fingers will get tired quickly. Now look at this example. It does the same thing with importing.


**Namespace with default alias**

```
<?php
use Symfony\Component\HttpFoundation\Response;

$response = new Response('Oops', 400);
$response->send();
```

We tell PHP we intend to use the `Symfony\Component\HttpFoundation\Response` class with the use keyword. We type the long, fully qualified class name once. Then we can instantiate the Response class without using its fully namespaced class name. How cool is that?

Some days I feel really lazy. This is a good opportunity to use an alias. Let's extend this example. Instead of typing Response, maybe I just want to type Res instead. The next example shows how I can do that.

**Namespace with custom alias**

```
<?php
use Symfony\Component\HttpFoundation\Response as Res;

$r = new Res('Oops', 400);
$r->send();
```

In this example, I changed the import line to import the Response class. I also appended as Res to the end of the import line; this tells PHP to consider Res an alias for the Response class. If we don't append the as Res alias to the import line, PHP assumes a default alias that is the same as the imported class name.

***TIP***
You should import code with the use keyword at the top of each PHP file, immediately after the opening `<?php` tag or namespace declaration.
You don't need a leading `\` character when importing code with the use keyword because PHP assumes imported namespaces are fully qualified. The use keyword must exist in the global scope (i.e., not inside of a class or function) because it is used at compile time. It can, however, be located beneath a namespace declaration to import code into another namespace.

As of PHP 5.6, it's possible to import functions and constants. This requires a tweak to the use keyword syntax. To import a function, change use to use func:

```
<?php
use func Namespace\functionName;

functionName();
To import a constant, change use to use constant:
<?php
use constant Namespace\CONST_NAME;

echo CONST_NAME;
```

Function and constant aliases work the same as classes.

#### Multiple imports

If you import multiple classes, interfaces, functions, or constants into a single PHP file, you'll end up with multiple use statements at the top of your PHP file. PHP accepts a shorthand import syntax that combines multiple use statements on a single line like this:

```
<?php
use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Cookie;
```

Don't do this. It's confusing and easy to mess up. I recommend you keep each use statement on its own line like this:

```
<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
```

You'll type a few extra characters, but your code is easier to read and troubleshoot.

#### Multiple namespaces in one file

PHP lets you define multiple namespaces in a single PHP file like this:

```
<?php
namespace Foo {
    // Declare classes, interfaces, functions, and constants here
}

namespace Bar {
    // Declare classes, interfaces, functions, and constants here
}
```

This is confusing and violates the recommended one class per file good practice. Use only one namespace per file to make your code simpler and easier to troubleshoot.

#### Global namespace
If you reference a class, interface, function, or constant without a namespace, PHP assumes the class, interface, function, or constant lives in the current namespace. If this assumption is wrong, PHP attempts to resolve the class, interface, function, or constant. If you need to reference a namespaced class, interface, function, or constant inside another namespace, you must use the fully qualified PHP class name (namespace + class name). You can type the fully qualified PHP class name, or you can import the code into the current namespace with the use keyword.

Some code might not have a namespace and, therefore, lives in the global namespace. The native Exception class is a good example. You can reference globally namespaced code inside another namespace by prepending a `\` character to the class, interface, function, or constant name. For example, the `\My\App\Foo::doSomething()` method in the next example fails because PHP searches for a `\My\App\Exception` class that does not exist.

**Unqualified class name inside another namespace**

```
<?php
namespace My\App;

class Foo
{
    public function doSomething()
    {
        $exception = new Exception();
    }
}
```

Instead, add a `\` prefix to the Exception class name, as shown in the next example. This tells PHP to look for the Exception class in the global namespace instead of the current namespace.

**Qualified class name inside another namespace**

```
<?php
namespace My\App;

class Foo
{
    public function doSomething()
    {
        throw new \Exception();
    }
}
```
