<?php

namespace FwsReCaptchaV2\Form\View\Helper\Service;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use FwsReCaptchaV2\Form\Element\ReCaptchaV2 as ReCaptchaV2FormElement;
use FwsReCaptchaV2\Form\View\Helper\FormReCaptchaV2;
use Laminas\Form\View\Helper\FormElement;

/**
 * FormElementFactory
 *
 * @author Garry Childs (info@freedomwebservices.net)
 */
class FormElementFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $helper = new FormElement();
        $helper->addClass(ReCaptchaV2FormElement::class, FormReCaptchaV2::class);
        return $helper;
    }

}
