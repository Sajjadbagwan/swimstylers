<?php

namespace Webkul\Masters\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Masters\Models\Branch::class,
      /* \Webkul\Sales\Models\OrderItem::class,
        \Webkul\Sales\Models\DownloadableLinkPurchased::class,
        \Webkul\Sales\Models\OrderAddress::class,
        \Webkul\Sales\Models\OrderPayment::class,
        \Webkul\Sales\Models\Invoice::class,
        \Webkul\Sales\Models\InvoiceItem::class,
        \Webkul\Sales\Models\Shipment::class,
        \Webkul\Sales\Models\ShipmentItem::class,
        \Webkul\Sales\Models\Refund::class,
        \Webkul\Sales\Models\RefundItem::class,*/
    ];
}