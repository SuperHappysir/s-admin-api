<?php declare(strict_types = 1);

namespace App\Annotation\Parser;

use App\Annotation\Mapping\PermissionResource;
use Applications\Common\Register\PermissionResourceRegister;
use Swoft\Annotation\Annotation\Mapping\AnnotationParser;
use Swoft\Annotation\Annotation\Parser\Parser;

/**
 * Class PermissionResourceParser
 *
 * @AnnotationParser(PermissionResource::class)
 * @package Applications\Annotation\Parser
 */
class PermissionResourceParser extends Parser
{
    /**
     * Parse object
     *
     * @param int                $type             Class or Method or Property
     * @param PermissionResource $annotationObject Annotation object
     *
     * @return array
     */
    public function parse(int $type, $annotationObject) : array
    {
        if ($type !== self::TYPE_METHOD) {
            return [];
        }
        
        PermissionResourceRegister::registerPermissionResource(
            $this->className,
            $this->methodName,
            $annotationObject
        );
        
        return [];
    }
}
