<?php declare(strict_types = 1);

namespace App\Common\Concern;

use function bean;

/**
 * trait BeanStaticInstance
 */
trait BeanStaticInstance
{
    /**
     * @return static
     */
    public static function instance() : self
    {
        /** @var self $instance */
        $instance = bean(static::class);
        
        return $instance;
    }
}
