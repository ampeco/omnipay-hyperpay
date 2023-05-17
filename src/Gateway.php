<?php

namespace Ampeco\OmnipayHyperPay;

use Ampeco\OmnipayHyperPay\Message\AbstractRequest;
use Ampeco\OmnipayHyperPay\Message\AuthorizeRequest;
use Ampeco\OmnipayHyperPay\Message\CaptureRequest;
use Ampeco\OmnipayHyperPay\Message\CreateCardRequest;
use Ampeco\OmnipayHyperPay\Message\DeleteCardRequest;
use Ampeco\OmnipayHyperPay\Message\GetCardInfoRequest;
use Ampeco\OmnipayHyperPay\Message\PurchaseRequest;
use Ampeco\OmnipayHyperPay\Message\ReversalRequest;
use Ampeco\OmnipayHyperPay\Message\TransactionResultRequest;
use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    use CommonParameters;

    const API_URL_PROD = 'https://oppwa.com/v1';
    const API_URL_TEST = 'https://test.oppwa.com/v1';

    public function getName(): string
    {
        return 'HyperPay';
    }

    public function getDefaultParameters()
    {
        return [
            'accessToken' => '',
            'entityId' => '',
            'testMode' => false,
        ];
    }

    public function getBaseUrl(): string
    {
        return $this->getTestMode() ? static::API_URL_TEST : static::API_URL_PROD;
    }

    public function getEntityId()
    {
        return $this->getParameter('entityId');
    }

    public function setEntityId($value)
    {
        return $this->setParameter('entityId', $value);
    }

    public function createCard(array $options = [])
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function authorize(array $options = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    public function capture(array $options = [])
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    public function void(array $options = [])
    {
        return $this->createRequest(ReversalRequest::class, $options);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\HyperPay\Message\CompletePurchaseRequest', $parameters);
    }

    public function getCreateCardCurrency(): string
    {
        return 'SAR';
    }


    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    protected function createRequest($class, array $parameters)
    {
        /** @var AbstractRequest */
        $req = parent::createRequest($class, $parameters);

        return $req->setGateway($this);
    }

    public function getCardInfo($options = [])
    {
        return $this->createRequest(GetCardInfoRequest::class, $options);
    }

    public function deleteCard(array $parameters = [])
    {
        return $this->createRequest(DeleteCardRequest::class, $parameters);
    }

    public function transactionResult(array $parameters = [])
    {
        return $this->createRequest(TransactionResultRequest::class, $parameters);
    }
}
