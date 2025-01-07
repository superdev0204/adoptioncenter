<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resourcecategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'resourcecategory';

    protected $fillable = [
        'category',
        'description',
        'filename',
        'approved',
        'resource_count',
        'visits',
    ];
}
