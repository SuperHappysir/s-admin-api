<?php declare(strict_types = 1);

namespace App\Annotation\Mapping;

use App\Common\Enum\Permission\AuthTypeEnum;
use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class PermissionResource
 *
 * @Annotation
 * @Target("METHOD")
 * @Attributes({
 *     @Attribute("name", type="string", required=true),
 *     @Attribute("authType", type="int"),
 * })
 */
final class PermissionResource
{
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var int
     */
    protected $authType = AuthTypeEnum::LOGIN;
    
    /**
     * PermissionResource constructor.
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        if (isset($values['name'])) {
            $this->name = $values['name'];
        }
        if (isset($values['authType'])
            && AuthTypeEnum::isValidValue($values['authType'])) {
            $this->authType = (int)$values['authType'];
        }
    }
    
    /**
     * getName
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    
    /**
     * getAuthType
     *
     * @return int
     */
    public function getAuthType() : int
    {
        return $this->authType;
    }
    
    public function toArray() : array
    {
        return [
            'name'     => $this->name,
            'authType' => $this->authType
        ];
    }
}
