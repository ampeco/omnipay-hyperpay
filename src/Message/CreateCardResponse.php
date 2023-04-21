<?php

namespace Ampeco\OmnipayHyperPay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends Response implements RedirectResponseInterface
{
    /**
     * @return string
     */
    /*    public function getToken(): string
        {
            return $this->data['id'];
        }*/

    public function getRedirectUrl()
    {
        /*return "<html>
            <script src='{$this->request->getBaseUrl()}paymentWidgets.js?checkoutId={$this->getToken()}'></script>
            <form action='{$this->request->getSuccessUrl()}' class='paymentWidgets' data-brands='VISA MASTER AMEX'></form>
            </html>";*/
        return route('payments::return_url', [
            'background' => 'white',
        ]);
    }

    public function getTransactionReference(): ?string
    {
        return @$this->data['id'];
    }

     public function isRedirect(): bool
     {
         return true;
     }
}
