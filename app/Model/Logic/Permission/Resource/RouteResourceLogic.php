<?php declare(strict_types = 1);

namespace App\Model\Logic\Permission\Resource;

use App\Common\Concern\BeanStaticInstance;
use App\Common\Util\Env;
use App\Model\Dao\Permission\Impl\PermissionDao;
use App\Model\Entity\Rbac\ApiResourceEntity;
use App\Model\Vo\Permission\BackendRouteResource;
use App\Model\Vo\Permission\BackendRouteResourceCollection;
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
     * @return \App\Model\Vo\Permission\BackendRouteResourceCollection
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getBackendRouteResource() : BackendRouteResourceCollection
    {
        // 已存在的所有后端权限
        $allResource = $this->perDao->getRecordsByType();
        $allResource = $allResource->sortBy(
            static function (
                ApiResourceEntity $apiPermissionEntity
            ) {
                return $apiPermissionEntity->getUri();
            }
        );
        
        $collection = BackendRouteResourceCollection::new();
        /** @var ApiResourceEntity $apiPermissionEntity */
        foreach ($allResource as $apiPermissionEntity) {
            $collection->push(
                BackendRouteResource::convertFrom($apiPermissionEntity)
            );
        }
        
        return $collection;
    }
    
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
        
        // 本地协同开发时，会删除其他开发同事生成的权限,因此本地不删除
        $needDelIds = array_diff($allResourceIds, $resourceIds);
        if ($needDelIds && !Env::isDev()) {
            $this->perDao->deleteResourceBy($needDelIds);
        }
        
        return true;
    }
}
