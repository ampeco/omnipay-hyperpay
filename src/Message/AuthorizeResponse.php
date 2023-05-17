<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Omnipay\Common\Message\RequestInterface;

class AuthorizeResponse extends Response
{
    protected mixed $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode = 200)
    {
        parent::__construct($request, $data, $statusCode);
        $this->statusCode = $statusCode;
    }

    public function isSuccessful(): bool
    {
        $paymentProviderCode = $this->data['result']['code'] ?? null;

        return $this->getCode() < 400 && preg_match('/^(000\.200)/', $paymentProviderCode);
    }

    public function isPending(): bool
    {
        $paymentProviderCode = $this->data['result']['code'] ?? null;

        return $this->getCode() < 400 && !preg_match('/^(000\.200)/', $paymentProviderCode);

    }

    public function getCode(): int
    {
        return $this->statusCode;
    }

}
