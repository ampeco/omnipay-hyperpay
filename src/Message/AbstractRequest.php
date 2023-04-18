<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Ampeco\OmnipayHyperPay\Gateway;
use Omnipay\Common\Message\AbstractRequest as OmniPayAbstractRequest;

abstract class AbstractRequest extends OmniPayAbstractRequest
{
    abstract public function getEndpoint();

    const API_URL_PROD = 'https://oppwa.com';

    const API_URL_TEST = 'https://test.oppwa.com';

    protected ?Gateway $gateway;

    public function setGateway(Gateway $gateway)
    {
        $this->gateway = $gateway;

        return $this;
    }

    public function getGateway()
    {
        return $this->gateway;
    }

    public function getBaseUrl()
    {
        return $this->getTestMode() ? static::API_URL_TEST : static::API_URL_PROD;
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->gateway->getAccessToken(),
        ];
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
          $this->getHttpMethod(),
           $this->getBaseUrl() . ltrim($this->getEndpoint(), '/'),
            $this->getHeaders(),
            json_encode($data),
        );

        return $this->createResponse(
        $httpResponse->getBody()->getContents(),
            $httpResponse->getStatusCode()
        );
    }
}
