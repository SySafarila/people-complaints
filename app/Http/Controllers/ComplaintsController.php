<?php

namespace App\Http\Controllers;

use App\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ComplaintsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::user()->id)->paginate(10);
        return $complaints;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $complaints = Complaint::where('user_id', Auth::user()->id)->paginate(5);
        return view('complaints.create', ['complaints' => $complaints]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->level == 'public') {
            $request->validate([
                'report' => 'required|min:10|string',
                'photo' => 'required|image|file|max:5000'
            ], [
                'photo.max' => 'Maximum size for Cover Image is 5MB.'
            ]);

            $photo = Str::random(10) . '.' . $request->photo->extension();
            Complaint::create([
                'report' => $request->report,
                'photo' => $photo,
                'user_id' => $request->user()->id,
                'status' => 'pending'
            ]);

            $request->file('photo')->storeAs('photos', $photo);

            return redirect()->route('complaints.create')->with('status-success', 'Your complaint sent !');
        } else {
            return abort(404);
        }
    }

    public function addResponse(Request $request, Complaint $complaint)
    {
        $complaint->responses()->create([
            'user_id' => $request->user()->id,
            'response' => $request->response
        ]);

        return redirect()->route('complaints.show', $complaint->id)->with('status-success', 'Response added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        if (Auth::user()->id == $complaint->user->id or Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            return view('complaints.show', ['complaint' => $complaint]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        if (Auth::user()->id == $complaint->user->id or Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            return view('complaints.edit', ['complaint' => $complaint]);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        if (Auth::user()->id == $complaint->user->id or Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            $complaint->update([
                'report' => $request->report
            ]);

            return redirect()->route('complaints.show', $complaint->id)->with('status-success', 'Your complaint was edited !');
        } else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}
