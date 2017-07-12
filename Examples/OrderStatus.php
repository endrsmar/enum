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
class OrderStatus extends Enum {
    
    const CREATED = 'new';
    const PROCESSING = 'processing';
    const REVIEW = 'review';
    const DISPATCHED = 'dispatched';
    const FINISHED = 'finished';
    const CANCELLED = 'cancelled';    
    
}
