<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class FetchTransactionResponseTest extends TestCase
{
    /**
     * @var FetchTransactionRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('FetchTransactionSuccess.txt');
        $response = new FetchTransactionResponse($this->request, $httpResponse->getBody(true));

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('200', $response->getCode());
        $this->assertSame('OK', $response->getMessage());
        $this->assertSame('58758699d778f', $response->getTransactionId());
        $this->assertSame('1990625423', $response->getTransactionReference());
    }

    public function testFailed()
    {
        $httpResponse = $this->getMockHttpResponse('FetchTransactionFailed.txt');
        $response = new FetchTransactionResponse($this->request, $httpResponse->getBody(true));

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('403', $response->getCode());
        $this->assertSame('Transaction not found: 58758699d778fx', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }
}