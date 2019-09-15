<?php declare(strict_types=1);


namespace App\Model\Entity\Rbac;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 前端权限控制表
 * Class FrontPermissionResource
 *
 * @since 2.0
 *
 * @Entity(table="a_front_permission_resource")
 */
class FrontPermissionResource extends Model
{
    /**
     * 前端权限ID
     * @Id()
     * @Column(name="front_per_id", prop="front_per_id")
     *
     * @var int
     */
    private $frontPerId;

    /**
     * 名称
     *
     * @Column(name="front_name", prop="front_name")
     *
     * @var string
     */
    private $frontName;

    /**
     * 授权标志/路径
     *
     * @Column(name="component_name", prop="component_name")
     *
     * @var string
     */
    private $componentName;

    /**
     * 0 ?? 1 ??
     *
     * @Column(name="front_type", prop="front_type")
     *
     * @var int
     */
    private $frontType;

    /**
     * 导航 1 按钮
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
     * @param int $frontPerId
     *
     * @return void
     */
    public function setFrontPerId(int $frontPerId): void
    {
        $this->frontPerId = $frontPerId;
    }

    /**
     * @param string $frontName
     *
     * @return void
     */
    public function setFrontName(string $frontName): void
    {
        $this->frontName = $frontName;
    }

    /**
     * @param string $componentName
     *
     * @return void
     */
    public function setComponentName(string $componentName): void
    {
        $this->componentName = $componentName;
    }

    /**
     * @param int $frontType
     *
     * @return void
     */
    public function setFrontType(int $frontType): void
    {
        $this->frontType = $frontType;
    }

    /**
     * @param string $extra
     *
     * @return void
     */
    public function setExtra(string $extra): void
    {
        $this->extra = $extra;
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
    public function getFrontPerId(): ?int
    {
        return $this->frontPerId;
    }

    /**
     * @return string
     */
    public function getFrontName(): ?string
    {
        return $this->frontName;
    }

    /**
     * @return string
     */
    public function getComponentName(): ?string
    {
        return $this->componentName;
    }

    /**
     * @return int
     */
    public function getFrontType(): ?int
    {
        return $this->frontType;
    }

    /**
     * @return string
     */
    public function getExtra(): ?string
    {
        return $this->extra;
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
