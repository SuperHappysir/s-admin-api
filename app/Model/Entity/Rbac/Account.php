<?php declare(strict_types=1);


namespace App\Model\Entity\Rbac;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 管理账户表
 * Class Account
 *
 * @since 2.0
 *
 * @Entity(table="a_account")
 */
class Account extends Model
{
    /**
     * 账户id
     * @Id()
     * @Column(name="account_id", prop="account_id")
     *
     * @var int
     */
    private $accountId;

    /**
     * 用户昵称
     *
     * @Column()
     *
     * @var string
     */
    private $nickname;

    /**
     * 删除标识 0-未删除 1-已删除
     *
     * @Column(name="is_deleted", prop="is_deleted")
     *
     * @var int
     */
    private $isDeleted;

    /**
     * 扩展字段
     *
     * @Column()
     *
     * @var string
     */
    private $extra;

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
     * @param int $accountId
     *
     * @return void
     */
    public function setAccountId(int $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @param string $nickname
     *
     * @return void
     */
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
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
     * @param string $extra
     *
     * @return void
     */
    public function setExtra(string $extra): void
    {
        $this->extra = $extra;
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
    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
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
    public function getExtra(): ?string
    {
        return $this->extra;
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
