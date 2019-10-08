<?php declare(strict_types=1);


namespace App\Controller;

use App\Annotation\Mapping\PermissionResource;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * Class TestController
 *
 * @since 2.0
 *
 * @Controller(prefix="test")
 */
class TestController
{
    /**
     * @RequestMapping(route="index")
     * @PermissionResource(name="测试")
     *
     * @return string
     */
    public function index(): string
    {
        return 'test';
    }
}
