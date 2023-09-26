<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role',
        'id_district',
        'date_of_birth',
        'phone',
        'company',
        'nif',
        'address',
        'bio',
    ];

    public function request()
    {
        return $this->hasMany(Requests::class, 'request_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function social()
    {
        return $this->hasOne(Social::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
