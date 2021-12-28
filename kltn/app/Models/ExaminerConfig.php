<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminerConfig extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status', 'key', 'round'
    ];
    public $table = "examiner_config";
}
