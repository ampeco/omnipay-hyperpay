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
        return $this->getTestMode() ? ['testMode' => 'EXTERNAL'] : [];
    }

    /**
     * @inheritdoc
     */
    protected function createResponse($data, $statusCode): Response
    {
        return $this->response = new Response($this, $data, $statusCode);
    }
}
