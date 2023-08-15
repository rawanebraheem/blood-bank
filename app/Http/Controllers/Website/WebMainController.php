<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Article;
use App\Models\Request as DonationRequest;



use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class WebMainController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $don_requests = DonationRequest::with('client', 'city.governorate', 'bloodType')->latest()->take(4)->get();
        $articles = Article::paginate();
        return view('website.index', compact("settings", "don_requests","articles"));
    }
    public function createContact(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'numeric'],
            'title' => ['required','string', 'max:200'],
            'msg' => ['required'],

        ]);

        $contact = Contact::create([
            // 'client_id' =>  Auth::guard('api-web')->user()->id,
            'phone' => $request->phone,
            'title' => $request->title,
            'msg' => $request->msg,

        ]);
        if (Auth::guard('api-web')->check()) {
            $contact->client_id = Auth::guard('api-web')->user()->id;
            $contact->save();
        }


        return back()->with('success', 'تم ارسال الرسالة بنجاح');
    }
}
