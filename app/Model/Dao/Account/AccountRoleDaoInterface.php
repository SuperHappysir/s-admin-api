<?php declare(strict_types = 1);

namespace App\Model\Dao\Account;

use App\Model\Dao\DaoInterface;
use Swoft\Db\Eloquent\Collection;

/**
 * Interface AccountRoleDaoInterface
 */
interface AccountRoleDaoInterface extends DaoInterface
{
    /**
     * 通过账户ID获取用户角色
     *
     * @param int   $accountId      账户ID
     * @param array $columns
     * @param bool  $includeDeleted 是否包含已删除数据
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getRoleByAccountId(
        int $accountId,
        array $columns = ['*'],
        bool $includeDeleted = false
    ) : Collection;
    
    /**
     * 通过accountId和角色id启用用户已拥有的角色
     *
     * @param int   $accountId
     * @param array $roleIds
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function enableUserRoleByAccountId(
        int $accountId,
        array $roleIds
    ) : bool;
    
    /**
     * 保存用户角色关联关系，注意：如果角色ID已存在会报唯一键错误
     *
     * @param int   $accountId
     * @param array $roleIds
     * @return bool
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function createUserRoleRelation(
        int $accountId,
        array $roleIds
    ) : bool;
    
    /**
     * 通过acc id删除用户所有角色
     *
     * @param int $accountId
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function deleteUserRoleByAccId(int $accountId) : bool;
}
