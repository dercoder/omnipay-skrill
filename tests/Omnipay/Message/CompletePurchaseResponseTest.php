<?php

namespace Omnipay\Skrill\Message;

use Omnipay\Tests\TestCase;

class CompletePurchaseResponseTest extends TestCase
{
    public function testSuccess()
    {
        $request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $response = new CompletePurchaseResponse($request, array(
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

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isCancelled());
        $this->assertSame('2', $response->getCode());
        $this->assertSame('58758699d778f', $response->getTransactionId());
        $this->assertSame('1990625423', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }
}