<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomizeFormatter
 *
 * @author aginp
 */
namespace App\Logging;

use Monolog\Handler\SlackHandler;
use Monolog\Logger;

class CustomizeFormatter
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        if ('production' === config('app.env')) {
            $slackHandler = new SlackHandler('xoxp-610462606865-616745627141-605326308659-128e311038b81306ec404bb0554bdaef',
                '#reference-app-lav-8', 'AG-Live-Error-Handler', true,
                ':beetle:', Logger::ERROR, true, false, true);
            $logger->pushHandler($slackHandler);
        } else {
            $slackHandler = new SlackHandler('xoxp-610462606865-616745627141-605326308659-128e311038b81306ec404bb0554bdaef',
                '#reference-app-lav-8', 'AG-Local-Error-Handler', true,
                ':see_no_evil:', Logger::ERROR, true, false, true);
            $logger->pushHandler($slackHandler);
        }
    }

}
