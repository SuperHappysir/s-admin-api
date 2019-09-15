<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Lib\Concern\Fluent;

/**
 * Class BackEndApiField
 */
class BackEndApiField extends Fluent
{
    /**
     * 权限ID
     *
     * @var int
     */
    protected $resourceId = 0;
    
    /**
     * api_per_id
     *
     * @var int
     */
    protected $apiPerId;
    
    /**
     * field_key
     *
     * @var string
     */
    protected $fieldKey = '';
    
    /**
     * field_name
     *
     * @var string
     */
    protected $fieldName = '';
    
    /**
     * field_desc
     *
     * @var string
     */
    protected $fieldDesc = '';
    
    /**
     * getFieldKey
     *
     * @return string
     */
    public function getFieldKey() : string
    {
        return $this->fieldKey;
    }
    
    /**
     * @param string $fieldKey
     */
    public function setFieldKey(string $fieldKey) : void
    {
        $this->fieldKey = $fieldKey;
    }
    
    /**
     * getFieldName
     *
     * @return string
     */
    public function getFieldName() : string
    {
        return $this->fieldName;
    }
    
    /**
     * @param string $fieldName
     */
    public function setFieldName(string $fieldName) : void
    {
        $this->fieldName = $fieldName;
    }
    
    /**
     * getFieldDesc
     *
     * @return string
     */
    public function getFieldDesc() : string
    {
        return $this->fieldDesc;
    }
    
    /**
     * @param string $fieldDesc
     */
    public function setFieldDesc(string $fieldDesc) : void
    {
        $this->fieldDesc = $fieldDesc;
    }
    
    /**
     * getApiPerId
     *
     * @return int
     */
    public function getApiPerId() : int
    {
        return $this->apiPerId;
    }
    
    /**
     * @param int $apiPerId
     */
    public function setApiPerId(int $apiPerId) : void
    {
        $this->apiPerId = $apiPerId;
    }
    
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
}
