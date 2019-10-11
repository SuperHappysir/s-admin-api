<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Lib\Annotation\Mapping\POJO;
use Happysir\Lib\BasePOJOCollection;

/**
 * Class BackendApiResourceCollection
 * @POJO()
 */
class BackendApiResourceCollection extends BasePOJOCollection
{
    protected $POJOClass = BackendApiResource::class;
}
