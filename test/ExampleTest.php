<?php

class ExampleTest extends \PHPUnit\Framework\TestCase

{
    public function testExample()
    {
        $string1 = 'hello';
        $string2 = 'world';

        $this->assertSame($string1, $string2);
    }

}
