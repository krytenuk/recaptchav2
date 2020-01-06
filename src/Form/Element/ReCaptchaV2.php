<?php

namespace FwsReCaptchaV2\Form\Element;

use Laminas\Form\Element;

class ReCaptchaV2 extends Element
{

    /**
     *
     * @var string
     */
    private $pubKey;

    /**
     *
     * @var string
     */
    private $tag = 'div';

    /**
     *
     * @var string
     */
    private $reCaptchaClass = 'g-recaptcha';

    /**
     *
     * @var string
     */
    private $theme = 'light';

    /**
     *
     * @var string
     */
    private $type = 'image';

    /**
     *
     * @var string
     */
    private $size = 'normal';

    /**
     *
     * @var integer
     */
    private $tabindex = 0;

    /**
     * Get your sites public reCaptcha key
     *
     * @return string
     */
    public function getPubKey()
    {
        return $this->pubKey;
    }

    /**
     * Sets your sites public reCaptcha key
     *
     * @param string $pubKey
     * @return \Freedom\ReCaptchaV2\Form\Element\ReCaptchaV2
     */
    public function setPubKey($pubKey)
    {
        $this->pubKey = $pubKey;
        return $this;
    }

    /**
     * Get html tag used as a container
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set html tag used as a container div (default) or span
     *
     * @param string $tag
     * @return \Freedom\ReCaptchaV2\Form\Element\ReCaptchaV2
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Set the html container class, should be 'g-recaptcha'
     *
     * @return string
     */
    public function getReCaptchaClass()
    {
        return $this->reCaptchaClass;
    }

    /**
     * Get the html container class, should be 'g-recaptcha'
     *
     * @param string $class
     * @return \Freedom\ReCaptchaV2\Form\Element\ReCaptchaV2
     */
    public function setReCaptchaClass($class)
    {
        $this->reCaptchaClass = $class;
        return $this;
    }

    /**
     * Get the reCaptcha theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set the reCaptcha theme to use, light (default) or dark
     *
     * @param string $theme
     * @return \Freedom\ReCaptchaV2\Form\Element\ReCaptchaV2
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * Get the reCaptcha type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the reCaptcha type, image (default) or audio
     *
     * @param string $type
     * @return \Freedom\ReCaptchaV2\Form\Element\ReCaptchaV2
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the size of reCaptcha
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the size of reCaptcha widget, normal (default) or compact
     *
     * @param string $size
     * @return \Freedom\ReCaptchaV2\Form\Element\ReCaptchaV2
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Get the tab index
     *
     * @return integer
     */
    public function getTabindex()
    {
        return $this->tabindex;
    }

    /**
     * Set the tab index, default 0
     *
     * @param integer $tabindex
     * @return \Freedom\ReCaptchaV2\Form\Element\ReCaptchaV2
     */
    public function setTabindex($tabindex)
    {
        $this->tabindex = (int)$tabindex;
        return $this;
    }

    /**
     * Sets the options
     * @param array|Traversable $options
     */
    public function setOptions($options)
    {
        parent::setOptions($options);

        if (isset($options['pubKey'])) {
            $this->setPubKey($options['pubKey']);
        }

        if (isset($options['tag'])) {
            $this->setTag($options['tag']);
        }

        if (isset($options['reCaptchaClass'])) {
            $this->setReCaptchaClass($options['reCaptchaClass']);
        }

        if (isset($options['theme'])) {
            $this->setTheme($options['theme']);
        }

        if (isset($options['type'])) {
            $this->setType($options['type']);
        }

        if (isset($options['size'])) {
            $this->setSize($options['size']);
        }

        if (isset($options['tabindex'])) {
            $this->setTabindex($options['tabindex']);
        }
    }

}
