<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_district',
        'phone',
        'company',
        'nif',
        'address',
        'bio',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'id_district');
    }

    public function social()
    {
        return $this->hasOne(Social::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function supplier_Category_SubCategory()
    {
        return $this->hasMany(Supplier_Category_SubCategory::class);
    }
}
