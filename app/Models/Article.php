<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model 
{

    protected $table = 'articles';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('title', 'image', 'content', 'category_id');

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

}