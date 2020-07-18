<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponsesController extends Controller
{
    public function edit(Complaint $complaint, Response $response)
    {
        if (Auth::user()->id == $response->user->id) {
            return view('responses.edit', ['response' => $response]);
        } else {
            return abort(404);
        }
    }

    public function update(Complaint $complaint, Response $response, Request $request)
    {
        if (Auth::user()->id == $response->user->id) {
            $response->update([
                'response' => $request->response
            ]);

            return redirect()->route('complaints.show', $complaint->id)->with('status-success', 'Response updated !');
        } else {
            return abort(404);
        }
    }
}
