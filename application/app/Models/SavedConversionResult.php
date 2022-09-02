<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class SavedConversionResult extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'SavedConversionResult';
    protected $fillable = [
        'NOSPK',
        'stall',
        'kode',
        'kit',
        'parameter',
        'created_at',
        'updated_at'
    ];
}
