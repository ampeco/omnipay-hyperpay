<?php

namespace Ampeco\OmnipayHyperPay;

trait CommonParameters
{
    public function getAccessToken()
    {
        return $this->getParameter('access_token');
    }

    public function setAccessToken($value)
    {
        return $this->setParameter('access_token', $value);
    }

    public function getEntityId()
    {
        return $this->getParameter('entity_id');
    }

    public function setEntityId($value)
    {
        return $this->setParameter('entity_id', $value);
    }

    public function getPaymentType()
    {
        return $this->getParameter('payment_type');
    }

    public function setPaymentType($value)
    {
        return $this->setParameter('payment_type', $value);
    }
}
