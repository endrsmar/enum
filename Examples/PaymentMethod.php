<?php

/**
 *
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 *
 * For the full copyright and license information, please view the file LICENSE that was distributed with this source code.
 */
namespace Endrsmar\Enum\Examples;

use Endrsmar\Enum\Enum;
/**
 * @author Martin Endršt <endrst.martin@gmail.com>
 */
class PaymentMethod extends Enum {
    
    const CASH = 'cash';
    const CREDIT_CARD = 'credit_card';
    const FOOD_STAMP = 'food_stamp';
    const BANK_TRANSFER = 'bank_transfer';
    const CHEQUE = 'cheque';
    
}
