<?php

namespace Nucleus\Requests;


/**
 * Represents a single payment request
 */
class PaymentRequest {

    /**
     * Amount intended to be collected by this payment. A positive integer representing how much to charge in the smallest currency unit (e.g. 100 cents to charge $1.00)
     */
    public int $amount;

    /**
     * Three letter ISO currency code, in uppercase. Must be a supported currency
     */
    public string $currency;

    /**
     * This is the URL to return the user to your application once they’ve approved the payment
     */
    public string $callbackURL;

    /**
     * This is the URL to post the status of the payment
     */
    public ?string $webhookURL = null;

    /**
     * Suggested reference which will appear on the user bank transaction. Keep in mind that the user will be able to change it before paying.
     */
    public string $reference;

    /**
     * Customer information
     */
    public Customer $customer;

    /**
     * Allows you to age verify a customer as part of the payment process. Available Options: ["age-verification"]
     */
    public ?ScopeList $scopes = null;


    /**
     * Return @param array which represents the JSON body of this request
     */
    public function toArray() : array {
        $params = [
            "amount" => $this->amount,
            "currency" => $this->currency,
        ];

        if ($this->callbackURL) {
            $params["callback_url"] = $this->callbackURL;
        }
        if ($this->webhookURL !== null) {
            $params["webhook_url"] = $this->webhookURL;
        }
        if ($this->reference) {
            $params["reference"] = $this->reference;
        }
        if ($this->customer) {
            $params["customer"] = $this->customer->toArray();
        }
        if ($this->scopes !== null) {
            $params["scopes"] = $this->scopes->toArray();
        }

        return $params;
    }

}
