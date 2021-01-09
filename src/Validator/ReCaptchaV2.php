<?php

namespace FwsReCaptchaV2\Validator;

use Laminas\Validator\AbstractValidator;
use Traversable;
use Exception;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Http\Client;
use Laminas\Http\Request;
use Laminas\Http\Client\Adapter\Curl;
use Laminas\Http\PhpEnvironment\RemoteAddress;

/**
 * Recaptcha V2 validator
 *
 * @author Garry Childs (Freedom Web Services)
 */
class ReCaptchaV2 extends AbstractValidator
{

    const FAILED = 'reCaptchaFailedToConnect';
    const INCORRECT = 'reCaptchaValidationIncorrect';

    protected $messageTemplates = array(
        self::FAILED => "Unable to connect to reCaptcha service",
        self::INCORRECT => "The reCaptcha validation failed",
    );

    /**
     *
     * @var string
     */
    private $apiUrl = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     *
     * @var string
     */
    private $priKey;

    /**
     *
     * @var boolean
     */
    private $sendIpAddress = TRUE;

    /**
     * Get google re-captcha api url
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * Get your google api private key
     * @return string
     */
    public function getPriKey()
    {
        return $this->priKey;
    }

    /**
     * Get whether to send client IP address
     * @return boolean
     */
    public function getSendIpAddress()
    {
        return (bool) $this->sendIpAddress;
    }

    /**
     * Gets the client IP address
     * @return string
     */
    public function getClientIpAddress()
    {
        $remote = new RemoteAddress();
        return $remote->getIpAddress();
    }

    /**
     * Sets the Google reCaptcha api url, should not change
     * @param string $apiUrl
     * @return \Freedom\ReCaptchaV2\Validator\ReCaptchaV2
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * Sets your reCaptcha private key
     * @param string $priKey
     * @return \Freedom\ReCaptchaV2\Validator\ReCaptchaV2
     */
    public function setPriKey($priKey)
    {
        $this->priKey = $priKey;
        return $this;
    }

    /**
     * Set whether to send client IP address
     * @param boolean $sendIpAddress
     * @return \Freedom\ReCaptchaV2\Validator\ReCaptchaV2
     */
    public function setSendIpAddress($sendIpAddress)
    {
        $this->sendIpAddress = (bool) $sendIpAddress;
        return $this;
    }

    /**
     * Set default options for this instance
     *
     * @param array|Traversable $options
     */
    public function __construct($options = array())
    {
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        } elseif (!is_array($options)) {
            throw new Exception(sprintf('Options need to be an array or Traversable, %s given', gettype($options)));
        }

        parent::__construct($options);
    }
    
    public function setOptions($options = [])
    {
        if (isset($options['apiUrl'])) {
            $this->setApiUrl($options['apiUrl']);
            unset($options['apiUrl']);
        } elseif (isset($options['api_url'])) {
            $this->setApiUrl($options['api_url']);
            unset($options['api_url']);
        }

        if (isset($options['priKey'])) {
            $this->setPriKey($options['priKey']);
            unset($options['priKey']);
        } elseif (isset($options['pri_key'])) {
            $this->setPriKey($options['pri_key']);
            unset($options['pri_key']);
        }

        if (isset($options['userIPAddress'])) {
            $this->setUserIPAddress($options['userIPAddress']);
            unset($options['userIPAddress']);
        } elseif (isset($options['user_ip_address'])) {
            $this->setUserIPAddress($options['user_ip_address']);
            unset($options['user_ip_address']);
        }
        
        return parent::setOptions($options);
    }

    /**
     * Returns TRUE if recapture v2 passed, FALSE otherwise
     *
     * @param  string $value
     * @return bool
     */
    public function isValid($value)
    {
        $client = new Client($this->getApiUrl(), array(
            'adapter' => Curl::class,
        ));
        $client->setMethod(Request::METHOD_POST);
        $params = array(
            'secret' => $this->getPriKey(),
            'response' => $value,
        );
        if ($this->getSendIpAddress()) {
            $params['remoteip'] = $this->getClientIpAddress();
        }
        $client->setParameterPost($params);
        $response = $client->send();

        if ($response->isSuccess()) {
            $response = json_decode($response->getBody(), TRUE);
            if ($response['success']) {
                return TRUE;
            } else {
                $this->error(self::INCORRECT);
                return FALSE;
            }
        }
        $this->error(self::FAILED);
        return FALSE;
    }

}
