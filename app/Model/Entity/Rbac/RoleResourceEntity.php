<?php declare(strict_types=1);


namespace App\Model\Entity\Rbac;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 角色资源关联表
 * Class RoleResource
 *
 * @since 2.0
 *
 * @Entity(table="rbac_role_resource")
 */
class RoleResourceEntity extends Model
{
    /**
     * 关联关系ID
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 角色ID
     *
     * @Column(name="role_id", prop="role_id")
     *
     * @var int
     */
    private $roleId;

    /**
     * 资源类型 1 前端 2接口 3接口字段
     *
     * @Column(name="resource_type", prop="resource_type")
     *
     * @var int
     */
    private $resourceType;

    /**
     * 资源ID(如：接口、菜单等，在同一类型下下唯一)
     *
     * @Column(name="resource_id", prop="resource_id")
     *
     * @var int
     */
    private $resourceId;

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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int $roleId
     *
     * @return void
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @param int $resourceType
     *
     * @return void
     */
    public function setResourceType(int $resourceType): void
    {
        $this->resourceType = $resourceType;
    }

    /**
     * @param int $resourceId
     *
     * @return void
     */
    public function setResourceId(int $resourceId): void
    {
        $this->resourceId = $resourceId;
    }

    /**
     * @param int $isDeleted
     *
     * @return void
     */
    public function setIsDeleted(int $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @param string $createdAt
     *
     * @return void
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param string $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @return int
     */
    public function getResourceType(): ?int
    {
        return $this->resourceType;
    }

    /**
     * @return int
     */
    public function getResourceId(): ?int
    {
        return $this->resourceId;
    }

    /**
     * @return int
     */
    public function getIsDeleted(): ?int
    {
        return $this->isDeleted;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

}
