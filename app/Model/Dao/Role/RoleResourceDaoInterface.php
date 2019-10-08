<?php declare(strict_types = 1);

namespace App\Model\Dao\Role;

use App\Common\Enum\Permission\TypeEnum;
use App\Model\Dao\DaoInterface;
use Swoft\Db\Eloquent\Collection;

/**
 * Interface RolePermissionDaoInteface
 */
interface RoleResourceDaoInterface extends DaoInterface
{
    /**
     * 通过角色ID获取角色权限
     *
     * @param int   $roleId         角色ID
     * @param int   $type
     * @param bool  $includeDeleted 是否包含已删除数据
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     */
    public function getRolePermissionByRoleId(
        int $roleId,
        int $type = TypeEnum::API_INTERFACE,
        bool $includeDeleted = false,
        array $columns = ['*']
    ) : Collection;
    
    /**
     * 保存角色权限关联关系，注意：如果角色ID已存在会报唯一键错误
     *
     * @param int   $roleId
     * @param array $perIds
     * @param int   $type
     * @return bool
     */
    public function createRolePermissionRelation(
        int $roleId,
        array $perIds,
        int $type = TypeEnum::API_INTERFACE
    ) : bool;
    
    /**
     * 通过role id删除角色所有权限
     *
     * @param int $roleId
     * @param int $type
     * @return bool
     */
    public function deleteRolePermissionByRoleId(
        int $roleId,
        int $type = TypeEnum::API_INTERFACE
    ) : bool;
    
    /**
     * 通过角色id和权限id 启用角色已用于的权限
     *
     * @param int   $roleId
     * @param array $perIds
     * @param int   $type
     * @return bool
     */
    public function enableRolePermissionByRoleId(
        int $roleId,
        array $perIds,
        int $type = TypeEnum::API_INTERFACE
    ) : bool;
    
    /**
     * 通过角色ID获取角色权限
     *
     * @param int[] $roleIds        角色ID
     * @param int   $type
     * @param bool  $includeDeleted 是否包含已删除数据
     * @return \Swoft\Db\Eloquent\Collection
     */
    public function getRolePermissionByRoleIds(
        array $roleIds,
        int $type = TypeEnum::API_INTERFACE,
        bool $includeDeleted = false
    ) : Collection;
    
    /**
     * 获取角色权限
     *
     * @param array $roleIds
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     */
    public function getAllPermissionByRoleIds(
        array $roleIds,
        array $columns = ['*']
    ) : Collection;
}
