<?php

namespace App\Model\Logic\Permission\Account;

use App\Common\Concern\BeanStaticInstance;
use App\Exception\NotFoundException;
use App\Model\Dao\Account\AccountDaoInterface;
use App\Model\Entity\Permission\AccountEntity;
use App\Model\Vo\Permission\Account;
use App\Model\Vo\Permission\AccountPageSearcher;
use Happysir\Lib\Enum\BoolEnum;
use Happysir\Respository\Concern\Paginator;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Stdlib\Collection;

/**
 * Class CreateAccountLogic
 *
 * @Bean(scope=Bean::PROTOTYPE)
 */
class AccountLogic
{
    use BeanStaticInstance;
    
    /**
     * @Inject(AccountDao::class)
     *
     * @var AccountDaoInterface
     */
    protected $accountDao;
    
    /**
     * 分页筛选查询
     *
     * @param \App\Model\Vo\Permission\AccountPageSearcher $searchDto
     * @return \Happysir\Respository\Concern\Paginator
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function filterPagination(AccountPageSearcher $searchDto) : Paginator
    {
        return $this->accountDao->filterPagination($searchDto);
    }
    
    /**
     * 更新角色
     *
     * @param int                              $id
     * @param \App\Model\Vo\Permission\Account $request
     * @return \App\Model\Entity\Permission\AccountEntity
     * @throws \App\Exception\NotFoundException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function updateAccount(int $id, Account $request) : AccountEntity
    {
        $entity = $this->findOrFail($id);
        
        $entity->setNickname($request->getNickname());
        if ($request->getExtra()) {
            $entity->setExtra(json_encode($request->getExtra()));
        }
        /** @var AccountEntity $entity */
        $entity = $this->accountDao->save($entity);
        
        return $entity;
    }
    
    /**
     * 删除管理账户
     *
     * @param int $id
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     * @throws \App\Exception\NotFoundException
     */
    public function deleteAccount(int $id) : bool
    {
        $entity = $this->findOrFail($id);
        
        $entity->setIsDeleted(BoolEnum::TRUE);
        $this->accountDao->save($entity);
        
        return true;
    }
    
    /**
     * 重新启用管理账户
     *
     * @param int $id
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     * @throws \App\Exception\NotFoundException
     */
    public function enableAccount(int $id) : bool
    {
        $entity = $this->findOrFail($id);
        
        $entity->setIsDeleted(BoolEnum::FALSE);
        $this->accountDao->save($entity);
        
        return true;
    }
    
    /**
     * 获取账户，账户不存在时抛出异常
     *
     * @param int $id
     * @return \App\Model\Entity\Permission\AccountEntity
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     * @throws \App\Exception\NotFoundException
     */
    public function findOrFail(int $id) : AccountEntity
    {
        /** @var AccountEntity $entity */
        $entity = $this->accountDao->find($id);
        if ($entity === null) {
            throw new NotFoundException('账户不存在');
        }
        
        return $entity;
    }
    
    /**
     * 当前用户拥有的角色
     *
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     */
    public function getCurrentAccountRoles() : Collection
    {
        return AccountRoleLogic::instance()->getUserRoleByAccId(1);
    }
    
    /**
     * 当前用户拥有的角色ID
     *
     * @return int[]
     * @throws \ReflectionException
     */
    public function getCurrentAccountRoleIds() : array
    {
        return $this->getCurrentAccountRoles()->pluck('role_id')->toArray();
    }
}
