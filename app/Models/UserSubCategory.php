<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = ['user_id', 'subcategory_id'];

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'subcategory_id',
        'startPrice',
        'endPrice',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function userSubCategory()
    {
        return $this->hasMany(UserSubCategory::class);
    }
}
