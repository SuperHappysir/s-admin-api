<?php

namespace App\Exception;

use App\Common\Enum\StatusCode;

/**
 * 等待锁异常
 * Class InvalidParamException
 *
 * @package Applications\Exceptions
 */
class UnauthorizedException extends ApplicationBaseException
{
    protected $code    = StatusCode::UNAUTHORIZED;
    
    protected $message = '无权操作该资源~';
}
