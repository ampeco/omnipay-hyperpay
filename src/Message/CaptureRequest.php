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
        $data =
            [
                'amount' => $this->getTestMode() ? intval($this->getAmount()) : $this->getAmount(),
                'currency' => $this->getCurrency(),
                'entityId' => $this->gateway->getPaRecurringEntityId(),
                'paymentType' => $this->gateway->getPaymentType(),
                'merchantTransactionId' => $this->getMerchantTransactionId(),
                'referencedPaymentId' => $this->getTransactionReference()
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
