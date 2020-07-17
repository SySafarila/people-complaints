<?php

namespace App\Http\Controllers;

use App\Complaint;
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
        $pending = Complaint::where('status', 'pending')->count();
        $onProcess = Complaint::where('status', 'on process')->count();
        $complete = Complaint::where('status', 'complete')->count();
        return view('dashboard', [
            'pending' => $pending,
            'onProcess' => $onProcess,
            'complete' => $complete
        ]);
    }
}
