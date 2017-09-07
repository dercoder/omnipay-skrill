<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class PayoutResponseTest extends TestCase
{
    /**
     * @var PayoutRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PayoutRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PayoutSuccess.txt');
        $response = new PayoutResponse($this->request, $httpResponse->xml());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertSame('processed', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame('1994284674', $response->getTransactionReference());
    }

    public function testFailed1()
    {
        $httpResponse = $this->getMockHttpResponse('PayoutFailed1.txt');
        $response = new PayoutResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('SESSION_EXPIRED', $response->getCode());
        $this->assertSame('Session expired.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed2()
    {
        $httpResponse = $this->getMockHttpResponse('PayoutFailed2.txt');
        $response = new PayoutResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('SOMETHING_ELSE', $response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }
}
