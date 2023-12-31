<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function profile()
    {
        return $this->hasMany(Profile::class, 'district_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
