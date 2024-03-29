<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends Response implements RedirectResponseInterface


{
    public function __construct(AbstractRequest $request, $data, $statusCode, private $redirectUrl)
    {
        parent::__construct($request, $data, $statusCode);
    }
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    public function getTransactionReference(): ?string
    {
        return $this->data['id'] ?? null;
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function isSuccessful(): bool
    {
        $paymentProviderCode = $this->data['result']['code'] ?? '';

        return $this->getCode() < 400
            && (preg_match('/^(000\.200)/', $paymentProviderCode)
                || preg_match('/^(000.000.|000.100.1|000.[36]|000.400.1[12]0)/', $paymentProviderCode));
    }
}
