<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';


    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}
