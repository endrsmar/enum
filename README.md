Endrsmar\Enum is a PHP Enum implementation that has been refined over the course of couple of projects and has been extracted into a standalone package. There is a very similiar project myclabs/php-enum, I recommend you to check that one out.

### Installation
```
composer require endrsmar\php-enum
```

### Declaration
```php
<?php
use Endrsmar\Enum\Enum;

class PaymentMethod {

    const CASH = 'cash';
    const CREDIT_CARD = 'credit_card';
    const FOOD_STAMP = 'food_stamp';
    const BANK_TRANSFER = 'bank_transfer';
    const CHEQUE = 'cheque';

}
```
### Instantiation
```php
// Instantiation using const name
$paymentMethod = PaymentMethod::CASH();
// or instantiation using value
$paymentMethod = new PaymentMethod(PaymentMethod::CASH);
```

### Equality checks
```php
$paymentMethod = PaymentMethod::CASH();
// Check based on value
$paymentMethod->is(PaymentMethod::CASH); // true
// Check based on instance
$paymentMethodB = PaymentMethod::CREDIT_CARD();
$paymentMethod->is($paymentMethodB); //false
```

### Type hinting
You can use enum in type hinting
```php
public function setPaymentMethod(PaymentMethod $method) {
  ...
}
public function getPaymentMethod() : PaymentMethod {
  ...
}
```
### Interface
- `__construct(mixed $value)` Creates enum instance, checks if $value exists in enum
- `getName()` Retrieves constant name for enum instance
- `getValue()` Retrieves constant value for enum instance
- `is()` Checks for equality with either value or another enum instance
Static:
- `asArray()` Retrieves enum as associative array
- `isValidName(string $name)` Checks whether name exists in enum
- `isValidValue(mixed $value)` Checks whether value exists in enum
- `nameFor(mixed $value)` Retrieves constant name for value
- `valueOf(string $name)` Retrieves value for given name
- `__callStatic($methodName, $args)` Used to achieve instantiation by constant name calls
