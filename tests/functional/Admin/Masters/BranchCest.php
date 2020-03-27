<?php

namespace Tests\Functional\Admin\Masters;


use FunctionalTester;
use Webkul\Masters\Models\Branch;


class BranchCest
{
    public function testIndex(FunctionalTester $I): void
    {
        $branch = $I->have(Branch::class);

        $I->loginAsAdmin();
        $I->amOnAdminRoute('admin.dashboard.index');
        $I->click(__('admin::app.layouts.masters'), '//*[contains(@class, "navbar-left")]');
        $I->seeCurrentRouteIs('admin.masters.branch.index');
        $I->click(__('admin::app.layouts.branch'), '//*[contains(@class, "aside-nav")]');

        $I->seeCurrentRouteIs('admin.masters.branch.index');
        $I->see($branch->id, '//script[@type="text/x-template"]');
        $I->see($branch->branch_name, '//script[@type="text/x-template"]');
    }
}
