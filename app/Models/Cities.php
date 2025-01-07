<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'cities';

    protected $fillable = [
        'city',
        'county',
        'state',
        'fkcountyid',
        'fkstateid',
        'latitude',
        'longitude',
        'facility_count',
        'filename',
        'agencies_count',
    ];
}
