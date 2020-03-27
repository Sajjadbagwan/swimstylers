<?php

namespace Webkul\Masters\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Masters\Contracts\Branch as BranchContract;

class Branch extends Model implements BranchContract
{
    protected $guarded = [
        'id',
        'branch_name',
        'branch_desc',
        'branch_image',
        'created_at',
        'updated_at',
    ];

   /* protected $statusLabel = [
        'pending'         => 'Pending',
        'pending_payment' => 'Pending Payment',
        'processing'      => 'Processing',
        'completed'       => 'Completed',
        'canceled'        => 'Canceled',
        'closed'          => 'Closed',
        'fraud'           => 'Fraud',
    ];*/

    /**
     * Get the order items record associated with the order.
    
    public function getCustomerFullNameAttribute()
    {
        return $this->customer_first_name . ' ' . $this->customer_last_name;
    } */

}