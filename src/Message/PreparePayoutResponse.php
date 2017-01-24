<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class PreparePayoutResponse
 * Skrill Automated Payments Interface v2.5
 * @package Omnipay\Skrill\Message
 */
class PreparePayoutResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() ? false : true;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        if ($sessionId = (string) $this->data->sid) {
            return $sessionId;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        if ($error = (string) $this->data->error->error_msg) {
            return $error;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        if (!$code = $this->getCode()) {
            return null;
        }

        switch ($code) {
            case 'INVALID_OR_MISSING_ACTION':
                return 'The action parameter is not supplied in the query.';
            case 'REFUND_DENIED':
                return 'Refund feature is not activated.';
            case 'LOGIN_INVALID':
                return 'Missing email or password parameters.';
            case 'INVALID_EMAIL':
                return 'An Invalid email parameter is supplied.';
            case 'CANNOT_LOGIN':
                return 'Invalid combination of email and password is supplied.';
            case 'PAYMENT_DENIED':
                return 'Check in your account profile that the API is enabled.';
            default:
                return 'Unknown error.';
        }
    }
}
