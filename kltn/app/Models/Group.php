<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $fillable = [
        'key', 'name', 'user_id'
    ];
    protected $filterable = [
        'key',
        'name',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function fields()
    {
        return $this->belongsToMany(Field::class, 'group_field');
    }
}