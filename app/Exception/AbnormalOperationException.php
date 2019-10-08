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
 * 异常操作异常
 * Class InvalidParamException
 *
 * @package Applications\Exceptions
 */
class AbnormalOperationException extends ApplicationBaseException
{
    protected $code    = StatusCode::ABNORMAL_OPERATION;
    
    protected $message = '操作异常';
}
