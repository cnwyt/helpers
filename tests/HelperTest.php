<?php

namespace Cnwyt\Helpers\Tests;

use PHPUnit\Framework\TestCase;

final class HelperTest extends TestCase
{
    public function testIndex()
    {
        $this->assertTrue(true);
    }

     public function testFormatPrice()
     {
         $price = '5.3456';
         $result = \Cnwyt\Helpers\format_price($price);
         var_dump($result);

         $this->assertEquals('5.30', $result);
         $this->assertEquals('5.30', $result);

         $price = '6.68';
         $result = \Cnwyt\Helpers\format_price($price);
         var_dump($result);

         $price = '12346';
         $result = \Cnwyt\Helpers\format_price($price);
         var_dump($result);
     }

}