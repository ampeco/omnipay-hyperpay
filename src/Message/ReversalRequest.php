<?php

namespace Ampeco\OmnipayHyperPay\Message;

class ReversalRequest extends AbstractRequest
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
                'entityId' => $this->gateway->getRecurringEntityId(),
                'paymentType' => $this->gateway->getPaymentType(),
            ];
    }

    protected function createResponse($data, $statusCode): Response
    {
        return $this->response = new Response($this, $data, $statusCode);
    }
}
