<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Category;
use App\Models\Article;

class WebArticleController extends Controller
{
    public function index(Request $request)
    {
        //$categories = Category::all();
        $articles = Article::paginate();

        return view('website.articles', compact('articles'));
    }

    public function show(string $id)
    {
        
        $article = Article::findorfail($id);
        $articles = Article::where('category_id',$article->category_id)->where('id',"!=",$article->id)->get();
        return view('website.article-details', compact('article','articles')); 
    }
    public function articleToggleFav(string $id)
    {
       if(Auth::guard('api-web')->check()){
        Auth::guard('api-web')->user()->articles()->toggle($id);
         
        return back();
       }
       return back()->with('error','you shoud login first So that you can favour articles');
    }

    public function listFavourites(Request $request)
    {
        $fav_articles =Client::with('articles.category')->get();
        //$a = auth('api-web')->user()->articles()->paginate();

        return view('website.fav_articles_list', compact('fav_articles'));
    }
}
