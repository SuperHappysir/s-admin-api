<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Lib\Annotation\Mapping\Filed;
use Happysir\Lib\Annotation\Mapping\POJO;
use Happysir\Respository\Concern\Searcher;

/**
 * Class RolePageSearcher
 * @POJO()
 */
class AccountPageSearcher extends Searcher
{
    /**
     * 账户昵称
     *
     * @var string
     */
    protected $nickname = '';
    
    /**
     * 账户昵称
     * @Filed(name="account_id",prop="account_id")
     *
     * @var string
     */
    protected $accountId = '';
    
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
     * getId
     *
     * @return string
     */
    public function getAccountId() : string
    {
        return $this->accountId;
    }
    
    /**
     * @param string $accountId
     */
    public function setAccountId(string $accountId) : void
    {
        $this->accountId = $accountId;
    }
}
