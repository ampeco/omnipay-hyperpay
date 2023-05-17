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

    public function getCode(): int
    {
        return $this->statusCode;
    }

}
