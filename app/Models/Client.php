<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'phone',
    ];

    public function requests()
    {
        return $this->hasMany(Requests::class, 'id_client');
    }
}
