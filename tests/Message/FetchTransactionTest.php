<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class FetchTransactionTest extends TestCase
{
    /**
     * @var FetchTransactionRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'email'                => 'merchant@example.com',
            'password'             => 'oJ2rHLBVSbD5iGfT',
            'transactionReference' => 'TX987654'
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('TX987654', $data['mb_trn_id']);
        $this->assertSame('merchant@example.com', $data['email']);
        $this->assertSame('3bff8c620d431152149187ab60af97cf', $data['password']);
        $this->assertSame('status_trn', $data['action']);

        $this->request->setTransactionReference('');
        $this->request->setTransactionId('TX1234567');
        $data = $this->request->getData();
        $this->assertSame('TX1234567', $data['trn_id']);

        $this->request->setTransactionId('');
        $this->request->setTransactionReference('');
        $this->setExpectedException('Omnipay\Common\Exception\InvalidRequestException', 'The transactionId or transactionReference parameter is required');
        $this->request->getData();
    }

    public function testSendData()
    {
        $this->setMockHttpResponse('FetchTransactionSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\Skrill\Message\FetchTransactionResponse', $response);
    }
}
