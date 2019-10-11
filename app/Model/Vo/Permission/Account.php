<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use App\Model\Entity\Permission\AccountEntity;
use Happysir\Lib\Annotation\Mapping\POJO;
use Happysir\Lib\BasePOJO;

/**
 * Class Account
 * @POJO()
 */
class Account extends BasePOJO
{
    /**
     * 用户昵称
     *
     * @var string
     */
    private $nickname = '';
    
    /**
     * 扩展字段
     *
     * @var array
     */
    private $extra = [];
    
    /**
     * getNickname
     *
     * @return string
     */
    public function getNickname() : string
    {
        return $this->nickname;
    }
    
    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname) : void
    {
        $this->nickname = $nickname;
    }
    
    /**
     * getExtra
     *
     * @return array
     */
    public function getExtra() : array
    {
        return $this->extra;
    }
    
    /**
     * @param array $extra
     */
    public function setExtra(array $extra) : void
    {
        $this->extra = $extra;
    }
    
    /**
     * @return \App\Model\Entity\Permission\AccountEntity
     *
     * @throws \Swoft\Db\Exception\DbException
     */
    public function convertTo() : AccountEntity
    {
        return AccountEntity::new($this->toArray());
    }
    
    /**
     * @param \App\Model\Entity\Permission\AccountEntity $accountEntity
     * @return $this
     * @throws \Swoft\Db\Exception\DbException
     */
    public static function convertFrom(AccountEntity $accountEntity) : self
    {
        return self::new($accountEntity->toArray());
    }
}
