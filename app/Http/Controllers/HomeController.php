<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function getPhoneCode($id)
    {
        $country = Country::where('id', $id)->first();
        return response()->json(['phone_code' => $country->phonecode]);
    }
}
