<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Respository\Concern\Searcher;

/**
 * Class RolePageSearcher
 */
class AccountPageSearcher extends Searcher
{
    /**
     * 账户昵称
     * @var string
     */
    protected $nickname = '';
    
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
}
