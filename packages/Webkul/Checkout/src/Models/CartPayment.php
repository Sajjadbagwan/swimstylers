<?php

namespace Swim\Checkout\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Checkout\Contracts\CartPayment as CartPaymentContract;

class CartPayment extends Model implements CartPaymentContract
{
    protected $table = 'cart_payment';
}