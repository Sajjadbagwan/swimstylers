<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Models\AdminProxy;

class AdminsDetail extends Model
{
    protected $table = 'admins_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'profile_dsec', 'dbs_doc_file', 'ios_cert_file','signed_contract_file','max_teach_level_name','max_teach_level_stage','job_title','branch_id',
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    /**
     * Get the admins.
     */
    public function admins()
    {
        return $this->hasMany(AdminProxy::modelClass());
    }
}
