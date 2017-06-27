<?php

/*
 * This file is part of symball/validation-test-case
 * 
 * (c) symball <http://simonball.me>
 * 
 * For the full copyright and license information, please view the LICENSE file 
 * that was distributed with this source code.
 */

namespace Symball\ValidationTestCase;

use PHPUnit\Framework\TestCase;
/**
 * A PHPUnit test case for use with the Symfony validation service
 *
 * @author Simon Ball <simonball at simonball dot me>
 */
abstract class BaseValidationTestCase extends TestCase {
    
    /**
     *  @var $validator Symfony\Component\Validator\ValidatorInterface
     */
    protected $validator;
    
    /**
     * @var $errors Symfony\Component\Validator\ConstraintViolationListInterface 
     */
    protected $errors;
    
    /**
     * Run Symfony validation over a given object
     * 
     * @param object $object The class to have validation run over it
     * @return object Symfony\Component\Validator\ConstraintViolationListInterface 
     */
    protected function validate($object)
    {
        // Perform a basic check on the input to be tested
        if (!is_object($object)) {
            $this->fail('Can only validate objects, '.gettype($object).' supplied.');
        }
        
        // Set to object for later use and return the result
        $this->errors = $this->validator->validate($object);
        return $this->errors;
    }
    
    /**
     * Try to return the constraint for a given field
     * 
     * @param string $field The class property to try and return
     * @return object Symfony\Component\Validator\ConstraintViolation
     */
    protected function getField($field)
    {
        foreach ($this->errors as $error) {
            if ($error->getPropertyPath() == $field) {
                return $error;
            }
        }
        
        // If reached here, the field was not present so fail
        $this->fail($field.' was not found in the error array');
    }
    
    /**
     * Make a PHPUnit assertion that no errors were found
     */
    protected function assertValidationPass()
    {
        $this->assertEquals(0, count($this->errors));
    }
    
    /**
     * Make an assertion that a given property is required but was not supplied
     * 
     * @param string $field The object parameter
     */
    protected function assertBlankError($field)
    {
        $field = $this->getField($field);
        $this->assertContains('This value should not be blank.', $field->getMessageTemplate());        
    }
    
    /**
     * Make an assertion that a given property has a custom error message and failed
     * 
     * @param string $field The object parameter
     * @param string $message Part of the error message response to be checked
     */
    protected function assertCustomError($field, $message)
    {
        $field = $this->getField($field);
        $this->assertContains($message, $field->getMessageTemplate());        
    }
    
    /**
     * Return the ConstraintViolationList
     * 
     * @return object Symfony\Component\Validator\ConstraintViolationListInterface
     */
    protected function getErrors()
    {
        return $this->errors;
    }
}
