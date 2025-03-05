<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'name',
        'dob',
        'gender',
        'address',
        'status',
        'department',
        'email',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
