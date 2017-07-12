<?php

/**
 *
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 *
 * For the full copyright and license information, please view the file LICENSE that was distributed with this source code.
 */
namespace Endrsmar\Enum\Tests;

include 'bootstrap.php';

use PHPUnit\Framework\TestCase;
use Endrsmar\Enum\Enum;

/**
 * @author Martin Endršt <endrst.martin@gmail.com>
 */
class EnumTest extends TestCase {
    
    public function testCreation() {
        $this->assertEquals(TestEnumA::class, get_class(TestEnumA::NAME_A()));
        $this->assertEquals(TestEnumB::class, get_class(TestEnumB::NAME_A()));
    }
    
    public function testNameValue() {
        $enum = TestEnumA::NAME_A();
        $this->assertEquals('NAME_A', $enum->getName());
        $this->assertEquals(TestEnumA::NAME_A, $enum->getValue());
    }
    
    public function testEquals() {
        $enum_a = TestEnumA::NAME_A();
        $enum_b = TestEnumB::NAME_A();
        $this->assertTrue($enum_a->is(new TestEnumA(TestEnumA::NAME_A)));
        $this->assertTrue($enum_a->is(TestEnumA::NAME_A));
        $this->assertTrue(!$enum_a->is($enum_b));
        $this->assertTrue(!$enum_a->is(TestEnumA::NAME_B));
    }
    
    public function testValidNameValue() {
        $this->assertTrue(TestEnumA::isValidName('NAME_A'));
        $this->assertTrue(TestEnumA::isValidValue(TestEnumA::NAME_A));
        $this->assertTrue(!TestEnumA::isValidName('NAME_C'));
        $this->assertTrue(!TestEnumA::isValidValue('c'));
    }
    
    public function testNameForValueOf() {
        $this->assertEquals('NAME_A', TestEnumA::nameFor(TestEnumA::NAME_A));
        $this->assertEquals(TestEnumA::NAME_A, TestEnumA::valueOf('NAME_A'));
    }
    
    public function testAsArray() {
        $arr = ['NAME_A' => 'a', 'NAME_B' => 'b'];
        $this->assertEquals($arr, TestEnumA::asArray());
    }
    
    public function testNullNameValid() {
        $this->assertTrue(TestEnumNull::isValidName('NAME_NULL'));
        $this->assertEquals('NAME_NULL', TestEnumNull::nameFor(NULL));
    }
    
    public function testGetNameGetValue() {
        $enum = TestEnumA::NAME_A();
        $this->assertEquals('NAME_A', $enum->getName());
        $this->assertEquals(TestEnumA::NAME_A, $enum->getValue());
    }
    
}

/**
 * @method static TestEnumA NAME_A()
 * @method static TestEnumA NAME_B()
 */
class TestEnumA extends Enum {
    
    const NAME_A = 'a';
    const NAME_B = 'b';
    
}

/**
 * @method static TestEnumB NAME_A()
 * @method static TestEnumB NAME_B()
 */
class TestEnumB extends Enum {
    
    const NAME_A = 'a';
    const NAME_B = 'b';
    
}

/**
 * @method static TestEnumNull NAME_NULL()
 */
class TestEnumNull extends Enum {
    
    const NAME_NULL = NULL;
    
}
