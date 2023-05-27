<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BloodType extends Model 
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function requests()
    {
        return $this->hasMany(Request::class, 'blood_type_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'blood_type_id');
    }

    public function setting_clients()
    {
        return $this->belongsToMany(Client::class);
    }

}