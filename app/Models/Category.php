<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function social()
    {
        return $this->hasMany(SubCategory::class, 'id_subCategory');
    }
    
    public function supplier_Category_SubCategory()
    {
        return $this->hasMany(Supplier_Category_SubCategory::class);
    }
}