<?php

namespace Cnwyt\Helpers;

if (! function_exists('get_version')) {
    function get_version()
    {
        return '0.0.1';
    }
}

/*
 * 格式化显示价格，保留2位小数，第二位小数为0(只精确到角)
 */
if (!function_exists('format_price')) {
    /**
     * @param int $price
     *
     * @return int|string
     */
    function format_price($price = 0, $precision = 1)
    {
        if (empty($price)) {
            return 0;
        }
        //// return (float) sprintf("%1.2f", ($price));
        ////$price = sprintf('%1.2f', round($price, 1));
        $price = round($price, 1);
        if (floatval($price) < 0.00001) {
            return 0;
        } else {
            return $price;
        }
    }
}

if (!function_exists('get_fuzzy_name')) {
    /**
     * fuzzy name.
     *
     * @param string $nickname
     *
     * @return mixed
     */
    function get_fuzzy_name($nickname = '')
    {
        if (!$nickname) {
            return '';
        }
        $length = mb_strlen($nickname, 'utf-8');
        if ($length < 3) {
            return sprintf('%s***', mb_substr($nickname, 0, 1, 'utf-8'));
        } elseif ($length >= 3 && $length < 5) {
            return sprintf('%s***%s', mb_substr($nickname, 0, 1, 'utf-8'), mb_substr($nickname, -1, 1, 'utf-8'));
        } else {
            return sprintf('%s***%s', mb_substr($nickname, 0, 2, 'utf-8'), mb_substr($nickname, -2, 2, 'utf-8'));
        }
    }
}

/**
 * 手机号码检查
 *
 * 号段: 13*, 14*, 15*, 16*, 17*, 18*, 19*
 */
if (!function_exists('is_phone_number')) {
    /**
     * 检测是不是手机号
     *
     * @param $phoneNumber
     * @return bool
     */
    function is_phone_number($phoneNumber)
    {
        if (preg_match('/^1[3456789]{1}\d{9}$/', $phoneNumber)) {
            return true;
        }

        return false;
    }
}
// --------------------------------------------------------------------------
/**
 * is_url
 */
if (!function_exists('is_url')) {
    function is_url($url = '')
    {
        $pattern = "/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/";
        if (!preg_match($pattern, $url)) {
            return false;
        } else {
            return true;
        }
    }
}

// --------------------------------------------------------------------------

if (!function_exists('get_user_agent')) {
    /**
     * @return string
     */
    function get_user_agent()
    {
        return (string) getenv('HTTP_USER_AGENT');
    }
}