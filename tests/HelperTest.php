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
        $this->assertEquals('5.30', $result);
        $this->assertEquals('5.30', $result);

        $price = '6.68';
        $result = \Cnwyt\Helpers\format_price($price);
        $this->assertEquals('6.7', $result);

        $price = '12346';
        $result = \Cnwyt\Helpers\format_price($price);
        $this->assertEquals('12346', $result);
    }

    public function testIsPhoneNumber()
    {
        $this->assertFalse(\Cnwyt\Helpers\is_phone_number('12345678901'));
        $this->assertFalse(\Cnwyt\Helpers\is_phone_number('02182838284'));
        $this->assertTrue(\Cnwyt\Helpers\is_phone_number('18513622082'));
        $this->assertTrue(\Cnwyt\Helpers\is_phone_number('19513622082'));
        $this->assertTrue(\Cnwyt\Helpers\is_phone_number('14913622082'));
    }

    public function testIsValidUrlAndEmail()
    {
        $str = 'cnwyt@outlook.com';
        $result = \Cnwyt\Helpers\is_valid_email($str);
        $this->assertTrue($result);

        $str = 'cnwyt@outlookcom';
        $result = \Cnwyt\Helpers\is_valid_email($str);
        $this->assertFalse($result);

        $str = 'https://wx.wang123.net/useragent?src=test';
        $result = \Cnwyt\Helpers\is_valid_url($str);
        $this->assertTrue($result, 'ERROR: the url is valid.');

        $str = 'wx.wang123.net/useragent?src=test';
        $result = \Cnwyt\Helpers\is_valid_url($str);
        $this->assertFalse($result, 'ERROR: the url is invalid.');
    }

    public function testGetFuzzyName()
    {
        $str = 'cnwyt@outlook.com';
        $result = \Cnwyt\Helpers\get_fuzzy_name($str);
        $this->assertEquals('cn***om', $result);

        $str = '会飞的小鸟';
        $result = \Cnwyt\Helpers\get_fuzzy_name($str);
        $this->assertEquals('会飞***小鸟', $result);

        $str = '宋江';
        $result = \Cnwyt\Helpers\get_fuzzy_name($str);
        $this->assertEquals('宋***', $result);
    }


    public function testGetRandPrize()
    {
        $prizeArr = [
            0 => ['name' => '未中奖', 'probability' => '50'],
            1 => ['name' => '积分', 'probability' => '200'],
            2 => ['name' => '50元购物卡', 'probability' => '300'],
            3 => ['name' => '100元优惠券', 'probability' => '400'],
        ];
        $result = \Cnwyt\Helpers\get_rand_prize($prizeArr);
        $this->assertGreaterThan(0, $result);
    }

}