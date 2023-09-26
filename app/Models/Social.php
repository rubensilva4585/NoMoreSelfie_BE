<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Social extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id_profile';

    protected $fillable = [
        'id_profile',
        'website',
        'facebook',
        'instagram',
        'linkedin',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id_profile');
    }
}
