<?php declare(strict_types = 1);

namespace App\Model\Vo\Permission;

use Happysir\Lib\Concern\Fluent;

/**
 * Class Account
 */
class Account extends Fluent
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
}
