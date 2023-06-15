<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Article extends Model
{

    protected $table = 'articles';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('title', 'image', 'content', 'category_id');
    protected $appends = ['is_favourite'];

    public function getIsFavouriteAttribute()
    {//2 conditions
        $client = auth('sanctum')->user();
        if(!$client){
            $client = auth('api-web')->user();
        }
        if($client){
            $clint_fav_articles = $client->articles()->find($this->id);
            if($clint_fav_articles){
                return true;
            } 
        }
        
        return false;
        
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
