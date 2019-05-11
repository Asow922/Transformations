<?php

namespace App\Metamodel\Utils;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArrayUtilTest extends KernelTestCase
{

    public function testRemoveFromArray()
    {
        static::createKernel();
        $el1 = 'element 1';
        $el2 = 'element 2';
        $el3 = 'element 3';

        $testArray = [
            $el1,
            $el2,
            $el3,
        ];

        $resultArray = [
            $el1,
            $el3,
        ];

        $this->assertNotEquals($testArray, $resultArray);

        ArrayUtil::removeFromArray($testArray, $el2);

        $this->assertEquals(count($testArray), count($resultArray));
        $this->assertEquals($testArray, $resultArray);
    }
}
