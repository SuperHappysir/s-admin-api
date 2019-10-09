<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use App\Model\Entity\Rbac\ApiResourceEntity;
use Happysir\Lib\Annotation\Mapping\Filed;
use Happysir\Lib\Annotation\Mapping\POJO;
use Happysir\Lib\BasePOJO;

/**
 * Class BackendRouteResource
 * @POJO()
 */
class BackendRouteResource extends BasePOJO
{
    /**
     * 权限ID
     * @Filed(name="id",prop="id")
     *
     * @var int
     */
    private $resourceId = 0;
    
    /**
     * 接口名称
     * @Filed(name="api_name",prop="api_name")
     *
     * @var string
     */
    private $apiName = '';
    
    /**
     * 请求名称
     * @Filed(name="request_method",prop="request_method")
     *
     * @var string
     */
    private $requestMethod = '';
    
    /**
     * 路径
     * @Filed(name="uri",prop="uri")
     *
     * @var string
     */
    private $uri = '';
    
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
     * getApiName
     *
     * @return string
     */
    public function getApiName() : string
    {
        return $this->apiName;
    }
    
    /**
     * @param string $apiName
     */
    public function setApiName(string $apiName) : void
    {
        $this->apiName = $apiName;
    }
    
    /**
     * getRequestMethod
     *
     * @return string
     */
    public function getRequestMethod() : string
    {
        return $this->requestMethod;
    }
    
    /**
     * @param string $requestMethod
     */
    public function setRequestMethod(string $requestMethod) : void
    {
        $this->requestMethod = $requestMethod;
    }
    
    /**
     * getApiUrl
     *
     * @return string
     */
    public function getUri() : string
    {
        return $this->uri;
    }
    
    /**
     * @param string $uri
     */
    public function setUri(string $uri) : void
    {
        $this->uri = $uri;
    }
    
    /**
     * @return \App\Model\Entity\Rbac\ApiResourceEntity
     * @throws \Swoft\Db\Exception\DbException
     */
    public function convertToApiPermissionResourceEntity() : ApiResourceEntity
    {
        return ApiResourceEntity::new($this->toArray());
    }
    
    /**
     * @param \App\Model\Entity\Rbac\ApiResourceEntity $resourceEntity
     * @return $this
     * @throws \Swoft\Db\Exception\DbException
     */
    public static function convertFrom(ApiResourceEntity $resourceEntity) : self
    {
        return self::new($resourceEntity->toArray());
    }
}
