<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ClassNamesTest extends TestCase
{
    /** @test */
    public function can_take_single_string_param()
    {
        $data = 'test-class';

        $actual = classNames($data);
        $expected = 'test-class';

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function can_take_an_array_param()
    {
        $data = [
            'test-class',
            'test-condition-class' => true,
            'test-false-condition-class' => false
        ];

        $actual = classNames($data);
        $expected = 'test-class test-condition-class';

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function can_take_multiple_params()
    {
        $actual = classNames('test1', ['test2' => true, 'test3' => false], 'test4');
        $expected = 'test1 test2 test4';

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function can_handle_erroneous_values()
    {
        $example = new ExampleObject('object-test');

        $actual = classNames('null', null, 0, false, 1.5, new \stdClass(), function () {}, $example);
        $expected = 'null 1.5 object-test';

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function can_handle_no_args()
    {
        $actual = classNames();
        $expected = '';

        $this->assertSame($expected, $actual);
    }
}

class ExampleObject {

    function __construct($value)
    {
        $this->stringVal = $value;
    }

    function __toString()
    {
        return $this->stringVal;
    }
}
