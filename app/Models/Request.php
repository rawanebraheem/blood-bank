<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model 
{

    protected $table = 'requests';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('client_id');
    protected $fillable = array('patient_name', 'patient_phone', 'city_id', 'hospital_name', 'blood_type_id', 'patient_age', 'bags_num', 'hospital_address', 'latitude', 'longitude','details');

    public function city()
    {
        return $this->belongsTo('City', 'city_id');
    }

    public function bloodType()
    {
        return $this->belongsTo('BloodType', 'blood_type_id');
    }

    public function client()
    {
        return $this->hasOne('Client', 'client_id');
    }

    public function notifications()
    {
        return $this->hasMany('Notification', 'request_id');
    }

}