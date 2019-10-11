<?php declare(strict_types = 1);

namespace App\Model\Dao\Role\Impl;

use App\Common\Enum\Permission\TypeEnum;
use App\Model\Dao\AbstractDao;
use App\Model\Dao\Role\RoleDaoInterface;
use App\Model\Entity\Permission\RoleEntity;
use App\Model\Entity\Permission\RoleResourceEntity;
use App\Model\Vo\Permission\RolePageSearcher;
use Happysir\Lib\Enum\BoolEnum;
use Happysir\Respository\Concern\Paginator;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\Eloquent\Collection;

/**
 * @Bean()
 */
class RoleDao extends AbstractDao implements RoleDaoInterface
{
    public function model() : string
    {
        return RoleEntity::class;
    }
    
    /**
     * 搜索分页
     *
     * @param \App\Model\Vo\Permission\RolePageSearcher $searchDto
     * @return \Happysir\Respository\Concern\Paginator
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function filterPagination(RolePageSearcher $searchDto) : Paginator
    {
        $builder = $this->eloquentBuilder()->where('is_deleted', BoolEnum::FALSE);
        
        if ($searchDto->getName()) {
            $builder->where(
                'role_name',
                'like', '%' . $searchDto->getName() . '%'
            );
        }
        
        return $this->getPaginator(
            $builder, $searchDto
        );
    }
    
    /**
     * @param string $roleName
     * @return \App\Model\Entity\Permission\RoleEntity|null
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getRoleByName(string $roleName) : ?RoleEntity
    {
        /** @var RoleEntity $entity */
        $entity = $this->eloquentBuilder()
                       ->where('role_name', $roleName)
                       ->first();
        
        return $entity;
    }
    
    /**
     * 提供指定的角色id，获取其中启用的角色（过滤失效角色id）
     *
     * @param array $roleIds
     * @return array
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getEnableRoleIdsByRoleIds(array $roleIds) : array
    {
        return $this->eloquentBuilder()
                    ->where('is_deleted', BoolEnum::FALSE)
                    ->whereIn('role_id', $roleIds)
                    ->get(['role_id'])
                    ->pluck('role_id')
                    ->toArray();
    }
    
    /**
     * 提供指定的角色id，获取其中启用的角色（过滤失效角色id）
     *
     * @param array $roleIds
     * @return array
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getEnableRoleByRoleIds(array $roleIds) : array
    {
        return $this->eloquentBuilder()
                    ->where('is_deleted', BoolEnum::FALSE)
                    ->whereIn('id', $roleIds)
                    ->pluck('id')->toArray();
    }
    
    /**
     * 通过角色ID获取角色权限
     *
     * @param int  $roleId         角色ID
     * @param int  $type
     * @param bool $includeDeleted 是否包含已删除数据
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getRolePermissionByRoleId(
        int $roleId,
        int $type = TypeEnum::API_INTERFACE,
        bool $includeDeleted = false
    ) : Collection {
        $query = RoleResourceEntity::query();
        
        if (!$includeDeleted) {
            $query->where('is_deleted', BoolEnum::FALSE);
        }
        
        return $query->where('role_id', $roleId)
                     ->where('resource_type', $type)
                     ->get();
    }
    
    /**
     * 保存角色权限关联关系，注意：如果角色ID已存在会报唯一键错误
     *
     * @param int   $roleId
     * @param array $perIds
     * @param int   $type
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function createRolePermissionRelation(
        int $roleId,
        array $perIds,
        int $type = TypeEnum::API_INTERFACE
    ) : bool {
        $perIds = array_unique($perIds);
        $values = [];
        foreach ($perIds as $perId) {
            $values[] = [
                'role_id'       => $roleId,
                'resource_id'   => $perId,
                'resource_type' => $type,
            ];
        }
        
        return RoleResourceEntity::query()->insert($values);
    }
    
    /**
     * 通过role id删除角色所有权限
     *
     * @param int $roleId
     * @param int $type
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function deleteRolePermissionByRoleId(
        int $roleId,
        int $type = TypeEnum::API_INTERFACE
    ) : bool {
        return false !== RoleResourceEntity::query()
                                           ->where('role_id', $roleId)
                                           ->where('resource_type', $type)
                                           ->update(
                                               [
                                                   'is_deleted' => BoolEnum::TRUE
                                               ]
                                           );
    }
    
    /**
     * 通过角色id和权限id 启用角色已拥有的权限
     *
     * @param int   $roleId
     * @param array $perIds
     * @param int   $type
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function enableRolePermissionByRoleId(
        int $roleId,
        array $perIds,
        int $type = TypeEnum::API_INTERFACE
    ) : bool {
        if (!$perIds) {
            return true;
        }
        
        return false !== RoleResourceEntity::query()
                                           ->where('role_id', $roleId)
                                           ->whereIn('resource_id', $perIds)
                                           ->where('resource_type', $type)
                                           ->update(
                                               [
                                                   'is_deleted' => BoolEnum::FALSE
                                               ]
                                           );
    }
    
    /**
     * 通过角色ID获取角色权限
     *
     * @param int[] $roleIds        角色ID
     * @param int   $type
     * @param bool  $includeDeleted 是否包含已删除数据
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getRolePermissionByRoleIds(
        array $roleIds,
        int $type = TypeEnum::API_INTERFACE,
        bool $includeDeleted = false
    ) : Collection {
        $query = RoleResourceEntity::query();
        
        if (!$includeDeleted) {
            $query->where('is_deleted', BoolEnum::FALSE);
        }
        if ($type !== TypeEnum::ALL) {
            $query->where('resource_type', $type);
        }
        
        return $query->whereIn('role_id', $roleIds)
                     ->get(['role_id', 'resource_type', 'resource_id']);
    }
    
    /**
     * 获取角色权限
     *
     * @param array $roleIds
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getAllPermissionByRoleIds(array $roleIds) : Collection
    {
        return RoleResourceEntity::query()
                                 ->where('is_deleted', BoolEnum::FALSE)
                                 ->whereIn('role_id', $roleIds)
                                 ->get();
    }
}
