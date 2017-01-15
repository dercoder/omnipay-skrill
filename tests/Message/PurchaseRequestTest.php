<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'email'         => 'merchant@example.com',
            'password'      => 'oJ2rHLBVSbD5iGfT',
            'secretWord'    => 'asdfghjkl',
            'amount'        => 5.34,
            'currency'      => 'EUR',
            'transactionId' => 'TX12345',
            'description'   => 'Test',
            'returnUrl'     => 'https://www.example.com/return.html',
            'cancelUrl'     => 'https://www.example.com/cancel.html',
            'notifyUrl'     => 'https://www.example.com/notify.html'
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('merchant@example.com', $data['pay_to_email']);
        $this->assertSame('5.34', $data['amount']);
        $this->assertSame('EUR', $data['currency']);
        $this->assertSame('Test', $data['recipient_description']);
        $this->assertSame('TX12345', $data['transaction_id']);
        $this->assertSame('https://www.example.com/return.html', $data['return_url']);
        $this->assertSame('https://www.example.com/cancel.html', $data['cancel_url']);
        $this->assertSame('https://www.example.com/notify.html', $data['status_url']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\Skrill\Message\PurchaseResponse', $response);
    }
}
