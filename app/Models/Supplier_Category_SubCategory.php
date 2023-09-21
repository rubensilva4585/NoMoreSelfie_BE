<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_Category_SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_supplier',
        'id_category',
        'id_subCategory',
        'startPrice',
        'endPrice',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'id_subCategory');
    }

    public function supplier_Category_SubCategory()
    {
        return $this->hasMany(Supplier_Category_SubCategory::class);
    }
}
