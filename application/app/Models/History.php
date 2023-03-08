<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'History';
    public $timestamps = true;
    protected $fillable = [
        'LISTSPK',
    ];
}
