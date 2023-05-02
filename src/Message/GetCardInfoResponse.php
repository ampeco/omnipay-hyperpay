<?php

namespace Ampeco\OmnipayHyperPay\Message;

class GetCardInfoResponse extends Response
{
    public function __construct(AbstractRequest $request, $data, int $code, int $userId)
    {
        parent::__construct($request, $data, $code);
        $this->userId = $userId;
    }
    public function getToken()
    {
        return $this->data['id'];
    }

    public function getLast4()
    {
        return $this->data['card']['last4Digits'];
    }

    public function getCardBrand()
    {
        return $this->data['paymentBrand'];
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function isSuccessful(): bool
    {
        $paymentProviderCode = @$this->data['result']['code'];

        return $this->getCode() < 400 && $paymentProviderCode == '000.100.110';
    }
}
