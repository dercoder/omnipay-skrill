<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 * Skrill Wallet Integration v7.7
 * @package Omnipay\Skrill\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return (bool) $this->getSessionId();
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return 'https://pay.skrill.com?' . http_build_query($this->data);
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return array
     */
    public function getRedirectData()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return isset($this->data['sid']) ? $this->data['sid'] : null;
    }
}
