<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Ampeco\OmnipayHyperPay\Gateway;
use Omnipay\Common\Message\AbstractRequest as OmniPayAbstractRequest;

abstract class AbstractRequest extends OmniPayAbstractRequest
{
    protected ?Gateway $gateway;

    abstract public function getEndpoint();

    public function setGateway(Gateway $gateway): static
    {
        $this->gateway = $gateway;

        return $this;
    }

    public function getGateway()
    {
        return $this->gateway;
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->gateway->getAccessToken(),
        ];
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->gateway->getBaseUrl() . $this->getEndpoint(),
            $this->getHeaders(),
            http_build_query($data),
        );

        return $this->createResponse(
            $httpResponse->getBody()->getContents(),
            $httpResponse->getStatusCode(),
        );
    }

/*    public function getSuccessUrl(): string
    {
        info('we are in getSuccessUrl ===');
        info(json_encode($this->getData()));

        return route('payments::return_url', [
            'background' => 'white',
        ]);
    }*/

    public function getSuccessUrl()
    {
        return $this->getParameter('successUrl');
    }

    public function setSuccessUrl($value)
    {
        return $this->setParameter('successUrl', $value);
    }
}
