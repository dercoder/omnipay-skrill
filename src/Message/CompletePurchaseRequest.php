<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class CompletePurchaseRequest
 * Skrill Wallet Integration v7.7
 * @package Omnipay\Skrill\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('secretWord');
        $data = $this->httpRequest->request->all();

        if (!$this->hasValidSignature($data)) {
            throw new InvalidRequestException('Invalid md5sig.');
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, $data);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function hasValidSignature($data)
    {
        $toValidate = array(
            $data['merchant_id'],
            $data['transaction_id'],
            strtoupper(md5($this->getSecretWord())),
            $data['mb_amount'],
            $data['mb_currency'],
            $data['status']
        );

        return $data['md5sig'] == strtoupper(md5(implode('', $toValidate)));
    }
}
