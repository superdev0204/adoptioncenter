<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agencylog extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'adoptionagencylogs';
    
    protected $fillable = [
        'agency_id',
        'name',
        'address',
        'city',
        'county',
        'state',
        'zip',
        'phone',
        'contact',
        'email',
        'website',
        'details',
        'ip_address',
        'approved',
        'created',
        'updated',
        'user_id',
    ];

    protected $casts = [
        'updated' => 'datetime'
    ];

    public function agency(): BelongsTo{
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function getEditableFields()
    {
        return [
            'name' => 'Name',
            'address' => 'Address',
            'city' => 'City',
            'county' => 'County',
            'state' => 'State',
            'zip' => 'Postal',
            'phone' => 'Phone',
            'contact' => 'Contact',
            'email' => 'Email',
            'website' => 'Website',
            'details' => 'Details',
        ];
    }
}
