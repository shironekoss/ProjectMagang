<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SavedConversionResult extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'SavedConversionResult';
    protected $fillable = [
        'NOSPK',
        'stall',
        'kode',
        'kit',
        'namastall',
        'Departemen',
        'checked',
        'parameter',
        'status',
        'errors',
        'created_at',
        'updated_at'
    ];
}
