<?php declare(strict_types = 1);

namespace App\Model\Dao\Role\Impl;

use App\Enum\BoolEnum;
use App\Model\Dao\AbstractDao;
use App\Model\Dao\Role\RoleDaoInterface;
use App\Model\Entity\Rbac\Role;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 */
class RoleDao extends AbstractDao implements RoleDaoInterface
{
    public function model() : string
    {
        return Role::class;
    }
    
    /**
     * @param string $roleName
     * @return \App\Model\Entity\Rbac\Role|null
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getRoleByName(string $roleName) : ?Role
    {
        /** @var Role $entity */
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
}
