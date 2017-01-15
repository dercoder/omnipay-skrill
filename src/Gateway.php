<?php

namespace Omnipay\Skrill;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Skrill\Message\PurchaseRequest;
use Omnipay\Skrill\Message\CompletePurchaseRequest;
use Omnipay\Skrill\Message\PayoutRequest;
use Omnipay\Skrill\Message\FetchTransactionRequest;

/**
 * Class Gateway
 * https://www.skrill.com/fileadmin/content/pdf/Skrill_Wallet_Checkout_Guide.pdf
 * https://www.skrill.com/fileadmin/content/pdf/Skrill_Automated_Payments_Interface_Guide.pdf
 * @package Omnipay\Skrill
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Skrill';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'email'      => '',
            'password'   => '',
            'secretWord' => '',
            'testMode'   => false
        );
    }

    /**
     * Get Skrill merchant email.
     *
     * @return string email
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * Set Skrill merchant email.
     *
     * @param string $value email
     *
     * @return $this
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * Get Skrill API password.
     *
     * @return string password
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set Skrill API password.
     *
     * @param string $value password
     *
     * @return $this
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get Skrill secret word.
     *
     * • To construct the msid digital signature parameter. This parameter is sent to the return_url if the
     * secure return_url option is enabled for your merchant account. This signature is used to verify
     * the authenticity of the information sent to the return_url once payment is complete.
     *
     * • To create the digital signature parameters used to verify the authenticity of the payment status
     * information that Skrill sends to the status_url.
     *
     * • For the email check tool to carry out anti‐fraud checks on email addresses.
     *
     * @return string merchantEmail
     */
    public function getSecretWord()
    {
        return $this->getParameter('secretWord');
    }

    /**
     * Set Skrill secret word.
     *
     * • To construct the msid digital signature parameter. This parameter is sent to the return_url if the
     * secure return_url option is enabled for your merchant account. This signature is used to verify
     * the authenticity of the information sent to the return_url once payment is complete.
     *
     * • To create the digital signature parameters used to verify the authenticity of the payment status
     * information that Skrill sends to the status_url.
     *
     * • For the email check tool to carry out anti‐fraud checks on email addresses.
     *
     * @param string $value secretWord
     *
     * @return $this
     */
    public function setSecretWord($value)
    {
        return $this->setParameter('secretWord', $value);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Skrill\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Skrill\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PayoutRequest
     */
    public function payout(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Skrill\Message\PayoutRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|FetchTransactionRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Skrill\Message\FetchTransactionRequest', $parameters);
    }
}
