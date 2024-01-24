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
        return $this->data['registrationId'];
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

    public function getCardReference(): ?string
    {
        return $this->isSuccessful() ? $this->getToken() : null;
    }

    public function getPaymentMethod(): object
    {
        $result = new \stdClass();

        $result->imageUrl = '';
        $result->last4 = $this->getLast4();
        $result->cardType = $this->getCardBrand();

        $result->expirationMonth = $this->data['card']['expiryMonth'];
        $result->expirationYear = $this->data['card']['expiryYear'];

        return $result;
    }

    public function getTransactionReference()
    {
        return $this->data['id'];
    }

}
