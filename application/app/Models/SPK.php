<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SPK extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    // protected $collection = 'SPK';
    protected $collection = 'SPK_DB';
    public $timestamps = true;
    protected $fillable = [
        'NOSPK',
        'Tipe',
        'AirSuspensi',
        'Semi_Monocoque',
        'No_Rangka',
        'No_Mesin',
        'Parameter',
        'SPKactive',
    ];


}
