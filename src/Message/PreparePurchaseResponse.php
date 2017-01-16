<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class PreparePurchaseResponse
 * Skrill Wallet Integration v7.7
 * @package Omnipay\Skrill\Message
 */
class PreparePurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getSessionId() ? true : false;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->data;
    }
}
