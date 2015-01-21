# What is the area of a circle?

----

# $$ A=\pi r^2 $$

----

# How do we translate this to PHP?

----

```php
function areaOfACircle($radius)
{
    echo pow($radius, 2) * pi();
}
```
^ Return type?

----

# Can we talk about code conventions?

http://www.php-fig.org/psr/psr-2/

^ Specifically talk about naming conventions

----

# Naming Conventions

- Classes are Pascal Case `AVeryLongClassName`
- Functions and methods are Camel Case `aVeryLongFunctionName`
- Variables are underscored `a_very_long_variable_name`

----

# Idiomatic Variable Naming
