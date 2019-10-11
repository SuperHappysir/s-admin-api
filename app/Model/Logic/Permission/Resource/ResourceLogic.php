<?php declare(strict_types = 1);

namespace App\Model\Logic\Permission\Resource;

use App\Common\Concern\BeanStaticInstance;
use App\Common\Enum\Permission\TypeEnum;
use App\Common\Util\Env;
use App\Model\Entity\Permission\ApiFieldResourceEntity;
use App\Model\Entity\Permission\ApiResourceEntity;
use App\Model\Entity\Permission\FrontResourceEntity;
use App\Model\Vo\Permission\BackEndApiFieldResource;
use App\Model\Vo\Permission\BackendApiResource;
use App\Model\Vo\Permission\BackendApiResourceCollection;
use App\Model\Vo\Permission\FrontResource;
use App\Model\Vo\Permission\FrontResourceCollection;
use Applications\Common\Register\PermissionResourceRegister;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Router\Router;

/**
 * Class RouteResourceLogic
 *
 * @Bean(scope=Bean::PROTOTYPE)
 */
class ResourceLogic
{
    use BeanStaticInstance;
    
    /**
     * @Inject(PermissionDao::class)
     *
     * @var \App\Model\Dao\Permission\ResourceDaoInterface
     */
    protected $perDao;
    
    /**
     * @return \App\Model\Vo\Permission\BackendApiResourceCollection
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getBackendRouteResource() : BackendApiResourceCollection
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
        
        $collection = BackendApiResourceCollection::new();
        /** @var ApiResourceEntity $apiPermissionEntity */
        foreach ($allResource as $apiPermissionEntity) {
            $collection->push(
                BackendApiResource::convertFrom($apiPermissionEntity)
            );
        }
        
        return $collection;
    }
    
    /**
     * 创建接口字段
     *
     * @param int                                              $apiPerId
     * @param \App\Model\Vo\Permission\BackEndApiFieldResource $dto
     * @return \App\Model\Entity\Permission\ApiFieldResourceEntity
     * @throws \App\Exception\AlreadyExistsException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function createApiField(
        int $apiPerId,
        BackEndApiFieldResource $dto
    ) : ApiFieldResourceEntity {
        return $this->perDao->createBackEndApiField($apiPerId, $dto);
    }
    
    /**
     * 更新接口字段
     *
     * @param int                                              $resourceId
     * @param \App\Model\Vo\Permission\BackEndApiFieldResource $dto
     * @return \App\Model\Entity\Permission\ApiFieldResourceEntity
     */
    public function updateApiField(
        int $resourceId,
        BackEndApiFieldResource $dto
    ) : ApiFieldResourceEntity {
        return $this->perDao->updateBackEndApiField($resourceId, $dto);
    }
    
    /**
     * 删除指定类型资源接口接口
     *
     * @param array $resourceIds
     * @param int   $type
     * @return bool
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function deleteResourceBy(
        array $resourceIds,
        int $type = TypeEnum::API_INTERFACE
    ) : bool {
        return $this->perDao->deleteResourceBy($resourceIds, $type) > 0;
    }
    
    /**
     * @param int[] $apiPerIds
     * @return array
     * @example [
     *      api_id1 => [
     *                  new BackEndApiFieldDto(),
     *                  new BackEndApiFieldDto(),
     *       ],
     *      api_id2 => [
     *                  new BackEndApiFieldDto(),
     *                  new BackEndApiFieldDto(),
     *      ],
     *  ]
     */
    public function getApiFieldByApiPerIds(
        array $apiPerIds
    ) : array {
        $list = $this->perDao->getApiFieldByApiPerIds($apiPerIds);
        
        $result = [];
        
        /** @var ApiFieldResourceEntity $item */
        foreach ($list as $item) {
            $result[$item->getApiPerId()][] = [
                'resource_id' => $item->getId(),
                'field_key'   => $item->getFieldKey(),
                'field_name'  => $item->getFieldName(),
                'field_desc'  => $item->getFieldDesc(),
            ];
        }
        
        return $result;
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
    
    /**
     * 同步前端权限
     *
     * @param \App\Model\Vo\Permission\FrontResourceCollection $dtoList
     * @return bool
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function syncFrontEndResource(
        FrontResourceCollection $dtoList
    ) : bool {
        
        $ids = [];
        /** @var FrontResource $item */
        foreach ($dtoList as $item) {
            $entity = $this->perDao->createOrUpdateFrontEndResource($item);
            $ids[]  = $entity->getId();
        }
        
        // 本地协同开发时，会删除其他开发同事生成的权限
        // 因此本地不删除
        if (!Env::isDev()) {
            $this->perDao->deleteResourceByNotIn($ids, TypeEnum::FRONT_END);
        }
        
        return true;
    }
    
    /**
     * 更新前端权限
     *
     * @param int                                    $id
     * @param \App\Model\Vo\Permission\FrontResource $dto
     * @return \App\Model\Entity\Permission\FrontResourceEntity
     * @throws \App\Exception\NotFoundException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function updateFrontEndResource(
        int $id,
        FrontResource $dto
    ) : FrontResourceEntity {
        return $this->perDao->updateFrontEndResource($id, $dto);
    }
    
    /**
     * 获取前端权限列表
     *
     * @return \App\Model\Vo\Permission\FrontResourceCollection
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getFrontResourceCollection() : FrontResourceCollection
    {
        // 已存在的所有前端权限
        $allResource = $this->perDao->getRecordsByType(TypeEnum::FRONT_END);
        
        $collection = FrontResourceCollection::new();
        
        /** @var FrontResourceEntity $resourceEntity */
        foreach ($allResource as $resourceEntity) {
            $collection->push(FrontResource::convertFrom($resourceEntity));
        }
        
        return $collection;
    }
    
    /**
     * 提供指定的权限id，获取其中启用的权限id（过滤失效权限id）
     *
     * @param array $permissionIds
     * @param int   $type
     * @return int[]
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getEnablePerByPerIds(
        array $permissionIds,
        int $type = TypeEnum::API_INTERFACE
    ) : array {
        return array_intersect($permissionIds, $this->perDao->getIdsByType($type));
    }
}
