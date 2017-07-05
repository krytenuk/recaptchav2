FwsLogger
============

ZF2 Google ReCaptcha version 2 form element, view helper and validator module

This module simplifies intergrating ReCaptcha V2 in your forms.

Note: The view helper requires jQuery.

Installation
------------

### Main Setup

#### By cloning project

1. Install [FwsReCaptchaV2](https://github.com/krytenuk/recaptchav2) ZF2 module
   by cloning it into `./vendor/`.
2. Clone this project into your `./vendor/` directory.

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "krytenuk/recaptchav2": "1.*"
    }
    ```

2. Now tell composer to download FwsReCaptchaV2 by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'FwsReCaptchaV2',
        ),
        // ...
    );
    ```


### Usage

I assume that you are familiar with Zend Form, if not then please read the docs at https://docs.zendframework.com/.

The view helper requires jQuery, please ensure that it is available client side, use the following in your layout file.

<?php echo $this->headScript()->prependFile('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'); ?>

Firstly you need a Google account, once logged in goto https://www.google.com/recaptcha/admin#list and add your web site and domain name(s) to get your public and private keys.

In your form add the FwsReCaptchaV2 form element in the init() method.
example:

$this->add(array(
    'name' => 'reCaptcha',
    'type' => 'FwsReCaptchaV2',
    'options' => array(
        'label' => _('Verify:'),
        'label_attributes' => array('class' => 'required'),
        'pubKey' => 'Your ReCaptcha public key',
    ),
));

and register the validator in your forms getInputFilterSpecification() method.

return array(
    'reCaptcha' => array(
        'required' => TRUE,
        'validators' => array(
            array(
                'name' => 'FwsReCaptchaV2',
                'options' => array(
                    'priKey' => 'Your ReCaptcha private key',
                ),
            ),
        ),
    ),
);

Finally to render your the element either use the formRow(), formElement() or formFwsReCaptchaV2() view helper.
example:

<?php echo $this->formFwsReCaptchaV2($this->form->get('reCaptcha')); ?>

The FwsReCaptchaV2\Form\Element\ReCaptchaV2 has the following options.

'pubKey'            Sets your reCaptcha public key (required).
'tag'               The element used to contain the reCaptcha html code.  Currently supports 'div' (default) and 'span'.
'reCaptchaClass'    Should not need to be changed, defaults to 'g-recaptcha'.
'theme'             The reCaptcha theme, 'light' (default) or 'dark'.
'type'              Sets the reCaptcha type 'image' (default) or 'audio'.
'size'              Set the size of reCaptcha widget, 'normal' (default) or 'compact'
'tabindex'          Set the reCaptcha elements tab index, defaults to 0.

The FwsReCaptchaV2\Validator\ReCaptchaV2 has the following options.

'priKey'            Sets your reCaptcha private key (required).
'sendIpAddress'     Choose to send the users IP address as extra validation, set 'TRUE' (default) or 'FALSE'.
'apiUrl'            Sets the Google api to perform validation, should not be changed. Defaults to 'https://www.google.com/recaptcha/api/siteverify'.

All the above options have getters and setters.