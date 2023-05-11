<?php

namespace Ampeco\OmnipayHyperPay\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return '/registrations/' . $this->getToken() . '/payments';
    }

    public function getCardBrand()
    {
        return $this->getParameter('payment_brand');
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

    protected function createResponse($data, $statusCode): PurchaseResponse
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }
}
