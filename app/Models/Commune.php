<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = 'communes';

    protected $primaryKey = 'id_com';

    // protected $primaryKey = ['id_com', 'id_reg'];
    
    // public $incrementing = false;

    protected $fillable = ['id_reg', 'description', 'status'];

    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'id_reg');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer', 'id_com');
    }
}
