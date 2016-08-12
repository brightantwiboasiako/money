# money
This is a wrapper class for money and currency
that enhances internationalization using Locales.

Installation:

Using Composer:

<code>
composer require afoakwahsoftware/money
</code>

Usage:

Create a new money instance:

<code>
<?php

use \Money\Money;

use \Money\Currency;

$money = new Money(50.00, new Currency('en-US'));

echo $money


?>

</code>
The above code will print 
$50.00
