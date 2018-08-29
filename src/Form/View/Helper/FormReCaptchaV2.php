<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace FwsReCaptchaV2\Form\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;
use Exception;

class FormReCaptchaV2 extends AbstractHelper
{

    /**
     * Make class invokable
     * @param ElementInterface $element
     * @return \FwsReCaptchaV2\Form\View\Helper\FormReCaptchaV2
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element);
    }

    /**
     *
     * @param ElementInterface $element
     * @return string HTML output
     * @throws Exception
     */
    public function render(ElementInterface $element)
    {
        if (!is_string($element->getPubKey()) || empty($element->getPubKey())) {
            throw new Exception('ReCapthcha public key not set');
        }

        return $this->getJQuery($element) . PHP_EOL . $this->getHtmlContainer($element) . PHP_EOL . $this->getHiddenElement($element) . PHP_EOL;
    }

    /**
     * Get the HTML container
     * @param ElementInterface $element
     * @return string HTML container tag
     */
    private function getHtmlContainer(ElementInterface $element)
    {
        switch ($element->getTag()) {
            case 'span':
                $tag = sprintf('<span%s></span>', $this->getHtmlContainerAttributeString($element));
                break;
            case 'div':
            default:
                $tag = sprintf('<div%s></div>', $this->getHtmlContainerAttributeString($element));
        }

        return $tag;
    }

    /**
     * Get the reCaptchs container tag attributes
     * @param ElementInterface $element
     * @return string
     */
    private function getHtmlContainerAttributeString(ElementInterface $element)
    {
        $attributes = ' id="' . $element->getName() . '_container"';
        if ($element->getReCaptchaClass()) {
            $attributes .= ' class="' . $element->getReCaptchaClass() . '"';
        }

        return $attributes;
    }

    /**
     * Get the jQuery code
     * @param ElementInterface $element
     * @return string
     */
    private function getJQuery(ElementInterface $element)
    {
        $options = [
            'sitekey' => '"' . $element->getPubKey() . '"',
            'callback' => '"verifyCallback"',
        ];
        if ($element->getTheme()) {
            $options['theme'] = '"' . $element->getTheme() . '"';
        }
        if ($element->getType()) {
            $options['type'] = '"' . $element->getType() . '"';
        }
        if ($element->getSize()) {
            $options['size'] = '"' . $element->getSize() . '"';
        }
        if ($element->getTabindex()) {
            $options['tabindex'] = '"' . $element->getTabindex() . '"';
        }
        return '<script type="text/javascript">' . PHP_EOL
                . 'var onloadCallback = function() {' . PHP_EOL
                . 'grecaptcha.render("' . $element->getName() . '_container", {'
                . $this->getJQueryObject($options)
                . '})' . PHP_EOL
                . '};' . PHP_EOL
                . '</script>' . PHP_EOL
                . '<script type="text/javascript">' . PHP_EOL
                . 'var verifyCallback = function() {' . PHP_EOL
                . '$("#' . $element->getName() . '").val(grecaptcha.getResponse());' . PHP_EOL
                . '};' . PHP_EOL
                . '</script>' . PHP_EOL
                . '<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>';
    }

    /**
     * Get reCaptcha jQuery options
     * @param array $options
     * @return string
     */
    private function getJQueryObject(Array $options)
    {
        $objectString = '';
        foreach ($options as $key => $option) {
            $objectString .= $key . ' : ' . $option . ',' . PHP_EOL;
        }
        return $objectString;
    }

    /**
     * Get the hidden element
     * @param ElementInterface $element
     * @return string
     */
    private function getHiddenElement(ElementInterface $element)
    {
        return '<input type="hidden" id="' . $element->getName() . '" name="' . $element->getName() . '" />';
    }

}
