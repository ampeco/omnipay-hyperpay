<?php

namespace Ampeco\OmnipayHyperPay\Message;

class CaptureRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return '/payments/' . $this->getTransactionReference();
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
                'paymentBrand' => $this->getCardBrand(),
            ];
    }

    protected function createResponse($data, $statusCode): CaptureResponse
    {
        return $this->response = new CaptureResponse($this, $data, $statusCode);
    }
}
