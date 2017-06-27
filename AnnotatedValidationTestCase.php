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

use Symfony\Component\Validator\Validation;
use Symball\ValidationTestCase\BaseValidationTestCase;
use Symball\ValidationTestCase\ValidationTestCaseInterface;
/**
 * For use with the annotation constraint handler
 *
 * @author Simon Ball <open dash source at simonball dot me>
 */
abstract class AnnotatedValidationTestCase extends BaseValidationTestCase implements ValidationTestCaseInterface
{
    /**
     * Setup the validation service with support for annotations
     */
    public function setUp()
    {
            $this->validator = Validation::createValidatorBuilder()
        ->enableAnnotationMapping()
        ->getValidator();
    }
    
           
}
