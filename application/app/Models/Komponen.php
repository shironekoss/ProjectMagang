<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'komponen';
    public $timestamps= true;

    protected $fillable = [
        'kode_komponen',
        'nama_komponen',
        'kode_kit',
        'KIT',
        'kode_mobil',
        'parameter_1',
    ];

}
