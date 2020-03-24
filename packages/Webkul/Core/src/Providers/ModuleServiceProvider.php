<?php

namespace Swim\Core\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Core\Models\Channel::class,
        \Swim\Core\Models\CoreConfig::class,
        \Swim\Core\Models\Country::class,
        \Swim\Core\Models\CountryTranslation::class,
        \Swim\Core\Models\CountryState::class,
        \Swim\Core\Models\CountryStateTranslation::class,
        \Swim\Core\Models\Currency::class,
        \Swim\Core\Models\CurrencyExchangeRate::class,
        \Swim\Core\Models\Locale::class,
        \Swim\Core\Models\Slider::class,
        \Swim\Core\Models\SubscribersList::class
    ];
}