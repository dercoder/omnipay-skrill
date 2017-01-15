<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class FetchTransactionRequest
 * Skrill Automated Payments Interface v2.5
 * @package Omnipay\Skrill\Message
 */
class FetchTransactionRequest extends AbstractRequest
{
    /**
     * @var string
     */
    private $endpoint = 'https://www.skrill.com/app/query.pl';

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'email',
            'password'
        );

        $data = array(
            'email'    => $this->getEmail(),
            'password' => md5($this->getPassword()),
            'action'   => 'status_trn'
        );

        if ($transactionId = $this->getTransactionId()) {
            $data['trn_id'] = $transactionId;
        } elseif ($transactionReference = $this->getTransactionReference()) {
            $data['mb_trn_id'] = $transactionReference;
        } else {
            throw new InvalidRequestException('The transactionId or transactionReference parameter is required');
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return FetchTransactionResponse
     */
    public function sendData($data)
    {
        $uri = $this->endpoint . '?' . http_build_query($data);
        $httpResponse = $this->httpClient->get($uri)->send();
        return new FetchTransactionResponse($this, $httpResponse->getBody(true));
    }
}
