<?php declare(strict_types = 1);

namespace App\Model\Dao\Account;

use App\Model\Dao\DaoInterface;
use App\Model\Vo\Permission\AccountPageSearcher;
use Happysir\Respository\Concern\Paginator;
use Swoft\Db\Eloquent\Collection;

/**
 * Interface AccountDaoInterface
 */
interface AccountDaoInterface extends DaoInterface
{
    /**
     * 搜索分页
     *
     * @param \App\Model\Vo\Permission\AccountPageSearcher $searchDto
     * @return \Happysir\Respository\Concern\Paginator
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function filterPagination(AccountPageSearcher $searchDto) : Paginator;
    
    /**
     * 通过acc id和角色id启用用户已存在的角色
     *
     * @param int   $accountId
     * @param array $roleIds
     * @return bool
     * @throws \ReflectionException
     */
    public function enableUserRoleByAccId(int $accountId, array $roleIds) : bool;
    
    /**
     * 通过acc id删除用户所有角色
     *
     * @param int $accountId
     * @return bool
     * @throws \ReflectionException
     */
    public function deleteUserRoleByAccId(int $accountId) : bool;
    
    /**
     * 通过账户ID获取用户角色
     *
     * @param int  $accountId      账户ID
     * @param bool $includeDeleted 是否包含已删除数据
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     */
    public function getUserRoleByAccountId(
        int $accountId,
        bool $includeDeleted = false
    ) : Collection;
    
    /**
     * 保存用户角色关联关系，注意：如果角色ID已存在会报唯一键错误
     *
     * @param int   $accountId
     * @param array $roleIds
     * @return bool
     * @throws \ReflectionException
     */
    public function createUserRoleRelation(int $accountId, array $roleIds) : bool;
}
