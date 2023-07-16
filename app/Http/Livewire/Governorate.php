<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\Governorate as CountryGovernorate;


class Governorate extends Component
{
    public $governorates;
    public $cities;
    public $governorate1;
  
    // public $governorate_cities = null;

    public function mount()
    {
        $this->governorates = CountryGovernorate::all();
        $this->cities = City::all();
    }
    public function render()
    {
       
        return view('livewire.governorate');
    }

    public function updatedGovernorate1()
    {

        $this->cities = City::where('governorate_id', $this->governorate1)->get();
        //dd($this->cities);
    }
}
