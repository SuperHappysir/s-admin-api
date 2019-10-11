<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Lib\Annotation\Mapping\POJO;
use Happysir\Lib\BasePOJOCollection;

/**
 * Class FrontResourceCollection
 * @POJO()
 */
class FrontResourceCollection extends BasePOJOCollection
{
    protected $POJOClass = FrontResource::class;
}
