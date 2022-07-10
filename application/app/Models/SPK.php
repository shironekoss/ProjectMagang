<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class SPK extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'SPK';
    public $timestamps      = true;

    protected $fillable = [
        'NoSPK',
        'Nama',
        'Alamat',
        'TanggalPenerimaan',
        'TanggalSPK',
        'Status',
        'Mobil',
        'Detail',
        'Last_edit',
        'status_SPK'
    ];
}
