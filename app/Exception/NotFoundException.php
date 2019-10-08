<?php
/**
 * Created by PhpStorm.
 * User: hongker
 * Date: 18-10-17
 * Time: 下午6:07
 */

namespace App\Exception;


use App\Common\Enum\StatusCode;

/**
 * 数据不存在
 * Class NotFoundException
 * @package Applications\Exceptions
 */
class NotFoundException extends ApplicationBaseException
{
    protected $code = StatusCode::NOT_FOUND;

    protected $message = '数据不存在';
}
