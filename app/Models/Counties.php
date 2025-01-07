<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counties extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'counties';

    protected $fillable = [
        'county',
        'state',
        'county_file',
        'fkstateid',
        'facility_count',
    ];
}
