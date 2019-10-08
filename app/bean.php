<?php

use Swoft\Db\Database;
use Swoft\Http\Server\HttpServer;
use Swoft\Redis\RedisDb;

return [
    'logger'     => [
        'flushRequest' => false,
        'enable'       => false,
        'json'         => false,
    ],
    'httpServer' => [
        'class'   => HttpServer::class,
        'port'    => 18306,
        /* @see HttpServer::$setting */
        'setting' => [
            'worker_num' => 8,
        ]
    ],
    'db'         => [
        'class'    => Database::class,
        'dsn'      => 'mysql:dbname=s-admin;host=127.0.0.1',
        'username' => 'root',
        'password' => '123456',
        'charset'  => 'utf8mb4',
        'options'  => [
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
        ],
        'config'   => [
            'collation' => 'utf8mb4_unicode_ci',
            'strict'    => false,
            'timezone'  => '+8:00',
            'modes'     => 'NO_ENGINE_SUBSTITUTION,STRICT_TRANS_TABLES',
        ],
    ],
    'redis'      => [
        'class'    => RedisDb::class,
        'host'     => '127.0.0.1',
        'port'     => 6379,
        'database' => 0,
        'option'   => [
            'prefix'     => 'swoft:',
            'serializer' => Redis::SERIALIZER_NONE
        ]
    ],
];
