<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, Filterable, SoftDeletes;
    
    public function researchs()
    {
        return $this->hasMany(Research::class);
    }
    
    protected $fillable = [
        'name', 'nameEn'
    ];
}
