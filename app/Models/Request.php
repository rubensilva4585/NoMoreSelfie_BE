<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_profile',
        'id_category',
        'id_subCategory',
        'date',
        'address',
        'description',
    ];

    public function profile()
    {
        return $this->belongsTo(Client::class, 'id_profile');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'id_subCategory');
    }
}
