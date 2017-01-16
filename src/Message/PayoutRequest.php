<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class PayoutRequest
 * Skrill Automated Payments Interface v2.5
 * @package Omnipay\Skrill\Message
 */
class PayoutRequest extends PreparePayoutRequest
{
    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'email',
            'password',
            'amount',
            'currency',
            'transactionId',
            'description',
            'receiver'
        );

        $prepareRequest = new PreparePayoutRequest($this->httpClient, $this->httpRequest);
        /** @var PreparePayoutResponse $prepareResponse */
        $prepareResponse = $prepareRequest->initialize(array(
            'email'         => $this->getEmail(),
            'password'      => $this->getPassword(),
            'amount'        => $this->getAmount(),
            'currency'      => $this->getCurrency(),
            'transactionId' => $this->getTransactionId(),
            'description'   => $this->getDescription(),
            'receiver'      => $this->getReceiver()
        ))->send();

        if (!$prepareResponse->isSuccessful()) {
            throw new InvalidRequestException($prepareResponse->getMessage());
        }

        return array(
            'email'    => $this->getEmail(),
            'password' => md5($this->getPassword()),
            'action'   => 'transfer',
            'sid'      => $prepareResponse->getSessionId()
        );
    }

    /**
     * @param array $data
     *
     * @return PayoutResponse
     */
    public function sendData($data)
    {
        $uri = $this->endpoint . '?' . http_build_query($data);
        $httpResponse = $this->httpClient->get($uri)->send();
        return new PayoutResponse($this, $httpResponse->xml());
    }
}
