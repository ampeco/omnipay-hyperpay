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

    public function getRecurringEntityId()
    {
        return $this->getParameter('recurring_entity_id');
    }

    public function setRecurringEntityId($value)
    {
        return $this->setParameter('recurring_entity_id', $value);
    }

    public function getPaEntityId()
    {
        return $this->getParameter('pa_entity_id');
    }

    public function setPaEntityId($value)
    {
        return $this->setParameter('pa_entity_id', $value);
    }

    public function getPaRecurringEntityId()
    {
        return $this->getParameter('pa_recurring_entity_id');
    }

    public function setPaRecurringEntityId($value)
    {
        return $this->setParameter('pa_recurring_entity_id', $value);
    }

    public function getPaymentType()
    {
        return $this->getParameter('payment_type');
    }

    public function setPaymentType($value)
    {
        return $this->setParameter('payment_type', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    /**
     * Sets the request return URL.
     *
     * @param string $value
     * @return $this
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    public function getRegistrationId()
    {
        return $this->getParameter('registrationId');
    }

    public function setRegistrationId($value)
    {
        return $this->setParameter('registrationId', $value);
    }

    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function getUserEmail()
    {
        return $this->getParameter('userEmail');
    }

    public function setuserEmail($value)
    {
        $this->setParameter('userEmail', $value);
    }

    public function getUserFirstName()
    {
        return $this->getParameter('userFirstName');
    }

    public function setUserFirstName($value)
    {
        $this->setParameter('userFirstName', $value);
    }

    public function getUserLastName()
    {
        $this->getParameter('userLastName');
    }

    public function setUserLastName($value)
    {
        $this->setParameter('userLastName', $value);
    }
}
