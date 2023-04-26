<?php

namespace Ampeco\OmnipayHyperPay\Message;

class CreateCardRequest extends AbstractRequest
{
    protected string $entityId;
    protected string $paymentType;

    public function getEndpoint(): string
    {
        return '/checkouts';
    }

    public function getEntityId(): string
    {
        return $this->entityId;
    }

    public function setEntityId(string $entityId): void
    {
        $this->entityId = $entityId;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function setPaymentType(string $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return
            [
                'createRegistration' => 'true', // !!! string not boolean !!!
                'currency' => $this->getCurrency(),
                'entityId' => $this->getEntityId(),
            ];
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    protected function createResponse($data, $statusCode)
    {
        $token = json_decode($data, true)['id'] ?? null; //TODO probably make additional checks for success (use $statusCode)
        $this->getGateway()->setToken($token);

        return $this->response = new CreateCardResponse($this, $data, $statusCode);
    }
}
