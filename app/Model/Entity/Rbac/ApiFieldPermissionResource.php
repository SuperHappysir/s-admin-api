<?php declare(strict_types=1);


namespace App\Model\Entity\Rbac;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * API 字段权限表
 * Class ApiFieldPermissionResource
 *
 * @since 2.0
 *
 * @Entity(table="a_api_field_permission_resource")
 */
class ApiFieldPermissionResource extends Model
{
    /**
     * API 接口字段权限ID
     * @Id()
     * @Column(name="id", prop="id")
     *
     * @var int
     */
    private $id;

    /**
     * API 权限ID
     *
     * @Column(name="api_per_id", prop="api_per_id")
     *
     * @var int
     */
    private $apiPerId;

    /**
     * 字段key
     *
     * @Column(name="field_key", prop="field_key")
     *
     * @var string
     */
    private $fieldKey;

    /**
     * 字段名称
     *
     * @Column(name="field_name", prop="field_name")
     *
     * @var string
     */
    private $fieldName;

    /**
     * 字段描述
     *
     * @Column(name="field_desc", prop="field_desc")
     *
     * @var string
     */
    private $fieldDesc;
    
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
     * @param int $apiPerId
     *
     * @return void
     */
    public function setApiPerId(int $apiPerId): void
    {
        $this->apiPerId = $apiPerId;
    }

    /**
     * @param string $fieldKey
     *
     * @return void
     */
    public function setFieldKey(string $fieldKey): void
    {
        $this->fieldKey = $fieldKey;
    }

    /**
     * @param string $fieldName
     *
     * @return void
     */
    public function setFieldName(string $fieldName): void
    {
        $this->fieldName = $fieldName;
    }

    /**
     * @param string $fieldDesc
     *
     * @return void
     */
    public function setFieldDesc(string $fieldDesc): void
    {
        $this->fieldDesc = $fieldDesc;
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
    public function getApiPerId(): ?int
    {
        return $this->apiPerId;
    }

    /**
     * @return string
     */
    public function getFieldKey(): ?string
    {
        return $this->fieldKey;
    }

    /**
     * @return string
     */
    public function getFieldName(): ?string
    {
        return $this->fieldName;
    }

    /**
     * @return string
     */
    public function getFieldDesc(): ?string
    {
        return $this->fieldDesc;
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
