<?php

namespace App\Http\Controllers;

use Auth;
use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.activity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        request()->validate([
            'name' => 'required|string|min:3',
            'date' => 'required|date',
            'time' => 'required|integer',
            'description' => 'required|string|min:20',            
        ]);
        
        $userId = Auth::id();

        Activity::create([
            'user_id' => $userId,
            'name' => request()->name,
            'date' => request()->date,
            'time' => request()->time,
            'description' => request()->description
        ]);

        return redirect(route('home'))->with('message', 'Activity Created Successfully');
    }
}
