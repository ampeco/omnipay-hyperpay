<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

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
                'recurringType' => 'REGISTRATION_BASED',
                'standingInstruction.source' => 'CIT',
                'standingInstruction.mode' => 'INITIAL',

            ];
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * @throws InvalidRequestException
     */
    protected function createResponse($data, $statusCode): CreateCardResponse
    {
        $token = json_decode($data, true)['id'] ?? null;
        if (is_null($token)) {
            throw new InvalidRequestException('Token is missing');
        }
        $this->getGateway()->setToken($token);

        return $this->response = new CreateCardResponse($this, $data, $statusCode);
    }
}
