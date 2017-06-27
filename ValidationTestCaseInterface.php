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

/**
 * Interface for definition of class that will setup a Symfony validation object
 *
 * @author Simon Ball <simonball at simonball dot me>
 */
interface ValidationTestCaseInterface {
    public function setUp();
}
