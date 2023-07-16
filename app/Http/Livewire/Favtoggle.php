<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;



class Favtoggle extends Component

{
    public $articles;

    public function mount()
    {

        $this->articles = Article::all();
    }
    public function render()
    {

        return view('livewire.favtoggle');
    }

    public function articleToggleFav(string $id)
    {
        if (Auth::guard('api-web')->check()) {
       return  Auth::guard('api-web')->user()->articles()->toggle($id);
        }
       
        session()->flash('error','you shoud login first So that you can favour articles');
         return redirect()->to('web/articles');
    }
}
