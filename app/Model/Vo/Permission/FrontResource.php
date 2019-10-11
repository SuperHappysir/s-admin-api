<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use App\Model\Entity\Permission\FrontResourceEntity;
use Happysir\Lib\Annotation\Mapping\POJO;
use Happysir\Lib\BasePOJO;

/**
 * Class FrontResource
 * @POJO()
 */
class FrontResource extends BasePOJO
{
    /**
     * 权限ID
     *
     * @var int
     */
    private $resourceId = 0;
    
    /**
     * front_name
     *
     * @var string
     */
    private $frontName = '';
    
    /**
     * component_name
     *
     * @var string
     */
    private $componentName = '';
    
    /**
     * front_type 0 导航 1 按钮
     *
     * @var string
     */
    private $frontType = 0;
    
    /**
     * extra
     *
     * @var array
     */
    private $extra = [];
    
    /**
     * getResourceId
     *
     * @return int
     */
    public function getResourceId() : int
    {
        return $this->resourceId;
    }
    
    /**
     * @param int $resourceId
     */
    public function setResourceId(int $resourceId) : void
    {
        $this->resourceId = $resourceId;
    }
    
    /**
     * getFrontName
     *
     * @return string
     */
    public function getFrontName() : string
    {
        return $this->frontName;
    }
    
    /**
     * @param string $frontName
     */
    public function setFrontName(string $frontName) : void
    {
        $this->frontName = $frontName;
    }
    
    /**
     * getComponentName
     *
     * @return string
     */
    public function getComponentName() : string
    {
        return $this->componentName;
    }
    
    /**
     * @param string $componentName
     */
    public function setComponentName(string $componentName) : void
    {
        $this->componentName = $componentName;
    }
    
    /**
     * getFrontType
     *
     * @return string
     */
    public function getFrontType() : string
    {
        return $this->frontType;
    }
    
    /**
     * @param string $frontType
     */
    public function setFrontType(string $frontType) : void
    {
        $this->frontType = $frontType;
    }
    
    /**
     * getExtra
     *
     * @return array
     */
    public function getExtra() : array
    {
        return $this->extra;
    }
    
    /**
     * @param array $extra
     */
    public function setExtra(array $extra) : void
    {
        $this->extra = $extra;
    }
    
    /**
     * @return \App\Model\Entity\Permission\FrontResourceEntity
     * @throws \Swoft\Db\Exception\DbException
     */
    public function convertTo() : FrontResourceEntity
    {
        return FrontResourceEntity::new($this->toArray());
    }
    
    /**
     * @param \App\Model\Entity\Permission\FrontResourceEntity $resourceEntity
     * @return $this
     * @throws \Swoft\Db\Exception\DbException
     */
    public static function convertFrom(FrontResourceEntity $resourceEntity) : self
    {
        return self::new($resourceEntity->toArray());
    }
}
