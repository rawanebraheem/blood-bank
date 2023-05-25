<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content');

    public function request()
    {
        return $this->belongsTo('Request', 'request_id');
    }

    public function clients()
    {
        return $this->belongsToMany('Client');
    }

}