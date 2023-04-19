<?php

namespace Ampeco\OmnipayHyperPay;

use Ampeco\OmnipayHyperPay\Message\AbstractRequest;
use Ampeco\OmnipayHyperPay\Message\CreateCardRequest;
use Ampeco\OmnipayTransbank\Message\DeleteCardRequest;
use Ampeco\OmnipayTransbank\Message\GetInscriptionTokenRequest;
use Ampeco\OmnipayTransbank\Message\NotificationRequest;
use Ampeco\OmnipayTransbank\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    use CommonParameters;

    public function getName(): string
    {
        return 'HyperPay';
    }

    public function getDefaultParameters()
    {
        return array(
            'accessToken'   => '',
            'entityId'      => '',
            'testMode'      => false
        );
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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\HyperPay\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\HyperPay\Message\CompletePurchaseRequest', $parameters);
    }

    public function getCreateCardCurrency(): string
    {
        return 'SAR';
    }

    public function getCreateCardPaymentType(): string
    {
        return 'DB';
    }

    protected function createRequest($class, array $parameters)
    {
        /** @var AbstractRequest */
        $req = parent::createRequest($class, $parameters);

        return $req->setGateway($this);
    }

}
