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
        $this->setMockHttpResponse('PreparePurchaseSuccess.txt');
        $data = $this->request->getData();
        $this->assertSame('5c779936dd026263fc9614413d5a5982', $data['sid']);
    }

    public function testSendData()
    {
        $this->setMockHttpResponse('PreparePurchaseSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\Skrill\Message\PurchaseResponse', $response);
    }
}
