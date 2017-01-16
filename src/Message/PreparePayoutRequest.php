<?php

namespace Omnipay\Skrill\Message;

/**
 * Class PreparePayoutRequest
 * Skrill Automated Payments Interface v2.5
 * @package Omnipay\Skrill\Message
 */
class PreparePayoutRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = 'https://www.skrill.com/app/pay.pl';

    /**
     * @return string
     */
    public function getReceiver()
    {
        return $this->getParameter('receiver');
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setReceiver($value)
    {
        return $this->setParameter('receiver', $value);
    }

    /**
     * @return array
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

        return array(
            'email'      => $this->getEmail(),
            'password'   => md5($this->getPassword()),
            'action'     => 'prepare',
            'amount'     => $this->getAmount(),
            'currency'   => $this->getCurrency(),
            'frn_trn_id' => $this->getTransactionId(),
            'bnf_email'  => $this->getReceiver(),
            'subject'    => $this->getDescription(),
            'note'       => $this->getDescription()
        );
    }

    /**
     * @param array $data
     *
     * @return PreparePayoutResponse
     */
    public function sendData($data)
    {
        $uri = $this->endpoint . '?' . http_build_query($data);
        $httpResponse = $this->httpClient->get($uri)->send();
        return new PreparePayoutResponse($this, $httpResponse->xml());
    }
}
