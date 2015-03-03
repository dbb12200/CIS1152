# Lecture 6

<!--TOC-->

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
public $name = "J Doe";      // works
public $age  = 0;            // works
public $day  = 60 * 60 * 24; // doesn't work
Using access modifiers, you can change the visibility of properties. Properties that are accessible outside the object's scope should be declared public; properties on an instance that can only be accessed by methods within the same class should be declared private. Finally, properties declared as protected can only be accessed by the object's class methods and the class methods of classes inheriting from the class. For example, you might declare a user class:
class Person
{
  protected $rowId = 0;

  public $username = 'Anyone can see me';

  private $hidden = true;
}
In addition to properties on instances of objects, PHP allows you to define static properties, which are variables on an object class, and can be accessed by referencing the property with the class name. For example:
class Person
{
  static $global = 23;
}

$localCopy = Person::$global;
Inside an instance of the object class, you can also refer to the static property using the self keyword, like echo self::$global;.
If a property is accessed on an object that doesn't exist, and if the __get() or __set() method is defined for the object's class, that method is given an opportunity to either retrieve a value or set the value for that property.
For example, you might declare a class that represents data pulled from a database, but you might not want to pull in large data values—such as BLOBs—unless specifically requested. One way to implement that, of course, would be to create access methods for the property that read and write the data whenever requested. Another method might be to use these overloading methods:
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
Declaring Constants
Like global constants, assigned through the define() function, PHP provides a way to assign constants within a class. Like static properties, constants can be accessed directly through the class or within object methods using the self notation. Once a constant is defined, its value cannot be changed:
class PaymentMethod
{
  const TYPE_CREDITCARD = 0;
  const TYPE_CASH = 1;
}

echo PaymentMethod::TYPE_CREDITCARD;

0
As with global constants, it is common practice to define class constants with uppercase identifiers.
Inheritance
To inherit the properties and methods from another class, use the extends keyword in the class definition, followed by the name of the base class:
class Person
{
  public $name, $address, $age;
}

class Employee extends Person
{
  public $position, $salary;
}
The Employee class contains the $position and $salary properties, as well as the $name, $address, and $age properties inherited from the Person class.
If a derived class has a property or method with the same name as one in its parent class, the property or method in the derived class takes precedence over the property or method in the parent class. Referencing the property returns the value of the property on the child, while referencing the method calls the method on the child.
To access an overridden method on an object's parent class, use the parent::method() notation:
parent::birthday(); // call parent class's birthday() method
A common mistake is to hardcode the name of the parent class into calls to overridden methods:
Creature::birthday(); // when Creature is the parent class
This is a mistake because it distributes knowledge of the parent class's name throughout the derived class. Using parent:: centralizes the knowledge of the parent class in the extends clause.
If a method might be subclassed and you want to ensure that you're calling it on the current class, use the self::method() notation:
self::birthday(); // call this class's birthday() method
To check if an object is an instance of a particular class or if it implements a particular interface (see the section Interfaces), you can use the instanceof operator:
if ($object instanceof Animal) {
  // do something
}
Interfaces
Interfaces provide a way for defining contracts to which a class adheres; the interface provides method prototypes and constants, and any class that implements the interface must provide implementations for all methods in the interface. Here's the syntax for an interface definition:
interface interfacename
{
  [ function functionname();
  ...
  ]
}
To declare that a class implements an interface, include the implements keyword and any number of interfaces, separated by commas:
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
An interface may inherit from other interfaces (including multiple interfaces) as long as none of the interfaces it inherits from declare methods with the same name as those declared in the child interface.
Traits
Traits provide a mechanism for reusing code outside of a class hierarchy. Traits allow you to share functionality across different classes that don't (and shouldn't) share a common ancestor in a class hierarchy. Here's the syntax for a trait definition:
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
To declare that a class should include a trait's methods, include the use keyword and any number of traits, separated by commas:
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

2012-03-09 07:12:58: [User] Created user 'Franklin'
2012-03-09 07:12:58: [UserGroup] Added user 'Franklin' to group
The methods defined by the Logger trait are available to instances of the UserGroup class as if they were defined in that class.
Traits can be composed of other traits by including the use statement in the trait's declaration, followed by one or more trait names separated by commas, as shown here:
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

first
second
Traits can declare abstract methods.
If a class uses multiple traits defining the same method, PHP gives a fatal error. However, you can override this behavior by telling the compiler specifically which implementation of a given method you want to use. When defining which traits a class includes, use the insteadof keyword for each conflict:
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

Running a marathon
Instead of picking just one method to include, you can use the as keyword to alias a trait's method within a class including it to a different name. You must still explicitly resolve any conflicts in the included traits. For example:
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

Running a marathon
Executing a command
Abstract Methods
PHP also provides a mechanism for declaring that certain methods on the class must be implemented by subclasses—the implementation of those methods is not defined in the parent class. In these cases, you provide an abstract method; in addition, if a class has any methods in it defined as abstract, you must also declare the class as an abstract class:
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
Abstract classes cannot be instantiated. Also note that unlike some languages, you cannot provide a default implementation for abstract methods.
Traits can also declare abstract methods. Classes that include a trait that defines an abstract method must implement that method:
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
When implementing an abstract method in a child class, the method signatures must match—that is, they must take in the same number of required parameters, and if any of the parameters have type hints, those type hints must match. In addition, the method must have the same or less-restricted visibility.
Constructors
You may also provide a list of arguments following the class name when instantiating an object:
$person = new Person("Fred", 35);
These arguments are passed to the class's constructor, a special function that initializes the properties of the class.
A constructor is a function in the class called __construct(). Here's a constructor for the Person class:
class Person
{
  function __construct($name, $age)
  {
    $this->name = $name;
    $this->age  = $age;
  }
}
PHP does not provide for an automatic chain of constructors; that is, if you instantiate an object of a derived class, only the constructor in the derived class is automatically called. For the constructor of the parent class to be called, the constructor in the derived class must explicitly call the constructor. In this example, the Employee class constructor calls the Person constructor:
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
Destructors
When an object is destroyed, such as when the last reference to an object is removed or the end of the script is reached, its destructor is called. Because PHP automatically cleans up all resources when they fall out of scope and at the end of a script's execution, their application is limited. The destructor is a method called __destruct():
class Building
{
  function __destruct()
  {
    echo "A Building is being destroyed!";
  }
}
