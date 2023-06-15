<?php

namespace App\Http\Controllers\AdminDashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article; 


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories=Category::all();
        $articles = Article::with('Category')->where(function ($query) use ($request) {
            if ($request->category_id) {
                $query->where('category_id', $request->category_id);
                    
            }
            if ($request->search) {
                $query->where('title', 'LIKE', '%' . $request->search . '%');
            }
        })->paginate(); 

        return view('articles.view_articles', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        $categories=Category::all();
        return view('articles.add_articles', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'image' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category_id' =>['required', 'exists:categories,id'],

        ]);
        Article::create([
            'title' => $request->title,
            'image' => $request->image,
            'content' => $request->content,
            'category_id' => $request->category_id,

        ]);
        //flash()->success("successfly added");
        return back()->with('success', 'successfly added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::with('category')
        ->findorfail($id);
        return view('articles.view_article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=Category::all();
        $article = Article::findorfail($id);
        return view('articles.edit_article', compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'image' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category_id' =>['required', 'exists:categories,id'], 
        ]);
        $article = Article::findorfail($id);
        $article->update($request->all());
        return back()->with('success', 'successfly updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findorfail($id);
        $article->delete();
        return back()->with('success', 'successfly deleted');
    }
}
