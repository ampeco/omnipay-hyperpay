<?php

namespace Ampeco\OmnipayHyperPay\Message;

class DeleteCardRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'DELETE';
    }

    public function getEndpoint()
    {
        return '/registrations/' . $this->getToken() . '?entityId=' . $this->getGateway()->getEntityId();
    }

    public function getData()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    protected function createResponse($data, $statusCode)
    {
        return $this->response = new DeleteCardResponse($this, $data, $statusCode);
    }
}
