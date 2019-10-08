<?php declare(strict_types = 1);

namespace App\Common\Util;

/**
 * Class Env
 */
class Env
{

    // 生产环境
    public const PRODUCT = 'product';
    
    // 开发环境
    public const DEV     = 'dev';
    
    /**
     * @return string
     */
    public static function getEnv() : string
    {
        return env('ENVIRONMENT', self::PRODUCT);
    }
    
    /**
     * @return bool
     */
    public static function isDev() : bool
    {
        return self::getEnv() === self::DEV;
    }
    
    /**
     * @return bool
     */
    public static function isProduct() : bool
    {
        return self::getEnv() === self::PRODUCT;
    }
}
