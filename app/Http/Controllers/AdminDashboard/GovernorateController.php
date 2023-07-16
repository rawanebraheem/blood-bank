<?php

namespace App\Http\Controllers\AdminDashboard;

use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Http\Controllers\Controller;




class GovernorateController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:governorate-list', ['only' => ['index']]);
        $this->middleware('permission:governorate-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:governorate-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:governorate-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governorates = Governorate::all();
        return view('governorates.view_governorates', compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {

        return view('governorates.add_governorates');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'unique:' . Governorate::class],
        ]);
        Governorate::create([
            'name' => $request->name,

        ]);

        //flash()->success("successfly added"); //laracasts/flash
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
        $governorate = Governorate::findorfail($id);
        return view('governorates.edit_governorate', compact('governorate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:' . Governorate::class],
        ]);
        $governorate = Governorate::findorfail($id);
        $governorate->update($request->all());
        return back()->with('success', 'successfly updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        $governorate = Governorate::findorfail($id);
        if($governorate->cities()->count())
        {
            return back()->with('error', 'can not be deleted');
        }
       $governorate->delete();
        return back()->with('success', 'successfly deleted');
    }
}
