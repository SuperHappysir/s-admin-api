<?php declare(strict_types = 1);

namespace App\Listener;

use App\Model\Logic\Permission\Resource\RouteResourceLogic;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Server\SwooleEvent;

/**
 * Class RanListener
 *
 * @since 2.0
 *
 * @Listener(SwooleEvent::WORKER_START)
 */
class WorkerStartListener implements EventHandlerInterface
{
    /**
     * @param EventInterface $event
     * @throws \App\Exception\InvalidParamException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function handle(EventInterface $event) : void
    {
        if ($event->workerId === 1) {
            vdump($event);
            RouteResourceLogic::instance()->updateApiRouteResource();
        }
    }
}
