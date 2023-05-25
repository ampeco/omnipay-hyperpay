<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    private int $code;

    /**
     * @param AbstractRequest $request
     * @param $data
     * @param int $code
     */
    public function __construct(AbstractRequest $request, $data, int $code)
    {
        parent::__construct($request, $data);
        $this->data = json_decode($data, true);
        $this->code = $code;
    }

    public function getMessage()
    {
        return $this->data['result']['description'] ?? null;
    }

    /**
     * If request is not successful, error message is provided
     *
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->data['result']['parameterErrors'] ?? null;
    }

    public function getCode(): int|string|null
    {
        return $this->code;
    }

    public function getRedirectData()
    {
        return $this->data['redirect']['parameters'] ?? null;
    }

    public function getRedirectUrl()
    {
        $url = $this->data['redirect']['url'];
        foreach ($this->getRedirectData() as $key => $value) {
            $url .= $key === 0 ? '?' . $value['name'] . '=' . $value['value'] : '&' . $value['name'] . '=' . $value['value'];
        }

        return $url;
    }

    public function isScaRequired(): bool
    {
        return !empty($this->data['redirect']);
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

    public function getResultCode()
    {
        if (!empty($this->data['result']) && !empty($this->data['result']['code'])) {
            return $this->data['result']['code'];
        }

        return null;
    }

    public function getTransactionReference()
    {
        if (!empty($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }
}
