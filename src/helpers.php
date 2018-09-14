<?php

namespace Cnwyt\Helpers;

if (!function_exists('get_version')) {
    function get_version()
    {
        return '0.0.1';
    }
}

/**
 * 格式化显示价格
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

if (!function_exists('is_from_weixin')) {
    /**
     * 是否是微信请求
     *
     * @return bool
     */
    function is_from_weixin()
    {
        if (!empty($_SERVER['HTTP_USER_AGENT'])
            && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false
        ) {
            return true;
        }

        return false;
    }
}

if (!function_exists("is_ajax")) {
    /**
     * 是否是ajax请求
     *
     * @return bool
     */
    function is_ajax()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
        ) {
            return true;
        }

        return false;
    }
}

if (!function_exists('get_user_agent')) {
    /**
     * @return string
     */
    function get_user_agent()
    {
        return (string)getenv('HTTP_USER_AGENT');
    }
}

if (!function_exists("is_valid_email")) {
    function is_valid_email($email = '')
    {
        if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}

if (!function_exists("is_valid_url")) {
    function is_valid_url($url = '')
    {
        if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }

        return false;
    }
}

if (!function_exists("is_valid_ip")) {
    function is_valid_ip($url = '', $options = null)
    {
        if ($url && filter_var($url, FILTER_VALIDATE_IP, $options)) {
            return true;
        }

        return false;
    }
}


if (!function_exists('get_rand_prize')) {
    /**
     * 抽奖算法(来源综合于网络).
     *
     * $prizeArr是奖品配置数组，格式为: array(
     *    0 => array('name' => '未中奖', 'probability' => '5000')
     *    1 => array('name' => '积分', 'probability' => '2000')
     *    2 => array('name' => '50元购物卡', 'probability' => '300')
     *    3 => array('name' => '100元优惠券', 'probability' => '400')
     * )
     * $probabilityArr 是一个预先设置的数组，假设数组为: array(100,200,300,400)，其总和是1000.
     * 开始是从1,1000 这个概率范围内筛选第1个数是否在它的出现概率范围之内，
     * 如果不在，则将概率空间(也就是 $proSum 的值)减去刚刚的那个数字的概率空间，
     * 在本例当中就是1000减去100，也就是说第2个数是在1，900这个范围内。这样 筛选到最终，总会有一个数满足要求。
     * 就相当于去一个箱子里摸东西，第一个不是，第二个不是，第三个还不是，那最后一个一定是。
     *
     * @param array $prizeArr
     *
     * @return int|string
     */
    function get_rand_prize(array $prizeArr = [])
    {
        //根据奖品设置获取其概率
        $probabilityArr = [];
        foreach ($prizeArr as $key => $val) {
            if ($val['probability'] <= 0) {
                continue;
            }

            $probabilityArr[$key] = $val['probability'];
        }

        $result = 0; //默认奖品配置的key值
        //概率数组的总概率精度
        $proSum = array_sum($probabilityArr);
        //概率数组循环
        foreach ($probabilityArr as $key => $proVal) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum >= $proVal) { //如果随机数不在范围内，继续计算
                $proSum = $proSum - $proVal;
                continue;
            }
            $result = $key;
            break;
        }
        unset($probabilityArr);

        return $result;
    }
}
// --------------------------------------------------------------------------
