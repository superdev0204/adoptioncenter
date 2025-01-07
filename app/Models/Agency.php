<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'adoptionagencies';

    protected $fillable = [
        'name',
        'status',
        'address',
        'city',
        'county',
        'state',
        'zip',
        'phone',
        'contact',
        'district_office',
        'do_phone',
        'approved',
        'license_no',
        'created_date',
        'ludate',
        'email',
        'website',
        'details',
        'services',
        'adoption_process',
        'lat',
        'lng',
        'user_id',
    ];
}
