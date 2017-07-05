<?php

return [
    'validators' => [
        'invokables' => [
            'FwsReCaptchaV2' => 'FwsReCaptchaV2\Validator\ReCaptchaV2',
        ],
    ],
    'form_elements' => [
        'invokables' => [
            'FwsReCaptchaV2' => 'FwsReCaptchaV2\Form\Element\ReCaptchaV2',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'formFwsReCaptchaV2' => 'FwsReCaptchaV2\Form\View\Helper\FormReCaptchaV2',
        ],
        'factories' => [
            'formElement' => function($sm) {
                $helper = new \Zend\Form\View\Helper\FormElement();
                $helper->addClass('FwsReCaptchaV2\Form\Element\ReCaptchaV2', 'formFwsReCaptchaV2');
                return $helper;
            }
        ],
    ],
];
