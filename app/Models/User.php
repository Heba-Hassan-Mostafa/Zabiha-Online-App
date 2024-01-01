<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'city_id',
        'code',
        'device_token',
        'image',
        'type'
    ];

    const USER = 0;
    const ADMIN = 1;
    const SUPER_ADMIN = 2;
    public function city()
    {
        return $this->belongsTo(City::class);

    }
    public function locations()
    {
        return $this->hasMany(Location::class);
        
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);

    }

    public function cart()
    {
        return $this->belongsToMany(Product::class,'carts')->withPivot('price','quantity','note');

    }
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);

    }

    public function cancel_reasons()
    {
        return $this->hasMany(CancelReason::class);
    }

    public function getFullNameAttribute(): string
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
    

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


    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}