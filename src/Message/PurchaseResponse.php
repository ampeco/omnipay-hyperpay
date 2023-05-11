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

    public function isSuccessful(): bool
    {
        //TODO refactor @
        $paymentProviderCode = @$this->data['result']['code'];

        return $this->getCode() < 400 && $paymentProviderCode == '000.000.000';
    }

    public function isPending(): bool
    {
        $paymentProviderCode = @$this->data['result']['code'];

        return $this->getCode() < 400 && $paymentProviderCode == '000.200.000';
    }

    public function getMessage()
    {
        if (!empty($this->data['result']) && !empty($this->data['result']['description'])) {
            return $this->data['result']['description'];
        }

        return null;
    }

    public function getErrors()
    {
        if (isset($this->data['result']) && isset($this->data['result']['parameterErrors'])) {
            return $this->data['result']['parameterErrors'];
        }

        return null;
    }

    public function getCheckoutId()
    {
        if (!empty($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }

    public function getResultCode()
    {
        if (!empty($this->data['result']) && !empty($this->data['result']['code'])) {
            return $this->data['result']['code'];
        }

        return null;
    }

    public function getCode(): int
    {
        return $this->statusCode;
    }

    public function getTransactionReference()
    {
        if (!empty($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }


    public function getRedirectUrl()
    {
        $url = $this->data['redirect']['url'];
        foreach ($this->getRedirectData() as $key => $value) {
            if ($key === 0) {
                $url .= '?' . $value['name'] . '=' . $value['value'];
            } else {
                $url .= '&' . $value['name'] . '=' . $value['value'];
            }
        }

        return $url;
    }

    public function getRedirectData()
    {
        return @$this->data['redirect']['parameters'];
    }
}
