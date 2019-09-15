<?php declare(strict_types = 1);

namespace App\Model\Dao;

use Happysir\Respository\Concern\Paginator;
use Happysir\Respository\Concern\Searcher;
use Happysir\Respository\Respository;
use Swoft\Db\Eloquent\Builder as EloquentBuilder;
use Swoft\Db\Query\Builder;
use Swoft\Db\Schema\Builder as SchemaBuilder;

/**
 * Class AbstractDao
 *
 */
abstract class AbstractDao extends Respository
{
    /**
     * @param Builder|EloquentBuilder|SchemaBuilder  $queryBuilder
     * @param \Happysir\Respository\Concern\Searcher $searcher
     * @param array                                  $columns
     * @return Paginator
     */
    protected function getPaginator(
        $queryBuilder,
        Searcher $searcher,
        array $columns = ['*']
    ) : Paginator {
        $paginator = $queryBuilder->paginate($searcher->getPage(), $searcher->getPageSize(), $columns);
        
        return new Paginator(
            $paginator['count'],
            $searcher->getPageSize(),
            $searcher->getPage(),
            $paginator['pageCount'],
            $paginator['list']
        );
    }
}
