<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'key', 'name', 'nameEn', 'level', 'province_id'
    ];
    protected $filterable = [
        'key',
        'name',
        'nameEn',
        'level',
        'province_id'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
