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
        $data =
            [
                'entityId' => $this->gateway->getEntityId(),
                'paymentType' => $this->gateway->getPaymentType(),
                'amount' => $this->getTestMode() ? intval($this->getAmount()) : $this->getAmount(),
                'currency' => $this->getCurrency(),
                'merchantTransactionId' => $this->getTransactionId(),
            ];

        if ($this->getTestMode()) {
            $data['testMode'] = 'EXTERNAL';
        }

        return $data;
    }

    protected function createResponse($data, $statusCode): Response
    {
        return $this->response = new Response($this, $data, $statusCode);
    }
}
