<?php declare(strict_types = 1);

namespace App\Model\Dao\Account\Impl;

use App\Enum\BoolEnum;
use App\Exception\InvalidParamException;
use App\Model\Dao\AbstractDao;
use App\Model\Dao\Account\AccountRoleDaoInterface;
use App\Model\Entity\Rbac\AccountRoleEntity;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\Eloquent\Collection;

/**
 * @Bean()
 */
class AccountRoleDao extends AbstractDao implements AccountRoleDaoInterface
{
    /**
     * @return string
     */
    public function model() : string
    {
        return AccountRoleEntity::class;
    }
    
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
    ) : Collection {
        $query = $this->eloquentBuilder();
        
        if (!$includeDeleted) {
            $query->where('is_deleted', BoolEnum::FALSE);
        }
        
        return $query->where('account_id', $accountId)
                     ->get($columns);
    }
    
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
    ) : bool {
        if (!$roleIds) {
            return true;
        }
        
        return false !== $this->eloquentBuilder()
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
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function createUserRoleRelation(
        int $accountId,
        array $roleIds
    ) : bool {
        if ($accountId < 0) {
            throw new InvalidParamException('$accountId 不能小于0');
        }
        
        $values = [];
        foreach ($roleIds as $roleId) {
            $values[] = [
                'account_id' => $accountId,
                'role_id'    => $roleId,
            ];
        }
        
        return $this->eloquentBuilder()->insert($values);
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
        return false !== $this->eloquentBuilder()
                              ->where('account_id', $accountId)
                              ->update(
                                  [
                                      'is_deleted' => BoolEnum::TRUE
                                  ]
                              );
    }
}
