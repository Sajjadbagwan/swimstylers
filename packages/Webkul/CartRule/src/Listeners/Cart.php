<?php

namespace Swim\CartRule\Listeners;

use Swim\CartRule\Helpers\CartRule;

/**
 * Cart event handler
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class Cart
{
    /**
     * CartRule object
     *
     * @var CartRule
     */
    protected $cartRuleHepler;

    /**
     * Create a new listener instance.
     *
     * @param  Swim\CartRule\Repositories\CartRule $cartRuleHepler
     * @return void
     */
    public function __construct(CartRule $cartRuleHepler)
    {
        $this->cartRuleHepler = $cartRuleHepler;
    }

    /**
     * Aplly valid cart rules to cart
     * 
     * @param Cart $cart
     * @return void
     */
    public function applyCartRules($cart)
    {
        $this->cartRuleHepler->collect();
    }
}