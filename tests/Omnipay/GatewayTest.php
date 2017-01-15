<?php
namespace Omnipay\Skrill;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    public $gateway;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setEmail('merchant@example.com');
        $this->gateway->setPassword('oJ2rHLBVSbD5iGfT');
        $this->gateway->setSecretWord('asdfghjkl');
        $this->gateway->setTestMode(true);
    }

    public function testGateway()
    {
        $this->assertSame('merchant@example.com', $this->gateway->getEmail());
        $this->assertSame('oJ2rHLBVSbD5iGfT', $this->gateway->getPassword());
        $this->assertSame('asdfghjkl', $this->gateway->getSecretWord());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase();
        $this->assertInstanceOf('Omnipay\Skrill\Message\PurchaseRequest', $request);
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase();
        $this->assertInstanceOf('Omnipay\Skrill\Message\CompletePurchaseRequest', $request);
    }

    public function testPayout()
    {
        $request = $this->gateway->payout();
        $this->assertInstanceOf('Omnipay\Skrill\Message\PayoutRequest', $request);
    }

    public function testFetchTransaction()
    {
        $request = $this->gateway->fetchTransaction();
        $this->assertInstanceOf('Omnipay\Skrill\Message\FetchTransactionRequest', $request);
    }
}
