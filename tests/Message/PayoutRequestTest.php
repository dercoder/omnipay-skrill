<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class PayoutRequestTest extends TestCase
{
    /**
     * @var PayoutRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new PayoutRequest($this->getHttpClient(), $this->getHttpRequest());
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
        $this->setMockHttpResponse('PrepareSuccess.txt');
        $data = $this->request->getData();
        $this->assertSame('merchant@example.com', $data['email']);
        $this->assertSame('3bff8c620d431152149187ab60af97cf', $data['password']);
        $this->assertSame('transfer', $data['action']);
        $this->assertSame('e1a8322ea4ce6991461a16068594aac0', $data['sid']);

        $this->setMockHttpResponse('PrepareFailed1.txt');
        $this->setExpectedException('Omnipay\Common\Exception\InvalidRequestException', 'Invalid combination of email and password is supplied.');
        $this->request->getData();
    }

    public function testSendData()
    {
        $this->setMockHttpResponse(array(
            'PrepareSuccess.txt',
            'PayoutSuccess.txt'
        ));
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\Skrill\Message\PayoutResponse', $response);
    }
}
