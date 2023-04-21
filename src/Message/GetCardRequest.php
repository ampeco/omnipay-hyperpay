<?php

namespace Ampeco\OmnipayHyperPay\Message;

class GetCardRequest extends AbstractRequest
{
    protected string $profileId;

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function getEndPoint(): string
    {
        return 'checkouts/' . $this->getToken() . '/registration';
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
        return $this->response = new GetCardResponse($this, $data, $statusCode);
    }

    public function setProfileId($value)
    {
        return $this->profileId = $value;
    }

    public function getProfileId()
    {
        return $this->profileId;
    }
}
