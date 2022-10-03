<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Master extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'Master_Db';
    // protected $table        = "accounts";
    // protected $primaryKey   = "account_id";
    // public $incrementing    = true;
    public $timestamps      = true;

    protected $fillable = [
        'kit',
        'parameter',
    ];
}
