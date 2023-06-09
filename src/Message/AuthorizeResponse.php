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
        $paymentProviderCode = $this->data['result']['code'] ?? '';

        return $this->getCode() < 400 && preg_match('/^(000.000.|000.100.1|000.[36]|000.400.1[12]0)/', $paymentProviderCode);
    }

    public function isPending(): bool
    {
        $paymentProviderCode = $this->data['result']['code'] ?? '';

        return $this->getCode() < 400 && preg_match('/^(000\.200)/', $paymentProviderCode);

    }

    public function getCode(): int
    {
        return $this->statusCode;
    }

}
