<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;



class Favtoggleindex extends Component
{

    public $article;

    public function mount($articl)

    {

        $this->article = $articl;
    }
    public function render()
    {
        return view('livewire.favtoggleindex');
    }
    public function articleToggleFav(string $id)
    {
        if (Auth::guard('api-web')->check()) {

            Auth::guard('api-web')->user()->articles()->toggle($id);
        } else {
            session()->flash('error', 'you shoud login first So that you can favour articles');
          

            return redirect()->to('/web/home');
        }
    }
}
