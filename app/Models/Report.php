<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'totalAmount',
        'totalDonation',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
