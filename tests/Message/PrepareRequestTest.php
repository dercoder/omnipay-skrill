<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class PrepareRequestTest extends TestCase
{
    /**
     * @var PrepareRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new PrepareRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'email'         => 'merchant@example.com',
            'password'      => 'oJ2rHLBVSbD5iGfT',
            'secretWord'    => 'asdfghjkl',
            'receiver'      => 'customer@example.com',
            'amount'        => 5.34,
            'currency'      => 'EUR',
            'transactionId' => 'TX12345',
            'description'   => 'Test'
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('merchant@example.com', $data['email']);
        $this->assertSame('3bff8c620d431152149187ab60af97cf', $data['password']);
        $this->assertSame('prepare', $data['action']);
        $this->assertSame('5.34', $data['amount']);
        $this->assertSame('EUR', $data['currency']);
        $this->assertSame('Test', $data['subject']);
        $this->assertSame('Test', $data['note']);
        $this->assertSame('TX12345', $data['frn_trn_id']);
    }

    public function testSendData()
    {
        $this->setMockHttpResponse('PrepareSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\Skrill\Message\PrepareResponse', $response);
    }
}
