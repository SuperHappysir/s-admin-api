<?php

namespace App\Model\Logic\Permission\Account;

use App\Common\Concern\BeanStaticInstance;
use App\Model\Dao\Account\AccountDaoInterface;
use App\Model\Logic\Permission\Role\RoleLogic;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Stdlib\Collection;

/**
 * Class AccountRoleLogic
 *
 * @Bean(scope=Bean::PROTOTYPE)
 */
class AccountRoleLogic
{
    use BeanStaticInstance;
    
    /**
     * @Inject()
     *
     * @var AccountDaoInterface
     */
    protected $accountDao;
    
    /**
     * 获取账户所有用户角色
     *
     * @param int $accId
     * @return \Swoft\Stdlib\Collection
     * @throws \ReflectionException
     */
    public function getUserRoleByAccId(int $accId) : Collection
    {
        return $this->accountDao->getUserRoleByAccountId($accId);
    }
    
    /**
     * 全量分配用户角色
     *
     * @param int   $accountId 账户ID
     * @param int[] $roleIds   角色ID集合
     * @return bool
     * @throws \App\Exception\NotFoundException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function assignRoleIdsToAccount(
        int $accountId,
        array $roleIds = []
    ) : bool {
        $accountBean = AccountLogic::instance();
        $accountBean->findOrFail($accountId);
        
        // 过滤未启用的角色
        $roleIds = RoleLogic::instance()->getEnableRoleByRoleIds($roleIds);
        
        // 禁用所有用户角色
        $this->accountDao->deleteUserRoleByAccId($accountId);
        if (!$roleIds) {
            return true;
        }
        
        // 重新启用$roleIds中在数据库已存在的记录
        $existRecords = $this->accountDao->getUserRoleByAccountId($accountId, true);
        if ($existRecords->isNotEmpty()) {
            $this->accountDao->enableUserRoleByAccId($accountId, $roleIds);
        }
        
        // 批量插入差量数据
        $existRoles        = $existRecords->pluck('role_id')->toArray();
        $needInsertRoleIds = array_diff($roleIds, $existRoles);
        
        if (!$needInsertRoleIds) {
            return true;
        }
        
        return $this->accountDao->createUserRoleRelation($accountId, $needInsertRoleIds);
    }
}
