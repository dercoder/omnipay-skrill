<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testRedirect()
    {
        $response = new PurchaseResponse($this->request, array('sid' => '5c779936dd026263fc9614413d5a5982'));

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('https://pay.skrill.com?sid=5c779936dd026263fc9614413d5a5982', $response->getRedirectUrl());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertNull($response->getRedirectData());
    }
}
