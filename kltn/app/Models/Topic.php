<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'department',
        'number_student',
        'required',
        'note',
        'instructor_id',
        'subinstructor_id',
        'status'
    ];

    protected $filterable = [
        'name',
        'department',
        'required',
        'note'
    ];

    protected $hidden = [
        'instructor_id',
        'subinstructor_id'
    ];

    public $table = "topics";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
