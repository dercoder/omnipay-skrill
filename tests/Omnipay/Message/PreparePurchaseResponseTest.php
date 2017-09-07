<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class PreparePurchaseResponseTest extends TestCase
{
    /**
     * @var PreparePurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PreparePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PreparePurchaseSuccess.txt');
        $response = new PreparePurchaseResponse($this->request, $httpResponse->getBody(true));

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertfalse($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertSame('5c779936dd026263fc9614413d5a5982', $response->getSessionId());
    }
}
