<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;



class Favtoggleindex extends Component
{

    public $articles;

    public function mount()
    {

        $this->articles = Article::latest()->take(4)->get();
    }
    public function render()
    {
        return view('livewire.favtoggleindex');
    }
    public function articleToggleFav(string $id)
    {
        if (Auth::guard('api-web')->check()) {
            return  Auth::guard('api-web')->user()->articles()->toggle($id);
        }

        session()->flash('error', 'you shoud login first So that you can favour articles');
        return redirect()->to('web/home');
    }
}
