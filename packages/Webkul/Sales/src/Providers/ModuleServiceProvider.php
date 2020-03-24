<?php

namespace Swim\Sales\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Sales\Models\Order::class,
        \Swim\Sales\Models\OrderItem::class,
        \Swim\Sales\Models\DownloadableLinkPurchased::class,
        \Swim\Sales\Models\OrderAddress::class,
        \Swim\Sales\Models\OrderPayment::class,
        \Swim\Sales\Models\Invoice::class,
        \Swim\Sales\Models\InvoiceItem::class,
        \Swim\Sales\Models\Shipment::class,
        \Swim\Sales\Models\ShipmentItem::class,
        \Swim\Sales\Models\Refund::class,
        \Swim\Sales\Models\RefundItem::class,
    ];
}