<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Masterkit extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'MasterKit';
    public $timestamps      = true;
    protected $fillable = [
        'kode_kit',
        'stall',
        'siteID',
        'nama_kit',
        'komponen',
        'created_at',
        'updated_at',
    ];
}
