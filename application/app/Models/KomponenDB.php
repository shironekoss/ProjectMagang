<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class KomponenDB extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'KomponenDB';
    // protected $table        = "accounts";
    // protected $primaryKey   = "account_id";
    // public $incrementing    = true;
    public $timestamps      = true;

    protected $fillable = [
        'NOSPK',
        'parameter',
        'kits',
    ];
}
