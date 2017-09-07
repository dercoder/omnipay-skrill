<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class PreparePayoutResponseTest extends TestCase
{
    /**
     * @var PreparePayoutRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PreparePayoutRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PreparePayoutSuccess.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

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
        $httpResponse = $this->getMockHttpResponse('PreparePayoutFailed1.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

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
        $httpResponse = $this->getMockHttpResponse('PreparePayoutFailed2.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

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
        $httpResponse = $this->getMockHttpResponse('PreparePayoutFailed3.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

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
        $httpResponse = $this->getMockHttpResponse('PreparePayoutFailed4.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

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
        $httpResponse = $this->getMockHttpResponse('PreparePayoutFailed5.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

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
        $httpResponse = $this->getMockHttpResponse('PreparePayoutFailed6.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('SOMETHING_ELSE', $response->getCode());
        $this->assertSame('Error Code: SOMETHING_ELSE', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }

    public function testFailed7()
    {
        $httpResponse = $this->getMockHttpResponse('PreparePayoutFailed7.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

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

    public function testFailed8()
    {
        $httpResponse = $this->getMockHttpResponse('PreparePayoutFailed8.txt');
        $response = new PreparePayoutResponse($this->request, $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('PAYMENT_DENIED', $response->getCode());
        $this->assertSame('Check in your account profile that the API is enabled.', $response->getMessage());
        $this->assertNull($response->getSessionId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
    }
}
