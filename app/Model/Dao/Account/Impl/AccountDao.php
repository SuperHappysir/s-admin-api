<?php declare(strict_types = 1);

namespace App\Model\Dao\Account\Impl;

use App\Model\Dao\AbstractDao;
use App\Model\Dao\Account\AccountDaoInterface;
use App\Model\Entity\Rbac\Account;
use App\Model\Vo\Permission\AccountPageSearcher;
use Happysir\Respository\Concern\Paginator;
use Swoft\Bean\Annotation\Mapping\Bean;

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
        return Account::class;
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
        
        return $this->getPaginator(
            $builder,
            $searchDto
        );
    }
}
