<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'inPerson'
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'id_subCategory');
    }

    public function supplier_Category_SubCategory()
    {
        return $this->hasMany(Supplier_Category_SubCategory::class);
    }
}
