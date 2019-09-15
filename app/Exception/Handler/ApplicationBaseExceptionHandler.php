<?php declare(strict_types = 1);

namespace App\Exception\Handler;

use App\Exception\ApplicationApplicationBaseException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Throwable;

/**
 * Class ApiExceptionHandler
 *
 * @ExceptionHandler(ApplicationApplicationBaseException::class)
 */
class ApplicationApplicationBaseExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $except
     * @param Response  $response
     *
     * @return Response
     */
    public function handle(Throwable $except, Response $response) : Response
    {
        $data = [
            'code'  => $except->getCode(),
            'error' => sprintf('(%s) %s', get_class($except), $except->getMessage()),
            'file'  => sprintf('At %s line %d', $except->getFile(), $except->getLine()),
            'trace' => $except->getTraceAsString(),
        ];
        
        return $response->withData($data);
    }
}
