<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Research extends Model
{
    use HasFactory, Filterable, SoftDeletes;

    protected $fillable = [
        'name', 'nameEn', 'field_id', 'province_id', 'user_id', 'medal_id', 'teacher', 'student_1', 'student_2', 'school_1', 'school_2', 'level', 'type', 'p1', 'p2', 'point','key'
    ];

    protected $filterable = [
        'name', 'nameEn', 'field_id', 'province_id', 'competition_id', 'medal_id', 'group_id', 'level', 'type', 'status', 'user_id', 'key'
    ];

    public $table = "researchs";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
    public function file()
    {
        return $this->hasMany(File::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class, 'school_1', 'key');
    }
    public function school2()
    {
        return $this->belongsTo(School::class, 'school_2', 'key');
    }

    public function examiners()
    {
        return $this->belongsToMany(Examiner::class, 'examiner_research')
            ->withPivot(['point', 'comment']);
    }
    public function medal()
    {
        return $this->belongsTo(Medal::class);
    }
}
