# Nucleus Payments PHP SDK

PHP SDK to intialize OpenBanking Payments.

## Installation

```bash
composer require wearenucleus/payments
```

## Get Started

```php
<?php

require __DIR__ . '/vendor/autoload.php';


use Nucleus\Constants\Currency;
use Nucleus\Payment;
use Nucleus\Requests\Address;
use Nucleus\Requests\Customer;
use Nucleus\Requests\PaymentRequest;

$request = new PaymentRequest();
$request->amount = 100;
$request->currency = Currency::BritishPound;
$request->callbackURL = "http://mysite.com/callback";
$request->reference = "Nucleus - 1 pound";
$request->customer = new Customer;
$request->customer->firstName = "John";
$request->customer->lastName = "Snow";
$request->customer->email = "support@verifymyage.co.uk";
$request->customer->phone = "+44712345678";
$request->customer->address = new Address();
$request->customer->address->postcode = "E2 8HD";
$request->customer->address->line1 = "37 Cremer Street";
$request->customer->address->city = "London";
$request->customer->address->country = "GB";

$payment = new Payment(getenv('NUCLEUS_CLIENT_ID'), getenv('NUCLEUS_CLIENT_SECRET'));
$payment->useSandbox();
$response = $payment->initialize($request);

header("Location: {$response['payment_url']}");
```