<?php
/**
 * Created by PhpStorm.
 * User: hongker
 * Date: 18-10-17
 * Time: 下午6:07
 */

namespace App\Exception;


use App\Enum\StatusCode;

/**
 * 参数错误异常
 * Class InvalidParamException
 * @package Applications\Exceptions
 */
class InvalidParamException extends ApplicationBaseException
{
    protected $code = StatusCode::INVALID_PARAM;

    protected $message = '参数错误';
}
