<?php declare(strict_types = 1);

namespace App\Model\Logic\Permission\Resource;

use App\Common\Concern\BeanStaticInstance;
use App\Common\Util\Env;
use App\Model\Dao\Permission\Impl\PermissionDao;
use Applications\Common\Register\PermissionResourceRegister;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Router\Router;

/**
 * Class RouteResourceLogic
 *
 * @Bean(scope=Bean::PROTOTYPE)
 */
class RouteResourceLogic
{
    use BeanStaticInstance;
    
    /**
     * @Inject(PermissionDao::class)
     *
     * @var \App\Model\Dao\Permission\PermissionDaoInterface
     */
    protected $perDao;
    
    /**
     * @return bool
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function updateApiRouteResource() : bool
    {
        /** @var Router $router */
        $router = \bean('httpRouter');
        
        // 获取已存在的所有后端权限
        $allResourceIds = $this->perDao->getIdsByType();
        
        // 创建后端接口权限资源记录
        $resourceIds = [];
        foreach ($router->getRoutes() as $route) {
            [$className, $method] = explode('@', $route['handler']);
            $permissionResource = PermissionResourceRegister::getPermissionResource($className, $method);
            
            if (!$permissionResource) {
                continue;
            }
            
            $attr          = [
                'name'   => $permissionResource->getName(),
                'method' => $route['method'],
                'path'   => $route['path'],
                'extra'  => $permissionResource->toArray(),
            ];
            $entity        = $this->perDao->findOrCreateBackEndRoute($attr);
            $resourceIds[] = $entity->getId();
        }
        
        $needDelIds = array_diff($allResourceIds, $resourceIds);
        if ($needDelIds && !Env::isDev()) {
            // 本地协同开发时，会删除其他开发同事生成的权限,因此本地不删除
            $this->perDao->deleteResourceBy($needDelIds);
        }
        
        return true;
    }
}
