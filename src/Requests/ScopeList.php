<?php

namespace Nucleus\Requests;


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