<?php declare(strict_types = 1);

namespace App\Model\Entity\Permission;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;

/**
 * API路由权限表
 * Class ApiPermissionResource
 *
 * @since 2.0
 *
 * @Entity(table="rbac_api_resource")
 */
class ApiResourceEntity extends Model
{
    /**
     * API 权限ID
     * @Id()
     * @Column(name="id", prop="id")
     *
     * @var int
     */
    private $id;
    
    /**
     * 接口名称
     *
     * @Column(name="api_name", prop="api_name")
     *
     * @var string
     */
    private $apiName;
    
    /**
     * 请求名称  GET POST DELETE PUT
     *
     * @Column(name="request_method", prop="request_method")
     *
     * @var string
     */
    private $requestMethod;
    
    /**
     * 路径
     *
     * @Column(name="uri", prop="uri")
     *
     * @var string
     */
    private $uri;
    
    /**
     * 扩展字段
     *
     * @Column()
     *
     * @var string
     */
    private $extra;
    
    /**
     * 删除标识 0-未删除 1-已删除
     *
     * @Column(name="is_deleted", prop="is_deleted")
     *
     * @var int
     */
    private $isDeleted;
    
    /**
     * 数据创建时间
     *
     * @Column(name="created_at", prop="created_at")
     *
     * @var string
     */
    private $createdAt;
    
    /**
     * 更新时间
     *
     * @Column(name="updated_at", prop="updated_at")
     *
     * @var string
     */
    private $updatedAt;
    
    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    
    /**
     * @param string $apiName
     *
     * @return void
     */
    public function setApiName(string $apiName) : void
    {
        $this->apiName = $apiName;
    }
    
    /**
     * @param string $requestMethod
     *
     * @return void
     */
    public function setRequestMethod(string $requestMethod) : void
    {
        $this->requestMethod = $requestMethod;
    }
    
    /**
     * @param string $uri
     *
     * @return void
     */
    public function setUri(string $uri) : void
    {
        $this->uri = $uri;
    }
    
    /**
     * @param string $extra
     *
     * @return void
     */
    public function setExtra(string $extra) : void
    {
        $this->extra = $extra;
    }
    
    /**
     * @param int $isDeleted
     *
     * @return void
     */
    public function setIsDeleted(int $isDeleted) : void
    {
        $this->isDeleted = $isDeleted;
    }
    
    /**
     * @param string $createdAt
     *
     * @return void
     */
    public function setCreatedAt(string $createdAt) : void
    {
        $this->createdAt = $createdAt;
    }
    
    /**
     * @param string $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(string $updatedAt) : void
    {
        $this->updatedAt = $updatedAt;
    }
    
    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getApiName() : ?string
    {
        return $this->apiName;
    }
    
    /**
     * @return string
     */
    public function getRequestMethod() : ?string
    {
        return $this->requestMethod;
    }
    
    /**
     * @return string
     */
    public function getUri() : ?string
    {
        return $this->uri;
    }
    
    /**
     * @return string
     */
    public function getExtra() : ?string
    {
        return $this->extra;
    }
    
    /**
     * @return int
     */
    public function getIsDeleted() : ?int
    {
        return $this->isDeleted;
    }
    
    /**
     * @return string
     */
    public function getCreatedAt() : ?string
    {
        return $this->createdAt;
    }
    
    /**
     * @return string
     */
    public function getUpdatedAt() : ?string
    {
        return $this->updatedAt;
    }
    
}
