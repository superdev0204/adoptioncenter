<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'comments';

    protected $fillable = [
        'agency_id',
        'name',
        'email',
        'comment',
        'approved',
        'ip_address',
        'created',
    ];
    protected $casts = [
        'created' => 'datetime'
    ];

    public function agency(): BelongsTo{
        return $this->belongsTo(Agency::class, 'agency_id');
    }
}
