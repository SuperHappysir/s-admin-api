<?php declare(strict_types = 1);

namespace Applications\Common\Register;

use App\Annotation\Mapping\PermissionResource;

/**
 * Class PermissionResourceRegister
 *
 * @package Applications\Annotation
 */
class PermissionResourceRegister
{
    /**
     * @var array
     *
     * @example
     * [
     *     'className' => [
     *         'method' => new PermissionResource()
     *     ]
     * ]
     */
    protected static $permissionResourceMap = [];
    
    /**
     * Register aspect
     *
     * @param string             $className
     * @param string             $method
     * @param PermissionResource $resource
     */
    public static function registerPermissionResource(
        string $className,
        string $method,
        PermissionResource $resource
    ) : void {
        self::$permissionResourceMap[$className][$method] = $resource;
    }
    
    /**
     * @param string $className
     * @param string $method
     *
     * @return PermissionResource
     */
    public static function getPermissionResource(
        string $className,
        string $method
    ) : ?PermissionResource {
        return self::$permissionResourceMap[$className][$method] ?? null;
    }
    
    /**
     * getPermissionResources
     *
     * @return array
     */
    public static function getPermissionResources() : array
    {
        return self::$permissionResourceMap;
    }
}
