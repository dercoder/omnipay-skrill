<?php

namespace Omnipay\Skrill\Message;

/**
 * Class PurchaseRequest
 * Skrill Wallet Integration v7.7
 * @package Omnipay\Skrill\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        $this->validate(
            'email',
            'amount',
            'currency',
            'transactionId',
            'description',
            'returnUrl',
            'cancelUrl',
            'notifyUrl'
        );

        return array(
            'pay_to_email'          => $this->getEmail(),
            'recipient_description' => $this->getDescription(),
            'transaction_id'        => $this->getTransactionId(),
            'return_url'            => $this->getReturnUrl(),
            'cancel_url'            => $this->getCancelUrl(),
            'status_url'            => $this->getNotifyUrl(),
            'amount'                => $this->getAmount(),
            'currency'              => $this->getCurrency()
        );
    }

    /**
     * @param array $data
     *
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return new PurchaseResponse($this, $data);
    }
}
