<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class CreateCardRequest extends AbstractRequest
{
    protected string $entityId;
    protected string $paymentType;
    protected string $userFirstName;
    protected string $userLastName;
    protected string $userEmail;
    protected string $redirectUrl;

    public function getEndpoint(): string
    {
        return '/checkouts';
    }

    public function getEntityId(): string
    {
        return $this->entityId;
    }

    public function setEntityId(string $entityId): void
    {
        $this->entityId = $entityId;
    }

    public function setUserFirstName($userFirstName): void
    {
        $this->userFirstName = $userFirstName;
    }

    public function getUserFirstName(): string
    {
        return $this->userFirstName;
    }

    public function setUserLastName($userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    public function setUserEmail($userEmail): void
    {
        $this->userEmail = $userEmail;
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function setRedirectUrl($redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }


    /**
     * @inheritDoc
     */
    public function getData()
    {
        $data =
            [
                'createRegistration' => 'true', // !!! string not boolean !!!
                'currency' => $this->getCurrency(),
                'entityId' => $this->getEntityId(),
                'standingInstruction.source' => 'CIT',
                'standingInstruction.mode' => 'INITIAL',
                'merchantTransactionId' => $this->getTransactionId(),
                'customer.givenName' => $this->getUserFirstName(),
                'customer.surname' => $this->getUserLastName(),
                'customer.email' => $this->getUserEmail(),
                'amount' => $this->getTestMode() ? intval($this->getAmount()) : $this->getAmount(),
                'paymentType' => $this->gateway->getPaymentType(),
                'standingInstruction.type' => 'UNSCHEDULED',
                'integrity' => 'true',
            ];

        if ($this->getTestMode()) {

            $data['testMode'] = 'EXTERNAL';
        }

        return $data;
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * @throws InvalidRequestException
     */
    protected function createResponse($data, $statusCode): CreateCardResponse
    {
        $token = json_decode($data, true)['id'] ?? null;
        $integrity = json_decode($data, true)['integrity'] ?? null;
        if (is_null($token)) {
            $this->tryToLog($data, $statusCode);
            throw new InvalidRequestException('Token is missing');
        }
        $this->getGateway()->setToken($token);
        $this->getGateway()->setIntegrity($integrity);

        return $this->response = new CreateCardResponse($this, $data, $statusCode, $this->getRedirectUrl());
    }

    private function tryToLog($data, $statusCode): void
    {
        if (function_exists('info')) {
           info('Hyperpay Call: CreateCard - Token is missing', [
               'payment_processor' => 'Hyperpay',
               'data' => $data,
               'status_code' => $statusCode,
           ]);
        }
    }
}
