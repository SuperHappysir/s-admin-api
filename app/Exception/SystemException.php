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
 * 系统异常
 * Class CommonException
 *
 * @package Applications\Exceptions
 */
class SystemException extends ApplicationBaseException
{
    protected $code = StatusCode::SYSTEM_ERROR;

    protected $message = '系统错误';
}
