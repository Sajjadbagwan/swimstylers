<?php

namespace Swim\Master\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
       \Swim\Master\Models\Branch::class,
      /*   \Swim\Master\Models\OrderItem::class,
        \Swim\Master\Models\DownloadableLinkPurchased::class,
        \Swim\Master\Models\OrderAddress::class,
        \Swim\Master\Models\OrderPayment::class,
        \Swim\Master\Models\Invoice::class,
        \Swim\Master\Models\InvoiceItem::class,
        \Swim\Master\Models\Shipment::class,
        \Swim\Master\Models\ShipmentItem::class,
        \Swim\Master\Models\Refund::class,
        \Swim\Master\Models\RefundItem::class,*/
    ];
}