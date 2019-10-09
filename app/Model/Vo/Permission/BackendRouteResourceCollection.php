<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Lib\Annotation\Mapping\POJO;
use Happysir\Lib\BasePOJOCollection;

/**
 * Class BackendRouteResource
 * @POJO()
 */
class BackendRouteResourceCollection extends BasePOJOCollection
{
    protected $POJOClass = BackendRouteResource::class;
}
