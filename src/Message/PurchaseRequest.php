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

        $prepareRequest = new PreparePurchaseRequest($this->httpClient, $this->httpRequest);
        /** @var PreparePurchaseResponse $prepareResponse */
        $prepareResponse = $prepareRequest->initialize(array(
            'email'         => $this->getEmail(),
            'amount'        => $this->getAmount(),
            'currency'      => $this->getCurrency(),
            'transactionId' => $this->getTransactionId(),
            'description'   => $this->getDescription(),
            'returnUrl'     => $this->getReturnUrl(),
            'cancelUrl'     => $this->getCancelUrl(),
            'notifyUrl'     => $this->getNotifyUrl()
        ))->send();

        return array(
            'sid' => $prepareResponse->getSessionId()
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
