<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'customers';

    protected $primaryKey = 'dni';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    // public $incrementing = false;

    protected $fillable = ['dni', 'id_reg', 'id_com', 'email', 'name', 'last_name', 'address', 'date_reg', 'status'];

    public $timestamps = false;

    public function getJWTIdentifier()
    {
    	return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
    	return [];
    }


    public function commune()
    {
        return $this->belongsTo('App\Models\Commune', 'id_com');
    }
}
