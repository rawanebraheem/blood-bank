<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;
 use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable 
{
     use HasApiTokens;//, HasFactory, Notifiable;


    protected $table = 'clients';
    public $timestamps = true;
    protected $guarded = array('pin_code');
    protected $fillable = array('name', 'phone', 'email', 'password', 'd_o_b', 'blood_type_id', 'last_donation_date', 'city_id');

    public function bloodType()
    {
        return $this->belongsTo('BloodType', 'blood_type_id');
    }

    public function city()
    {
        return $this->belongsTo('City', 'city_id');
    }

    public function requests()
    {
        return $this->hasMany('Request', 'client_id');
    }

    public function governorates()
    {
        return $this->belongsToMany('Governorate');
    }

    public function bloodTypes()
    { 
        return $this->belongsToMany('BloodType');
    }

    public function notifications() 
    {
        return $this->belongsToMany('Notification');
    }

    public function articles()
    { 
        return $this->belongsToMany('Article');
    }

    public function contacts()
    {
        return $this->hasMany('Contact');
    }

    protected $hidden = [
        'password',
       
        
    ];

}