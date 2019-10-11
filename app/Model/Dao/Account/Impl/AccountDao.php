<?php declare(strict_types = 1);

namespace App\Model\Dao\Account\Impl;

use App\Model\Dao\AbstractDao;
use App\Model\Dao\Account\AccountDaoInterface;
use App\Model\Entity\Permission\AccountEntity;
use App\Model\Entity\Permission\AccountRoleEntity;
use App\Model\Vo\Permission\AccountPageSearcher;
use Happysir\Lib\Enum\BoolEnum;
use Happysir\Respository\Concern\Paginator;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\Eloquent\Collection;

/**
 * @Bean()
 */
class AccountDao extends AbstractDao implements AccountDaoInterface
{
    /**
     * @return string
     */
    public function model() : string
    {
        return AccountEntity::class;
    }
    
    /**
     * 搜索分页
     *
     * @param \App\Model\Vo\Permission\AccountPageSearcher $searchDto
     * @return \Happysir\Respository\Concern\Paginator
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function filterPagination(AccountPageSearcher $searchDto) : Paginator
    {
        $builder = $this->eloquentBuilder();
        
        if ($searchDto->getNickname()) {
            $builder->where('nickname', 'like', sprintf('%%%s%%', $searchDto->getNickname()));
        }
        if ($searchDto->getAccountId()) {
            $builder->where('account_id', $searchDto->getAccountId());
        }
        
        return $this->getPaginator(
            $builder,
            $searchDto
        );
    }
    
    /**
     * 通过账户ID获取用户角色
     *
     * @param int  $accountId      账户ID
     * @param bool $includeDeleted 是否包含已删除数据
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getUserRoleByAccountId(
        int $accountId,
        bool $includeDeleted = false
    ) : Collection {
        $query = AccountRoleEntity::query();
        
        if (!$includeDeleted) {
            $query->where('is_deleted', BoolEnum::FALSE);
        }
        
        return $query->where('account_id', $accountId)
                     ->get();
    }
    
    /**
     * 通过acc id删除用户所有角色
     *
     * @param int $accountId
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function deleteUserRoleByAccId(int $accountId) : bool
    {
        return false !== AccountRoleEntity::query()
                                          ->where('account_id', $accountId)
                                          ->update(
                                              [
                                                  'is_deleted' => BoolEnum::TRUE
                                              ]
                                          );
    }
    
    /**
     * 通过acc id和角色id启用用户已存在的角色
     *
     * @param int   $accountId
     * @param array $roleIds
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function enableUserRoleByAccId(int $accountId, array $roleIds) : bool
    {
        if (!$roleIds) {
            return true;
        }
        
        return false !== AccountRoleEntity::query()
                                          ->where('account_id', $accountId)
                                          ->whereIn('role_id', $roleIds)
                                          ->update(
                                              [
                                                  'is_deleted' => BoolEnum::FALSE
                                              ]
                                          );
    }
    
    /**
     * 保存用户角色关联关系，注意：如果角色ID已存在会报唯一键错误
     *
     * @param int   $accountId
     * @param array $roleIds
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function createUserRoleRelation(
        int $accountId,
        array $roleIds
    ) : bool {
        $values = [];
        foreach ($roleIds as $roleId) {
            $values[] = [
                'account_id' => $accountId,
                'role_id'    => $roleId,
            ];
        }
        
        return AccountRoleEntity::query()->insert($values);
    }
}
