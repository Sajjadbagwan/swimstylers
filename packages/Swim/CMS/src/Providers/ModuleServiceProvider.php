<?php

namespace Swim\CMS\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\CMS\Models\CmsPage::class,
        \Swim\CMS\Models\CmsPageTranslation::class
    ];
}