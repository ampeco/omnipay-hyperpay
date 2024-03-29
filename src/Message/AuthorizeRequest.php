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
                'amount' => $this->getTestMode() ? intval($this->getAmount()) : $this->getAmount(),
                'currency' => $this->getCurrency(),
                'entityId' => $this->gateway->getPaRecurringEntityId(),
                'paymentType' => $this->gateway->getPaymentType(),
                'shopperResultUrl' => $this->getReturnUrl(),
                'standingInstruction.mode' => 'REPEATED',
                'standingInstruction.type' => 'UNSCHEDULED',
                'standingInstruction.source' => 'MIT',
                'merchantTransactionId' => $this->getTransactionReference()
            ];
    }

    protected function createResponse($data, $statusCode): AuthorizeResponse
    {
        return $this->response = new AuthorizeResponse($this, $data, $statusCode);
    }
}
