<?php

namespace App\Http\Controllers;

use App\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        if (Auth::user()->level == 'public') {
            $complaints = Complaint::where(['user_id' => Auth::user()->id, 'status' => 'pending'])->paginate(10);
            return view('complaints.index', ['complaints' => $complaints]);
        }

        if (Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            $complaints = Complaint::where('status', 'pending')->paginate(10);
            return view('complaints.advanced.indexPending', ['complaints' => $complaints]);
        }
    }

    public function onProcess()
    {
        if (Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            $complaints = Complaint::where('status', 'on process')->paginate(10);
            return view('complaints.advanced.indexOnProcess', ['complaints' => $complaints]);
        } else {
            $complaints = Complaint::where(['status' => 'on process', 'user_id' => Auth::user()->id])->paginate(10);
            return view('complaints.advanced.indexOnProcess', ['complaints' => $complaints]);
        }
    }

    public function complete()
    {
        if (Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            $complaints = Complaint::where('status', 'complete')->paginate(10);
            return view('complaints.advanced.indexComplete', ['complaints' => $complaints]);
        } else {
            $complaints = Complaint::where(['status' => 'complete', 'user_id' => Auth::user()->id])->paginate(10);
            return view('complaints.advanced.indexComplete', ['complaints' => $complaints]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level == 'public') {
            $complaints = Complaint::where('user_id', Auth::user()->id)->latest()->paginate(5);
            return view('complaints.create', ['complaints' => $complaints]);
        } else {
            return abort(404);
        }
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
        if (Auth::user()->id == $complaint->user->id or Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            $request->validate([
                'response' => 'required'
            ]);
            // $complaint = Complaint::find($id);
            $response = $complaint->responses()->create([
                'response' => $request->response,
                'user_id' => $request->user()->id
            ]);

            return redirect()->route('complaints.show', $complaint->id)->with('status-success', 'Response added !');
        } else {
            return abort(404);
        }
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

    public function setStatus(Request $request, Complaint $complaint)
    {
        if (Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            $request->validate([
                'status' => 'required|in:pending,on process,complete'
            ]);
            $complaint->update([
                'status' => $request->status
            ]);
            return redirect()->route('complaints.show', $complaint->id)->with('status-success', 'Complaint was updated !');
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
        if (Auth::user()->id == $complaint->user->id or Auth::user()->level == 'admin' or Auth::user()->level == 'officer') {
            if (Storage::disk('local')->exists('photos/' . $complaint->photo) == true) {
                Storage::disk('local')->delete('photos/' . $complaint->photo);
            }
            $complaint->delete();

            return redirect()->route('complaints.index')->with('status-success', 'Your complaint was deleted !');
        } else {
            return abort(404);
        }
    }
}
