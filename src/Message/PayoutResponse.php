<?php

namespace Omnipay\Skrill\Message;

/**
 * Class PayoutResponse
 * Skrill Automated Payments Interface v2.5
 * @package Omnipay\Skrill\Message
 */
class PayoutResponse extends PreparePayoutResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getStatus() == '2' || $this->getStatus() == '1' ? true : false;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        if ($status = (string) $this->data->transaction->status) {
            return $status;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getTransactionReference()
    {
        if ($transactionReference = (string) $this->data->transaction->id) {
            return $transactionReference;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        if ($message = (string) $this->data->transaction->status_msg) {
            return $message;
        }

        switch ($this->getCode()) {
            case 'SESSION_EXPIRED':
                return 'Session expired.';
            default:
                return null;
        }
    }
}
