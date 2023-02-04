<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SPK_attribute_tambahan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'SPK_Settings';
    public $timestamps = true;
    protected $fillable = [
        'NOSPK',
        'check',
        'checkfull',
    ];
}
