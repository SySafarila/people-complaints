<?php

namespace App\Http\Controllers;

use App\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            $pending = Complaint::where('status', 'pending')->count();
            $onProcess = Complaint::where('status', 'on process')->count();
            $complete = Complaint::where('status', 'complete')->count();
        }
        if (Auth::user()->level == 'public') {
            $pending = Complaint::where(['status' => 'pending', 'user_id' => Auth::user()->id])->count();
            $onProcess = Complaint::where(['status' => 'on process', 'user_id' => Auth::user()->id])->count();
            $complete = Complaint::where(['status' => 'complete', 'user_id' => Auth::user()->id])->count();
        }
        return view('dashboard', [
            'pending' => $pending,
            'onProcess' => $onProcess,
            'complete' => $complete
        ]);
    }
}
