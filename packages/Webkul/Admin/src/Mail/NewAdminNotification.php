<?php

namespace Swim\Admin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * New Admin Mail class
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class NewAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $order;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(config('mail.admin.address'))
                ->subject(trans('shop::app.mail.order.subject'))
                ->view('shop::emails.sales.new-admin-order');
    }
}