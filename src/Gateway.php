<?php

namespace Ampeco\OmnipayHyperPay;

use Ampeco\OmnipayTransbank\Message\CreateCardRequest;
use Ampeco\OmnipayTransbank\Message\DeleteCardRequest;
use Ampeco\OmnipayTransbank\Message\GetInscriptionTokenRequest;
use Ampeco\OmnipayTransbank\Message\NotificationRequest;
use Ampeco\OmnipayTransbank\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
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

    public function getAccessToken()
    {
        return $this->getParameter('accessToken');
    }

    public function setAccessToken($value)
    {
        return $this->setParameter('accessToken', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\HyperPay\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\HyperPay\Message\CompletePurchaseRequest', $parameters);
    }

}
