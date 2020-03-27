<?php

namespace Swim\Attribute\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Attribute\Models\Attribute::class,
        \Swim\Attribute\Models\AttributeFamily::class,
        \Swim\Attribute\Models\AttributeGroup::class,
        \Swim\Attribute\Models\AttributeOption::class,
        \Swim\Attribute\Models\AttributeOptionTranslation::class,
        \Swim\Attribute\Models\AttributeTranslation::class,
    ];
}