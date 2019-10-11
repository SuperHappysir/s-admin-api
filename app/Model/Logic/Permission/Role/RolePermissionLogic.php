<?php

namespace App\Model\Logic\Permission\Role;

use App\Common\Enum\Permission\TypeEnum;
use App\Model\Dao\Role\RoleDaoInterface;
use App\Model\Entity\Permission\RoleResourceEntity;
use App\Model\Logic\Permission\Resource\ResourceLogic;
use App\Model\Logic\Permission\Resource\ResourceLogic;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class RolePermissionLogic
 *
 * @Bean(scope=Bean::PROTOTYPE)
 */
class RolePermissionLogic
{
    /**
     * @Inject(RoleDao::class)
     *
     * @var RoleDaoInterface
     */
    protected $roleDao;
    
    /**
     * 分配权限给指定角色
     *
     * @param int   $roleId
     * @param array $permissionIds
     * @param int   $type
     * @return bool
     * @throws \Throwable
     */
    public function assignPermissionsToRole(
        int $roleId,
        array $permissionIds = [],
        int $type = TypeEnum::API_INTERFACE
    ) : bool {
    
        try {
            RoleLogic::instance()->findOrFail($roleId);                      // 禁用所有角色权限
            $this->roleDao->deleteRolePermissionByRoleId($roleId, $type);// 过滤已失效的权限ID
            $permissionIds = ResourceLogic::instance()->getEnablePerByPerIds($permissionIds, $type);
            if (!$permissionIds) {
                return true;
            }
            // 重新启用$permissionIds中在数据库已存在的记录
            $existRecords = $this->roleDao->getRolePermissionByRoleId($roleId, $type, true);
            if ($existRecords->isNotEmpty()) {
                $this->roleDao->enableRolePermissionByRoleId($roleId, $permissionIds, $type);
            }
            // 批量插入差量数据
            $existPermissions = $existRecords->pluck('resource_id')->toArray();
            $needInsertIds    = array_diff($permissionIds, $existPermissions);
            if (!$needInsertIds) {
                return true;
            }
            $result = $this->roleDao->createRolePermissionRelation($roleId, $needInsertIds, $type);
        
            return $result;
        } catch (\Throwable $e) {
            throw $e;
        } finally {
            // AuthCache::refreshRolePermissionCache();
        }
    }
    
    /**
     * 分配权限给指定角色
     *
     * @param int[] $roleIds
     * @return array
     */
    public function getAllPermissionByRoleIds(
        array $roleIds
    ) : array {

        $collection = $this->roleDao->getAllPermissionByRoleIds($roleIds);
    
        $result = [];
        /** @var RoleResourceEntity $item */
        foreach ($collection as $item) {
            $result[$item->getRoleId()][] = [
                'resource_type' => $item->getResourceType(),
                'resource_id'   => $item->getResourceId(),
            ];
        }
        
        return $result;
    }
}
