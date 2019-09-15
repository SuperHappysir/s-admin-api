<?php
namespace App\Enum;

use Happysir\Lib\Concern\BaseEnum;

/**
 * 状态码
 * Class StatusCode
 *
 * @package Applications\Enum
 */
class StatusCode extends BaseEnum
{
    public const        OK                          = 200; // 成功
    
    public const        ERROR                       = 101; // 错误
    
    public const        LOGIC                       = 1001; // 逻辑错误
    
    public const        INVALID_PARAM               = 1002; // 参数不合法
    
    public const        INVALID_RESPONSE            = 1003; // 响应错误
    
    public const        NOT_FOUND                   = 1004; // 404
    
    public const        SYSTEM_ERROR                = 1005; // 系统错误
    
    public const        INVALID_NUMBER              = 1006; // 数量异常
    
    public const        INVALID_STATE               = 1009; // 状态异常
    
    public const        BUSY                        = 1010; // 繁忙
    
    public const        ALREADY_EXISTS              = 1011; // 数据已存在

    public const        UNAUTHORIZED                = 1012; // 未授权、无权操作
    
    public const        ABNORMAL_OPERATION          = 1013; // 异常操作
    
    public const        COOPERATIVE_WAREHOUSE_ERROR = 1014; // 三方仓库异常
    
    public const        DATA_NOT_EXISTS             = 1015; // 数据不存在


    /**
     * 判断是否为成功
     *
     * @param int $code
     *
     * @return bool
     */
    public static function isSuccess($code) : bool
    {
        return self::OK === $code;
    }
}
