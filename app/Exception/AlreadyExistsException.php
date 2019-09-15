<?php

namespace App\Exception;

use App\Enum\StatusCode;

/**
 * Class AlreadyExistsException
 *
 * 数据已存在异常
 *
 * @author  luotao
 * @version 1.0
 * @package Applications\Exceptions
 */
class AlreadyExistsException extends ApplicationBaseException
{
    protected $code = StatusCode::ALREADY_EXISTS;
    
    protected $message = '数据已存在';
}
