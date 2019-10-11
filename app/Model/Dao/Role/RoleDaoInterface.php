<?php declare(strict_types = 1);

namespace App\Model\Dao\Role;

use App\Common\Enum\Permission\TypeEnum;
use App\Model\Dao\DaoInterface;
use App\Model\Dao\Role\Impl\RoleDao;
use App\Model\Entity\Permission\RoleEntity;
use App\Model\Vo\Permission\Role;
use App\Model\Vo\Permission\RolePageSearcher;
use Happysir\Lib\Enum\BoolEnum;
use Happysir\Respository\Concern\Paginator;
use Swoft\Db\Eloquent\Collection;

/**
 * Interface RoleDaoInterface
 */
interface RoleDaoInterface extends DaoInterface
{
    /**
     * 提供指定的角色id，获取其中启用的角色（过滤失效角色id）
     *
     * @param array $roleIds
     * @return array
     * @throws \ReflectionException
     */
    public function getEnableRoleByRoleIds(array $roleIds) : array;
    
    /**
     * @param string $roleName
     * @return null|Role
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getRoleByName(string $roleName) : ?RoleEntity;
    
    /**
     * 提供指定的角色id，获取其中启用的角色（过滤失效角色id）
     *
     * @param array $roleIds
     * @return array
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getEnableRoleIdsByRoleIds(array $roleIds) : array;
    
    /**
     * 通过角色ID获取角色权限
     *
     * @param int  $roleId         角色ID
     * @param int  $type
     * @param bool $includeDeleted 是否包含已删除数据
     * @return \Swoft\Db\Eloquent\Collection
     */
    public function getRolePermissionByRoleId(
        int $roleId,
        int $type = TypeEnum::API_INTERFACE,
        bool $includeDeleted = false
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
    public function deleteRolePermissionByRoleId(int $roleId, int $type = TypeEnum::API_INTERFACE) : bool;
    
    /**
     * 通过角色id和权限id 启用角色已拥有的权限
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
     * @throws \ReflectionException
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
     * @return \Swoft\Db\Eloquent\Collection
     */
    public function getAllPermissionByRoleIds(
        array $roleIds
    ) : Collection;
    
    /**
     * 搜索分页
     *
     * @param \App\Model\Vo\Permission\RolePageSearcher $searchDto
     * @return \Happysir\Respository\Concern\Paginator
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function filterPagination(RolePageSearcher $searchDto) : Paginator;
}
