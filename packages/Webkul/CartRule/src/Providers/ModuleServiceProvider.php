<?php

namespace Swim\CartRule\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\CartRule\Models\CartRule::class,
        \Swim\CartRule\Models\CartRuleTranslation::class,
        \Swim\CartRule\Models\CartRuleCustomer::class,
        \Swim\CartRule\Models\CartRuleCoupon::class,
        \Swim\CartRule\Models\CartRuleCouponUsage::class
    ];
}