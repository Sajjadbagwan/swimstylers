<?php

namespace Swim\Admin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * New Shipment Mail class
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class NewShipmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The shipment instance.
     *
     * @var Shipment
     */
    public $shipment;

    /**
     * Create a new message instance.
     *
     * @param mixed $shipment
     * @return void
     */
    public function __construct($shipment)
    {
        $this->shipment = $shipment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->shipment->order;

        return $this->to($order->customer_email, $order->customer_full_name)
                ->subject(trans('shop::app.mail.shipment.subject', ['order_id' => $order->increment_id]))
                ->view('shop::emails.sales.new-shipment');
    }
}
