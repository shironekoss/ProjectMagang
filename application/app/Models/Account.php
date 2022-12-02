<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;



class Account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'Accounts_DB';
    // protected $table        = "accounts";
    // protected $primaryKey   = "account_id";
    // public $incrementing    = true;
    public $timestamps      = true;

    protected $fillable = [
        'account_name',
        'account_username',
        'account_password',
        'account_privileges',
        'account_picture',
        'account_desc',
        'account_active',
        'api_token'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
