<?php

namespace Ampeco\OmnipayHyperPay\Message;

class AuthorizeRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return '/registrations/' . $this->getToken() . '/payments';
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return
            [
                'amount' => $this->getAmount(),
                'currency' => $this->getCurrency(),
                'entityId' => $this->gateway->getEntityId(),
                'paymentType' => $this->gateway->getPaymentType(),
                'shopperResultUrl' => $this->getReturnUrl(),
            ];
    }

    protected function createResponse($data, $statusCode): AuthorizeResponse
    {
        return $this->response = new AuthorizeResponse($this, $data, $statusCode);
    }
}
