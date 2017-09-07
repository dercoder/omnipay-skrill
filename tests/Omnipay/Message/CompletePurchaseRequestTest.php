<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $httpRequest = new HttpRequest(array(), array(
            'pay_to_email'      => 'merchant@example.com',
            'pay_from_email'    => 'customer@example.com',
            'transaction_id'    => '58758699d778f',
            'mb_amount'         => '5.32',
            'amount'            => '5.32',
            'mb_transaction_id' => '1990625423',
            'mb_currency'       => 'EUR',
            'md5sig'            => 'EBB514CF0CB7169C3F08FE817C58FDE6',
            'currency'          => 'EUR',
            'merchant_id'       => '69340665',
            'status'            => '2'
        ));

        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->request->initialize(array(
            'email'      => 'merchant@example.com',
            'password'   => 'oJ2rHLBVSbD5iGfT',
            'secretWord' => 'asdfghjkl',
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame(array(
            'pay_to_email'      => 'merchant@example.com',
            'pay_from_email'    => 'customer@example.com',
            'transaction_id'    => '58758699d778f',
            'mb_amount'         => '5.32',
            'amount'            => '5.32',
            'mb_transaction_id' => '1990625423',
            'mb_currency'       => 'EUR',
            'md5sig'            => 'EBB514CF0CB7169C3F08FE817C58FDE6',
            'currency'          => 'EUR',
            'merchant_id'       => '69340665',
            'status'            => '2',
        ), $data);

        $this->request->setSecretWord('1234');
        $this->setExpectedException('Omnipay\Common\Exception\InvalidRequestException', 'Invalid md5sig.');
        $this->request->getData();
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\Skrill\Message\CompletePurchaseResponse', $response);
    }
}