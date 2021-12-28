<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'key', 'name', 'group_id'
    ];
    protected $filterable = [
        'key',
        'name',
        'group_id'
    ];

    public function researchs()
    {
        return $this->belongsToMany(Research::class, 'examiner_research')
            ->withPivot(['point', 'comment']);
    }
}
