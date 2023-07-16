<?php

namespace App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\Controller;
use App\Models\Setting;

use Illuminate\Http\Request;

class SettingController extends Controller
{

    function __construct()
    {
      
        $this->middleware('permission:settings-edit', ['only' => ['edit', 'update']]);
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit()
    { $settings=Setting::first();
        return view('settings.edit_settings',compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'notification_settings_text' => ['required', 'string'],
            'about_app' => ['required', 'string'],
            'phone' => ['required'],
            'email' => ['required', 'string','email'],
            'fb_link' => ['required', 'string'],
            'tw_link' => ['required', 'string'],
            'insta_link' => ['required', 'string'],
            'youtube_link' => ['required', 'string'],
        ]);
        
        $settings = Setting::first();
        $settings->update($request->all());
        return back()->with('success', 'successfly updated');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
