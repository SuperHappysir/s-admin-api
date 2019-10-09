<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Lib\Annotation\Mapping\POJO;
use Happysir\Respository\Concern\Searcher;

/**
 * Class RolePageSearcher
 * @POJO()
 */
class RolePageSearcher extends Searcher
{
    /**
     * 角色ID
     *
     * @var int
     */
    private $id = 0;
    
    /**
     * 角色昵称
     *
     * @var string
     */
    private $name = '';
    
    /**
     * getId
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    
    /**
     * getName
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }
    
}
