<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class PrepareResponseTest extends TestCase
{
    /**
     * @var PrepareRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PrepareRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PrepareSuccess.txt');
        $response = new PrepareResponse($this->request, $httpResponse->xml());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertSame('e1a8322ea4ce6991461a16068594aac0', $response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed1()
    {
        $httpResponse = $this->getMockHttpResponse('PrepareFailed1.txt');
        $response = new PrepareResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('CANNOT_LOGIN', $response->getCode());
        $this->assertSame('Invalid combination of email and password is supplied.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed2()
    {
        $httpResponse = $this->getMockHttpResponse('PrepareFailed2.txt');
        $response = new PrepareResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('REFUND_DENIED', $response->getCode());
        $this->assertSame('Refund feature is not activated.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed3()
    {
        $httpResponse = $this->getMockHttpResponse('PrepareFailed3.txt');
        $response = new PrepareResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('LOGIN_INVALID', $response->getCode());
        $this->assertSame('Missing email or password parameters.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed4()
    {
        $httpResponse = $this->getMockHttpResponse('PrepareFailed4.txt');
        $response = new PrepareResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('INVALID_EMAIL', $response->getCode());
        $this->assertSame('An Invalid email parameter is supplied.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed5()
    {
        $httpResponse = $this->getMockHttpResponse('PrepareFailed5.txt');
        $response = new PrepareResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('CANNOT_LOGIN', $response->getCode());
        $this->assertSame('Invalid combination of email and password is supplied.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed6()
    {
        $httpResponse = $this->getMockHttpResponse('PrepareFailed6.txt');
        $response = new PrepareResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('SOMETHING_ELSE', $response->getCode());
        $this->assertSame('Unknown error.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed7()
    {
        $httpResponse = $this->getMockHttpResponse('PrepareFailed7.txt');
        $response = new PrepareResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('INVALID_OR_MISSING_ACTION', $response->getCode());
        $this->assertSame('The action parameter is not supplied in the query.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }
}
