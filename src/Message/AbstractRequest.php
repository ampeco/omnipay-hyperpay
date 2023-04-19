<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Ampeco\OmnipayHyperPay\Gateway;
use Omnipay\Common\Message\AbstractRequest as OmniPayAbstractRequest;

abstract class AbstractRequest extends OmniPayAbstractRequest
{
    abstract public function getEndpoint();

    const API_URL_PROD = 'https://oppwa.com/v1/';

    const API_URL_TEST = 'https://test.oppwa.com/v1/';

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
            'Content-Type' => 'application/x-www-form-urlencoded',
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
            http_build_query($data),
        );

        return $this->createResponse(
            $httpResponse->getBody()->getContents(),
            $httpResponse->getStatusCode(),
        );
    }

    public function getSuccessUrl(): string
    {
        return route('payments::return_url', [
            'background' => 'white',
        ]);
    }
}
