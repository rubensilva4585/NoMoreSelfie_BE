<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'id_district');
    }
}
