Validation Test Case
====================

This package provides a PHPUnit compatible Test case to be used with the Symfony Validation service with the aim of saving you some time and simplifying test creation.


Installation
------------

Require the bundle with Composer
``` bash
composer require symball/validation-test-case
```
Usage
-----

Currently, this package only supports using the annotations method of declaring validation for a class but, there is an interface which needs only a setUp function to adapt for wider usage.

``` php
// Replace the PHPUnit TestCase with the following
use Symball\ValidationTestCase\AnnotatedValidationTestCase;

// class declaration
class YourTest extends AnnotatedValidationTestCase
{

}
```

Now, within your tests, you should do the following

``` php
// Validate a given object
$this->validate($yourObject);

// Check that everything passed OK
$this->assertValidationPass();

// Check that a required field was caught
$this->assertBlankError('theObjectProperty');

// Check that a field failed validation with a custom error
$this->assertCustomError('theObjectProperty');

// Retrieve the ConstraintViolationList
$errors = $this->getErrors();
```