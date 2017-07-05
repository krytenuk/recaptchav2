<?php

namespace FwsReCaptchaV2;

use Zend\Mvc\MvcEvent;
use FwsLogger\EmailLogger;
use FwsLogger\InfoLogger;
use FwsLogger\ErrorLogger;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
