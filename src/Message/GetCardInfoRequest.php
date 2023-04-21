<?php

namespace Ampeco\OmnipayHyperPay\Message;

class GetCardInfoRequest extends AbstractRequest
{
    protected string $cardReference;
    protected int $userId;

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function getEndpoint(): string
    {
        return '/checkouts/' . $this->getCardReference() . '/registration?entityId=' . $this->getGateway()->getEntityId();
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
        return $this->response = new GetCardInfoResponse($this, $data, $statusCode, $this->getUserId());
    }

    public function setCardReference($value)
    {
        return $this->cardReference = $value;
    }

    public function getCardReference()
    {
        return $this->cardReference;
    }

    public function setUserId($value)
    {
        return $this->userId = $value;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
