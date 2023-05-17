<?php

namespace Ampeco\OmnipayHyperPay\Message;

class TransactionResultRequest extends AbstractRequest
{
    protected string $registrationId;

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function setRegistrationId(string $registrationId): void
    {
        $this->registrationId = $registrationId;
    }

    public function getRegistrationId(): string
    {
        return $this->registrationId;
    }

    public function getEndpoint(): string
    {
        return '/payments/' . $this->getRegistrationId() . '?entityId=' . $this->getGateway()->getEntityId();
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return [];
    }

    protected function createResponse($data, $statusCode): Response
    {
        return $this->response = new Response($this, $data, $statusCode);
    }
}
