<?php

namespace App\Http\Controllers\AdminDashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;




class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
    {
        $governorates=Governorate::all();
        $cities = City::with('governorate')->where(function ($query) use ($request) {
            if ($request->governorate_id) {
                $query->where('governorate_id', $request->governorate_id);
                    
            }
            if ($request->search) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            }
        })->paginate(); 
    
        return view('cities.view_cities', compact('cities','governorates')); 
    }

    /**
     * Show the form for creating a new resource. 
     */
    public function create()
    {
        $governorates=Governorate::all();
        return view('cities.add_cities',compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'unique:' . City::class],
            'governorate_id' => ['required', 'exists:governorates,id']
        ]);
        City::create([
            'name' => $request->name,
            'governorate_id' => $request->governorate_id,

        ]);

        //flash()->success("successfly added");
        return back()->with('success', 'successfly added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $governorates=Governorate::all();
        $city = City::findorfail($id);
        return view('cities.edit_city', compact('city','governorates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([ 
            'name' => ['required', 'string', 'unique:cities,name,' . $id],
            'governorate_id' => ['required', 'exists:governorates,id']

        ]);
        $city = City::findorfail($id);
        $city->update($request->all());
        return back()->with('success', 'successfly updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findorfail($id);
        $city->delete();
        return back()->with('success', 'successfly deleted');
    }
}
