<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medal extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name', 'status'
    ];
    protected $filterable = [
        'name'
    ];
    public function researchs()
    {
        return $this->hasMany(Research::class);
    }
}
