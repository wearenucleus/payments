<?php

namespace Nucleus\Requests;

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