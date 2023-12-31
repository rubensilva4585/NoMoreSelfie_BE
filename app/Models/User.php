<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dob',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function social()
    {
        return $this->hasOne(Social::class);
    }

    public function userSubCategory()
    {
        return $this->hasMany(UserSubCategory::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class);
    }

    public function request()
    {
        return $this->hasMany(Requests::class, 'request_id');
    }

    public function favoriteSuppliers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'client_id', 'supplier_id')->withTimestamps();
    }

    public function favoriteClients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'supplier_id', 'client_id')->withTimestamps();
    }
}
