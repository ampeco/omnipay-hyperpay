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
        return '/transactions';
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }

    protected function createResponse($data, $statusCode): PurchaseResponse
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }
}
