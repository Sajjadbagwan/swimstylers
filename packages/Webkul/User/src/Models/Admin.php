<?php

namespace Swim\User\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Swim\User\Models\Role;
use Swim\User\Notifications\AdminResetPassword;
use Swim\User\Contracts\Admin as AdminContract;


class Admin extends Authenticatable implements AdminContract
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'role_id', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token', 'remember_token',
    ];

    /**
     * Get the role that owns the admin.
     */
    public function role()
    {
        return $this->belongsTo(RoleProxy::modelClass());
    }

    /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    /**
     * Checks if admin has permission to perform certain action.
     *
     * @param  String  $permission
     * @return Boolean
     */
    public function hasPermission($permission)
    {
        if ($this->role->permission_type == 'custom' && ! $this->role->permissions)
            return false;

        return in_array($permission, $this->role->permissions);
    }
}