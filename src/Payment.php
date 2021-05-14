<?php

namespace Nucleus;

/**
 * Payment SDK
 */
class Payment {

    private $url = "https://payments.wearenucleus.co";

    private $clientID;

    private $clientSecret;

    private $http;

    public function __construct(string $clientID, string $clientSecret){
        $this->clientID = $clientID;
        $this->clientSecret = $clientSecret;
        $this->http = new Utils\Http($this->url, $this->clientID);
    }

    /**
     * Starts a payment flow
     * @param Requests\PaymentRequest $request
     */
    public function initialize(Requests\PaymentRequest $request) {
        return $this->http->post("/api/payments", $request->toArray());
    }

    /**
     * Get payment details
     * @param string $paymentID
     */
    public function details(string $paymentID) {
        return $this->http->get("/api/payment/{$paymentID}");
    }

    /**
     * Starts a recurring payment flow
     * @param Requests\SubscriptionRequest $request
     */
    public function subscription(Requests\SubscriptionRequest $request) {
        return $this->http->post("/payments/subscribe", $request->toArray());
    }

    /**
     * Get subscription details
     * @param string $subscriptionID
     */
    public function subscriptionDetails(string $subscriptionID) {
        return $this->http->get("/payments/subscribe/{$subscriptionID}");
    }

    /**
     * Starts a payment refund flow
     * @param string $paymentID
     * @param Requests\RefundRequest $request
     */
    public function refund(string $paymentID, Requests\RefundRequest $request) {
        return $this->http->post("/payments/{$paymentID}/refund", $request->toArray());
    }

    /**
     * Get refund details
     * @param string $refundID
     */
    public function refundDetails(string $refundID) {
        return $this->http->get("/refunds/{$refundID}");
    }

    /**
     * Change the payments URL endpoint to use the sandbox environment for testing and development purposes
     */
    public function useSandbox() {
        $this->url = "https://payments.sandbox.wearenucleus.co";
        $this->http->updateURL($this->url);
    }

}