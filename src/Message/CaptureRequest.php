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
                'amount' => $this->getTestMode() ? intval($this->getAmount()) : $this->getAmount(),
                'currency' => $this->getCurrency(),
                'entityId' => $this->gateway->getPaRecurringEntityId(),
                'paymentType' => $this->gateway->getPaymentType(),
                'merchantTransactionId' => $this->getTransactionReference()
            ];
    }

    protected function createResponse($data, $statusCode): Response
    {
        return $this->response = new Response($this, $data, $statusCode);
    }
}
