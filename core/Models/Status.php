<?php

namespace Core\Models;


/**
 * 结果响应函数，在流程控制的过程中，我们发现使用结果响应函数的封装，
 * 能够简化许多流程的开发。
 *
 */
class Status
{

    /**
     * 处理结果状态码
     *
     * @var int
     */
  public $code;

    /**
     * 处理结果提示消息
     *
     * @var string
     */
  public $message;

    /**
     * 处理结果数据
     *
     * @var mixed
     */
  public $data;

}
