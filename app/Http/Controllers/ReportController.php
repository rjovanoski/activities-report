<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\ReportMail;
use Illuminate\Support\Facades\Mail;
use App\Activity;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'print');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {           
        $user = Report::where('token', $token)->pluck('user_id');
        
        $dateFrom = Report::where('token', $token)->pluck('date_from');           
        $dateTo = Report::where('token', $token)->pluck('date_to');            
            
        $activities = Activity::where('user_id', $user)
        ->where('created_at', '>=', $dateFrom)
        ->where('created_at', '<=', $dateTo)
        ->orderBy('created_at')
        ->paginate(5);
            
        return view('profile.report.index', compact('activities', 'token'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();

        $activities = Activity::where('user_id', $userId)->orderBy('created_at')->paginate(5);

        return view('profile.report.create', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $email = request()->validate([
            'email' => 'required|email',
        ]); 
        
        $dateFrom =  request()->date_from;
        $dateTo = request()->date_to;  

        if ( $dateFrom && $dateTo ) {

            if ($dateFrom <= $dateTo) {

                $activities = Activity::where('user_id', $userId)
                ->whereDate('created_at', '>=', $dateFrom)
                ->whereDate('created_at', '<=', $dateTo)
                ->orderBy('created_at')
                ->pluck('created_at');
                
                if ($activities->count() == 0) {

                    return redirect()->back()->with('error', 'No activities for selected date')->withInput();
                
                }else {           
                    
                    $token = Str::random(40);
                    
                    $activityFirst = $activities->first();
                    
                    $activityLast = $activities->last();
                    
                    $startDate = Carbon::parse($activityFirst)->toDateTimeString();
                    
                    $endDate = Carbon::parse($activityLast)->toDateTimeString();
                   
                    Report::create([
                        'user_id' => $userId,
                        'token' => $token,
                        'date_from' => $startDate,
                        'date_to' => $endDate
                    ]);                   
                    
                    Mail::to($email)->send(new ReportMail($token));
            
                    return redirect()->back()->with('message', 'Report Sent');
                }                              
                
            }else {

                return redirect()->back()->with('error', 'Wrong Date')->withInput();
            }           

        }else {

            return redirect()->back()->with('error', 'No Date Selected')->withInput();
        }
        
    }

    public function print($token)
    {
        $user = Report::where('token', $token)->pluck('user_id');          
                
        $dateStart =  request()->date_from;
        $dateEnd = request()->date_to;  

        if ( $dateStart && $dateEnd ) {

            if ($dateStart <= $dateEnd) {
                
                $activities = Activity::where('user_id', $user)
                    ->whereDate('created_at', '>=', $dateStart)
                    ->whereDate('created_at', '<=', $dateEnd)
                    ->orderBy('created_at')
                    ->get();

                if ($activities->count() == 0) {

                    return redirect()->back()->with('error', 'No activities for selected date')->withInput();
                
                }else { 

                    $pdf = PDF::loadView('profile.report.print', compact('activities', 'token'));
                    return $pdf->download('invoice.pdf');
                }

            }else {

                return redirect()->back()->with('error', 'Wrong Date')->withInput();
            } 

        }else {

            return redirect()->back()->with('error', 'No Date Selected')->withInput();
        }        
    }
}
