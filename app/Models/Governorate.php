<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model 
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany(City::class, 'governorate_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

}