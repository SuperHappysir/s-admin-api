<?php declare(strict_types = 1);

namespace App\Model\Dao\Role\Impl;

use App\Common\Enum\Permission\TypeEnum;
use App\Enum\BoolEnum;
use App\Model\Dao\AbstractDao;
use App\Model\Dao\Role\RoleResourceDaoInterface;
use App\Model\Entity\Permission\RoleResourceEntity;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\Eloquent\Collection;

/**
 * @Bean()
 */
class RoleResourceDao extends AbstractDao implements RoleResourceDaoInterface
{
    public function model() : string
    {
        return RoleResourceEntity::class;
    }
    
    /**
     * 通过角色ID获取角色权限
     *
     * @param int   $roleId         角色ID
     * @param int   $type
     * @param bool  $includeDeleted 是否包含已删除数据
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getRolePermissionByRoleId(
        int $roleId,
        int $type = TypeEnum::API_INTERFACE,
        bool $includeDeleted = false,
        array $columns = ['*']
    ) : Collection {
        $query = $this->eloquentBuilder();
        
        if (!$includeDeleted) {
            $query->where('is_deleted', BoolEnum::FALSE);
        }
        
        return $query->where('role_id', $roleId)
                     ->where('resource_type', $type)
                     ->get($columns);
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
        $query = $this->eloquentBuilder();
        
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
        return false !== $this->eloquentBuilder()
                              ->where('role_id', $roleId)
                              ->where('resource_type', $type)
                              ->update(
                                  [
                                      'is_deleted' => BoolEnum::TRUE
                                  ]
                              );
    }
    
    /**
     * 通过角色id和权限id 启用角色已用于的权限
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
        
        return false !== $this->eloquentBuilder()
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
        
        return $this->eloquentBuilder()->insert($values);
    }
    
    /**
     * 获取角色权限
     *
     * @param array $roleIds
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getAllPermissionByRoleIds(array $roleIds, array $columns = ['*']) : Collection
    {
        return $this->eloquentBuilder()
                    ->where('is_deleted', BoolEnum::FALSE)
                    ->whereIn('role_id', $roleIds)
                    ->get($columns);
    }
}
