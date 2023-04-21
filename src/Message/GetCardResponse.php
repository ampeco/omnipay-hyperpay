<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Ampeco\OmnipayQorPay\Message\Response;

class GetCardResponse extends Response
{
    protected string $cardBrand;

    protected string $requestId;

    protected string $token;

    public function setCardBrand($brand): void
    {
        $this->cardBrand = $brand;
    }

    public function getCardBrand(): string
    {
        return $this->cardBrand;
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    public function setRequestId(string $requestId): void
    {
        $this->requestId = $requestId;
    }

    public function setToken($token): void
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
