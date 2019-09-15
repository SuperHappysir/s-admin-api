<?php declare(strict_types = 1);

namespace App\Model\Dao\Account;

use App\Model\Dao\Account\Impl\AccountDao;
use App\Model\Dao\DaoInterface;
use App\Model\Vo\Permission\AccountPageSearcher;
use Happysir\Respository\Concern\Paginator;
use Swoft\Db\Eloquent\Collection;

/**
 * Interface AccountDaoInterface
 *
 * ${CARET}
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
}
