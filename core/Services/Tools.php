<?php
/**
 * Created by PhpStorm.
 * User: luochao
 * Date: 5/11/16
 * Time: 18:47
 * 工具类
 */

namespace Core\Services;

class Tools
{

    /**
     * @Author LuoChao
     * @FunctionName create_uniqid
     * @return string
     * @explain 随机生成32位字符串可用作唯一id
     */
    function create_uniqid() {
        $data = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']
            . time() . rand();
        return md5(time() . $data);
    }
}