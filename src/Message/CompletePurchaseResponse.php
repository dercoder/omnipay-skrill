<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class CompletePurchaseResponse
 * @package Omnipay\Skrill\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getStatus() == '2' ? true : false;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return $this->getStatus() == '0' ? true : false;
    }

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return $this->getStatus() == '-1' ? true : false;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return isset($this->data['status']) ? $this->data['status'] : null;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return isset($this->data['transaction_id']) ? $this->data['transaction_id'] : null;
    }

    /**
     * @return string
     */
    public function getTransactionReference()
    {
        return isset($this->data['mb_transaction_id']) ? $this->data['mb_transaction_id'] : null;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->getStatus();
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return isset($this->data['failed_reason_code']) ? $this->data['failed_reason_code'] : null;
    }
}
