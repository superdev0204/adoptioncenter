<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'states';

    protected $fillable = [
        'state_code',
        'state_name',
        'statefile',
        'country',
        'agencies_count',
        'facility_count',
    ];
}
