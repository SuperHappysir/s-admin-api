<?php declare(strict_types = 1);

namespace App\Model\Dao\Role;

use App\Enum\BoolEnum;
use App\Model\Dao\DaoInterface;
use App\Model\Dao\Role\Impl\RoleDao;
use App\Model\Entity\Rbac\RoleEntity;

/**
 * Interface RoleDaoInterface
 */
interface RoleDaoInterface extends DaoInterface
{
    /**
     * @param string $roleName
     * @return \Applications\Model\Entity\Mysql\Rbac\Role|null
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
}
