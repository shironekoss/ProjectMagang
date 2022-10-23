<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Stall extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'DB_Stall';
    public $timestamps = true;
    protected $fillable = [
        'NamaStall',
        'JumlahStall',
        'NamaDepartemen',
    ];
}
