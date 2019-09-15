<?php declare(strict_types = 1);

namespace App\Enum;

use Happysir\Lib\Concern\BaseEnum;

/**
 * Class BoolEnum
 *
 * 布尔常量
 */
class BoolEnum extends BaseEnum
{
    /**
     * false常量对应数值
     *
     * @var int
     */
    public const FALSE = 0;
    
    /**
     * true常量对应数值
     *
     * @var int
     */
    public const TRUE = 1;
    
    /**
     * 常量与名称映射表
     *
     * @var array
     */
    protected static $nameMapping = [
        self::FALSE => 'FALSE',
        self::TRUE  => 'TRUE'
    ];
    
    /**
     * 判断是否为true
     *
     * @param int $code
     *
     * @return bool
     */
    public static function isTrue(int $code) : bool
    {
        return $code === self::TRUE;
    }
    
    /**
     * 判断是否为false
     *
     * @param int $code
     *
     * @return bool
     */
    public static function isFalse(int $code) : bool
    {
        return $code === self::FALSE;
    }
}
