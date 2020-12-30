<?php

namespace App\Http\Controllers;

use Auth;
use App\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $activities = Activity::where('user_id', $userId)->orderBy('created_at')->paginate(5);

        return view('profile.home', compact('activities'));
    }
}
