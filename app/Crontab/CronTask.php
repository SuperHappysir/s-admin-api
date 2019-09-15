<?php declare(strict_types = 1);

namespace App\Crontab;

use Exception;
use Swoft\Crontab\Annotaion\Mapping\Cron;
use Swoft\Crontab\Annotaion\Mapping\Scheduled;
use Swoft\Log\Helper\Log;

/**
 * Class CronTask
 *
 * @since 2.0
 *
 * @Scheduled()
 */
class CronTask
{
    /**
     * @Cron("* * * * * *")
     *
     * @throws Exception
     */
    public function secondTask()
    {
        Log::info('info message', ['a' => 'b']);
    }
}
