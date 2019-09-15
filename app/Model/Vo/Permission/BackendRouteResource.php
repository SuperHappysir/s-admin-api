<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Lib\Concern\Fluent;

/**
 * Class BackendRouteResource
 */
class BackendRouteResource extends Fluent
{
    /**
     * 权限ID
     *
     * @var int
     */
    private $resourceId = 0;
    
    /**
     * 接口名称
     *
     * @var string
     */
    private $apiName = '';
    
    /**
     * 请求名称
     *
     * @var string
     */
    private $requestMethod = '';
    
    /**
     * 路径
     *
     * @var string
     */
    private $apiUrl = '';
    
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
    public function getApiUrl() : string
    {
        return $this->apiUrl;
    }
    
    /**
     * @param string $apiUrl
     */
    public function setApiUrl(string $apiUrl) : void
    {
        $this->apiUrl = $apiUrl;
    }
}
