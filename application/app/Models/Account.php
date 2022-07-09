<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Account extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'accounts';
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
    ];
}
