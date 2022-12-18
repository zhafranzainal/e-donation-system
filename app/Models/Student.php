<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'staff_id',
        'course_id',
        'bank_id',
        'matric_no',
        'year',
        'sem',
        'account_no',
    ];

    protected $searchableFields = ['*'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
