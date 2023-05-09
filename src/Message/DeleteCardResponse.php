<?php

namespace Ampeco\OmnipayHyperPay\Message;

class DeleteCardResponse extends Response
{
    public function isSuccessful(): bool
    {
        $paymentProviderCode = @$this->data['result']['code'];

        return $this->getCode() < 400 && $paymentProviderCode == '000.100.110';
    }

    public function getMessage()
    {
        return $this->data['result']['description'] ?? parent::getMessage();
    }
}
