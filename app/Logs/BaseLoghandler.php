<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/3
 * Time: 18:35
 */

namespace App\Logs;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


class BaseLoghandler
{
    protected $logger;

    protected $level;

    public function __construct($level='WARNING')
    {
        $this->logger = new Logger('login_logger');
        $this->logger->pushHandler(new StreamHandler(config('login.log.file'), 100));
        $this->logger->pushHandler(new FirePHPHandler());
}

    public function write($msg)
    {
        $this->logger->info($msg);
    }
}