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
            ];
    }

    protected function createResponse($data, $statusCode): Response
    {
        return $this->response = new Response($this, $data, $statusCode);
    }
}
