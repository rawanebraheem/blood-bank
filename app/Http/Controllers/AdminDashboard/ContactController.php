<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:contact-list', ['only' => ['index']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }
    /** 
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $contacts = Contact::with('client')->where(function ($query) use ($request) {
            if ($request->search) {
                $query->where('phone', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas("client", function ($query) use ($request) {
                        $query->where('phone', 'LIKE', '%' . $request->search . '%');
                    });
            }
        })->paginate();
        return view('contacts.view_contacts', compact('contacts'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findorfail($id);
        $contact->delete();
        return back()->with('success', 'successfly deleted');
    }
}
