<?php

namespace Nucleus\Requests;

/**
 * Represents a request to refund a payment
 */
class RefundRequest {
    /**
     * Amount intended to be collected by this payment. A positive integer representing how much to charge in the smallest currency unit (e.g. 100 cents to charge $1.00)
     */
    public int $amount;

    /**
     * This is the URL to return the user to your application once they’ve approved the payment
     */
    public string $callbackURL;

    public function toArray() : array {
        return [
            "amount" => $this->amount,
            "callback_url" => $this->callbackURL,
        ];
    }
}