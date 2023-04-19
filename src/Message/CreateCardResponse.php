<?php
namespace Ampeco\OmnipayHyperPay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends Response implements RedirectResponseInterface
{
    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->data['token'];
    }

    /**
     * @return string
     */
    public function getUrlWebPay(): string
    {
        return $this->data['url'];
    }

    public function getRedirectUrl()
    {
        //TODO fix hardcoded url.
        return "<html>
            <script src='https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='{$this->getToken()}'></script>
            <form data-brands='VISA MASTER AMEX'></form>
            </html>";
    }

    public function isRedirect(): bool
    {
        return true;
    }
}
