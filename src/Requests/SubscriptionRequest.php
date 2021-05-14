<?php

namespace Nucleus\Requests;


/**
 * Represents a recurring payment request
 */
class SubscriptionRequest extends PaymentRequest {

    /**
     * How many times the recuring payment will be done
     */
    public int $times;

    /**
     * Day of the month which the payment will take place.
     */
    public int $day;

    /**
     * Return @param array which represents the JSON body of this request
     */
    public function toArray() : array {
        $response = parent::toArray();
        if ($this->times) {
            $response["times"] = $this->times;
        }
        if ($this->day) {
            $response["day"] = $this->day;
        }
        
        return $response;
    }

}

/**
 * Represents a Customer inside a Payment
 */
class Customer {
    /**
     * Customer's first name
     */
    public string $firstName;

    /**
     * Customer's last name
     */
    public string $lastName;

    /**
     * Customer's email address
     */
    public string $email;

    /**
     * Customer's phone
     */
    public string $phone;

    /**
     * Customer's address
     */
    public Address $address;


    public function toArray() : array {
        $params = [
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "email" => $this->email,
            "phone" => $this->phone,
        ];
        if ($this->address) {
            $params["address"] = $this->address->toArray();
        }
        return $params;
    }
}

/**
 * Represents the Address of a Customer inside a Payment
 */
class Address {
    /**
     * Address Line 1
     */
    public string $line1;

    /**
     * Address Line 2
     */
    public string $line2;

    /**
     * ZIP or postal code
     */
    public string $postcode;

    /**
     * City or town
     */
    public string $city;

    /**
     * Three-letter ISO country code
     */
    public string $country;


    public function toArray() : array {
        return [
            "line_1" => $this->line1,
            "line_2" => $this->line2,
            "postcode" => $this->postcode,
            "city" => $this->city,
            "country" => $this->country ? $this->country : "GBR",
        ];
    }
}

/**
 * Represents a list of OAuth2 scopes
 */
class ScopeList {
    /**
     * List of verification scopes to be done after a payment
     */
    public array $scopes;
    
    /**
     * Static enum for age-verification scope
     */
    public static function ageVerification() {
        $scopes = new ScopeList();
        $scopes->scopes = ["age-verification"];
        return $scopes;
    }

    public function toArray() : array {
        return $this->scopes;
    }
}

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