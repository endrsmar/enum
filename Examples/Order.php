<?php

/**
 *
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 *
 * For the full copyright and license information, please view the file LICENSE that was distributed with this source code.
 */
namespace Endrsmar\Enum\Examples;

/**
 * @author Martin Endršt <endrst.martin@gmail.com>
 * Order is your typical entity, in this class we skip all the usual attributes and 
 * only include the enum ones
 */
class Order {
    
    /**
     * @var PaymentMethod
     */
    private $paymentMethod;
    
    /**
     * @var OrderStatus
     */
    private $orderStatus;
    
    /**
     * @return \Endrsmar\Enum\Examples\PaymentMethod
     */
    public function getPaymentMethod() : PaymentMethod {
        return $this->paymentMethod;
    }
    
    /**
     * @param \Endrsmar\Enum\Examples\PaymentMethod $paymentMethod
     * @return \Endrsmar\Enum\Examples\Order
     */
    public function setPaymentMethod(PaymentMethod $paymentMethod) : Order {
        $this->paymentMethod = $paymentMethod;
        if ($this->paymentMethod->is(PaymentMethod::BANK_TRANSFER)) {
            // generate variable symbol
        }
        return $this;
    }
    
    /**
     * @return \Endrsmar\Enum\Examples\OrderStatus
     */
    public function getOrderStatus() : OrderStatus {
        return $this->orderStatus;
    }
    
    /**
     * @param \Endrsmar\Enum\Examples\OrderStatus $orderStatus
     * @return \Endrsmar\Enum\Examples\Order
     */
    public function setOrderStatus(OrderStatus $orderStatus) : Order {
        $this->orderStatus = $orderStatus;
        if ($this->orderStatus->is(OrderStatus::DISPATCHED)) {
            // Send email information
        } elseif ($this->orderStatus->is(OrderStatus::FINISHED)) {
            // Generate report
        }
        return $this;
    }
    
}