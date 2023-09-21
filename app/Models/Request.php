<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_supplier',
        'id_category',
        'id_subCategory',
        'date',
        'address',
        'description',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

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
}
