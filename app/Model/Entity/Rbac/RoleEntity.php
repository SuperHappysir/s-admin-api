<?php declare(strict_types=1);


namespace App\Model\Entity\Rbac;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 角色表
 * Class Role
 *
 * @since 2.0
 *
 * @Entity(table="rbac_role")
 */
class RoleEntity extends Model
{
    /**
     * 角色id
     * @Id()
     * @Column(name="role_id", prop="role_id")
     *
     * @var int
     */
    private $roleId;

    /**
     * 角色昵称
     *
     * @Column(name="role_name", prop="role_name")
     *
     * @var string
     */
    private $roleName;

    /**
     * 角色描述
     *
     * @Column(name="role_describe", prop="role_describe")
     *
     * @var string
     */
    private $roleDescribe;
    
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
     * @param int $roleId
     *
     * @return void
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @param string $roleName
     *
     * @return void
     */
    public function setRoleName(string $roleName): void
    {
        $this->roleName = $roleName;
    }

    /**
     * @param string $roleDescribe
     *
     * @return void
     */
    public function setRoleDescribe(string $roleDescribe): void
    {
        $this->roleDescribe = $roleDescribe;
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
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @return string
     */
    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    /**
     * @return string
     */
    public function getRoleDescribe(): ?string
    {
        return $this->roleDescribe;
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
