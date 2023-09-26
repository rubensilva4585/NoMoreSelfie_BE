<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Social extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'website',
        'facebook',
        'instagram',
        'linkedin',
    ];

    public function user()
    {
        return $this->belongsTo(Profile::class, 'user_id');
    }
}
