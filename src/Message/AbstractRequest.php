<?php

namespace Omnipay\Skrill\Message;

/**
 * Class AbstractRequest
 * @package Omnipay\Skrill\Message
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
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
}
