<?php declare(strict_types = 1);

namespace App\Model\Dao\Permission;

use App\Common\Enum\Permission\TypeEnum;
use App\Model\Dao\DaoInterface;
use App\Model\Entity\Rbac\ApiFieldResourceEntity;
use App\Model\Entity\Rbac\ApiResourceEntity;
use App\Model\Vo\Permission\BackEndApiField;
use Swoft\Db\Eloquent\Collection;

/**
 * Interface PermissionDaoInterface
 */
interface PermissionDaoInterface extends DaoInterface
{
    /**
     * 删除全部权限
     *
     * @param int $type
     * @return int
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function deletedAllResource(
        int $type = TypeEnum::API_INTERFACE
    ) : int;
    
    /**
     * @param array $attr
     * @return \App\Model\Entity\Rbac\ApiResourceEntity
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function findOrCreateBackEndRoute(
        array $attr
    ) : ApiResourceEntity;
    
    /**
     * 启用指定后端路由
     *
     * @param array $resourceIds
     * @param int   $type
     * @return int
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function enableResource(
        array $resourceIds,
        int $type = TypeEnum::API_INTERFACE
    ) : int;
    
    /**
     * 删除指定资源
     *
     * @param array $resourceIds
     * @param int   $type
     * @return int
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function deleteResourceBy(
        array $resourceIds,
        int $type = TypeEnum::API_INTERFACE
    ) : int;
    
    /**
     * 删除不在指定资源中的资源
     *
     * @param array $resourceIds
     * @param int   $type
     * @return int
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function deleteResourceByNotIn(
        array $resourceIds,
        int $type = TypeEnum::API_INTERFACE
    ) : int;
    
    /**
     * 通过类型获取资源id
     *
     * @param int $type
     * @return array
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getIdsByType(int $type = TypeEnum::API_INTERFACE) : array;
    
    /**
     * 提供指定的权限id，获取其中启用的权限（过滤失效权限id）
     *
     * @param int   $type
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getRecordsByType(
        int $type = TypeEnum::API_INTERFACE,
        array $columns = ['*']
    ) : Collection;
    
    /**
     * @param array $ids
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getBackEndRouteByPerIds(
        array $ids,
        array $columns = ['*']
    ) : Collection;
    
    /**
     * 通过api权限id获取api权限字段
     *
     * @param array $apiPerIds
     * @param array $columns
     * @return Collection
     */
    public function getApiFieldByApiPerIds(
        array $apiPerIds,
        array $columns = ['*']
    ) : Collection;
    
    /**
     * @param int                                      $apiPerId
     * @param \App\Model\Vo\Permission\BackEndApiField $dto
     * @return \App\Model\Entity\Rbac\ApiFieldResourceEntity
     * @throws \App\Exception\AlreadyExistsException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function createBackEndApiField(
        int $apiPerId,
        BackEndApiField $dto
    ) : ApiFieldResourceEntity;
}
