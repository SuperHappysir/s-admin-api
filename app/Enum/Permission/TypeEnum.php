<?php

namespace App\Enum\Permission;

use Happysir\Lib\Concern\BaseEnum;

/**
 * Class TypeEnum
 */
class TypeEnum extends BaseEnum
{
    public const ALL                 = 0;
    
    public const FRONT_END           = 1;
    
    public const API_INTERFACE       = 2;
    
    public const API_INTERFACE_FIELD = 3;
    
    protected static $nameMapping = [
        self::FRONT_END           => '前端权限',
        self::API_INTERFACE       => 'API接口权限',
        self::API_INTERFACE_FIELD => 'API接口字段权限',
    ];
}
