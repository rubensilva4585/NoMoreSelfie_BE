<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'name',
        'email',
        'phone',
        'description',
        'state'
    ];
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}
