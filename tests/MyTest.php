<?php

use PHPUnit\Framework\TestCase;//Every test class must be a child of TestCase class for testing

class MyTest extends TestCase {

    public function testFirstAssertion(){
        $this->assertTrue(true);
    }
}
