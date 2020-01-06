<?php

use Laminas\ServiceManager\Factory\InvokableFactory;
use FwsReCaptchaV2\Validator\ReCaptchaV2 as ReCaptchaV2Validator;
use FwsReCaptchaV2\Form\Element\ReCaptchaV2 as ReCaptchaV2FormElement;
use FwsReCaptchaV2\Form\View\Helper\FormReCaptchaV2;
use Laminas\Form\View\Helper\FormElement;
use FwsReCaptchaV2\Form\View\Helper\Service\FormElementFactory;

return [
    'validators' => [
        'factories' => [
            ReCaptchaV2Validator::class => InvokableFactory::class,
        ],
        'aliases' => [
            'FwsReCaptchaV2' => ReCaptchaV2Validator::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            ReCaptchaV2FormElement::class => InvokableFactory::class,
        ],
        'aliases' => [
            'FwsReCaptchaV2' => ReCaptchaV2FormElement::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            FormReCaptchaV2::class => InvokableFactory::class,
            FormElement::class => FormElementFactory::class,
        ],
        'aliases' => [
            'formFwsReCaptchaV2' => FormReCaptchaV2::class,
        ],
    ],
];
