<?php

namespace Nucleus\Requests;

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
    public ?string $line2 = null;

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
