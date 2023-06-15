<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Request as DonationRequest;


use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $donation_requests = DonationRequest::where(function ($query) use ($request) {
            if ($request->search) {
                $query->where('patient_phone', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas('client', function ($query) use ($request) {
                        $query->where('phone', 'LIKE', '%' . $request->search . '%');
                    });
            }
        })->paginate();
        return view('donation_requests.view_donation_requests', compact('donation_requests'));
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
        // n + 1
        // $request->client->name
        // eager loading
        $donation_request = DonationRequest::with('client','city.governorate','bloodType')
        ->findorfail($id);
        return view('donation_requests.view_donation_request', compact('donation_request'));
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
        $donation_request = DonationRequest::findorfail($id);
        $donation_request->delete();
        return back()->with('success', 'successfly deleted');
    }
}
