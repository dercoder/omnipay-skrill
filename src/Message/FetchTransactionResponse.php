<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class FetchTransactionResponse
 * Skrill Automated Payments Interface v2.5
 * @package Omnipay\Skrill\Message
 */
class FetchTransactionResponse extends AbstractResponse
{
    /**
     * FetchTransactionResponse constructor.
     *
     * @param RequestInterface $request
     * @param string           $data
     */
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = array();
        $lines = preg_split('/\s*\R/m', rtrim($data), null, PREG_SPLIT_NO_EMPTY);

        if (isset($lines[0]) && preg_match('/([0-9]+)\s*(.*)/', trim($lines[0]), $status)) {
            $this->data['code'] = $status[1];
            $this->data['message'] = $status[2];
        }

        if (isset($lines[1])) {
            parse_str($lines[1], $result);
            $this->data = array_merge($this->data, $result);
        }
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getStatus() == '2' ? true : false;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return $this->getStatus() == '0' ? true : false;
    }

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return $this->getStatus() == '-1' ? true : false;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return isset($this->data['status']) ? $this->data['status'] : null;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return isset($this->data['transaction_id']) ? $this->data['transaction_id'] : null;
    }

    /**
     * @return string
     */
    public function getTransactionReference()
    {
        return isset($this->data['mb_transaction_id']) ? $this->data['mb_transaction_id'] : null;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return isset($this->data['code']) ? $this->data['code'] : null;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return isset($this->data['message']) ? $this->data['message'] : null;
    }
}
