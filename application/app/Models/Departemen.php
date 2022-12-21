<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Departemen extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'Departemen_DB';
    public $timestamps = true;
    protected $fillable = [
        'Nama_Departemen',
        'AksesTipeDatabase',
    ];
}
