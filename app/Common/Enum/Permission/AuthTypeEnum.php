<?php

namespace App\Common\Enum\Permission;

use Happysir\Lib\Concern\BaseEnum;

/**
 * Class AuthTypeEnum
 */
class AuthTypeEnum extends BaseEnum
{
    public const AUTH  = 2;
    
    public const LOGIN = 1;
    
    public const OPEN  = 0;
    
    protected static $nameMapping = [
        self::AUTH  => '需要鉴权',
        self::LOGIN => '需要登录',
        self::OPEN  => '开放',
    ];
}
