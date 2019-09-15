<?php declare(strict_types=1);


namespace App\Model\Entity\Rbac;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 管理账户与角色关联表
 * Class AccountRole
 *
 * @since 2.0
 *
 * @Entity(table="a_account_role")
 */
class AccountRole extends Model
{
    /**
     * 自增ID
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 账户ID
     *
     * @Column(name="account_id", prop="account_id")
     *
     * @var int
     */
    private $accountId;

    /**
     * 角色ID
     *
     * @Column(name="role_id", prop="role_id")
     *
     * @var int
     */
    private $roleId;
    
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
     * @param int $accountId
     *
     * @return void
     */
    public function setAccountId(int $accountId): void
    {
        $this->accountId = $accountId;
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
    public function getAccountId(): ?int
    {
        return $this->accountId;
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
