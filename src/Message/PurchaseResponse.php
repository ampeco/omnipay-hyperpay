<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Omnipay\Common\Message\RequestInterface;

class PurchaseResponse extends Response
{
    protected mixed $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode = 200)
    {
        parent::__construct($request, $data, $statusCode);
        $this->statusCode = $statusCode;
    }

    public function getErrors()
    {
        return $this->data['result']['parameterErrors'] ?? null;
    }

    public function getCode(): int
    {
        return $this->statusCode;
    }
}
