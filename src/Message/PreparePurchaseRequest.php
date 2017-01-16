<?php

namespace Omnipay\Skrill\Message;

/**
 * Class PreparePurchaseRequest
 * Skrill Wallet Integration v7.7
 * @package Omnipay\Skrill\Message
 */
class PreparePurchaseRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = 'https://pay.skrill.com/';

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
            'currency'              => $this->getCurrency(),
            'prepare_only'          => 1
        );
    }

    /**
     * @param array $data
     *
     * @return PreparePurchaseResponse
     */
    public function sendData($data)
    {
        $uri = $this->endpoint . '?' . http_build_query($data);
        $httpResponse = $this->httpClient->get($uri)->send();
        return new PreparePurchaseResponse($this, $httpResponse->getBody(true));
    }
}
