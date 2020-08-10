<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use \App\AbsentApplication;
use \App\User;
use \App\Project;
use \App\ProjectUser;
use Auth;


use Mail;
use \App\Jobs\ProcessReportMail;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $absents = AbsentApplication::all();
        return response()->json($absents);
    }

    public function approve(Request $request, $id) {
        // dd($request);
        if (!isset($request->user_id)) {
            return response()->json(['message' => 'do not have user id']);
        }
        else {
            $user = User::find($request->user_id);
            dispatch(new ProcessReportMail(Auth::user(), $user, "absent-allow"));
            $absent = AbsentApplication::find($id);
            $absent->state = AbsentApplication::getAbsentAllow();
            $absent->save();
        }

        return response()->json(['message' => 'approved']);
    }



    public function reject(Request $request, $id) {
        if (!isset($request->user_id)) {
            return redirect()->json(['message' => 'do not have user id']);
        }
        else {
            $user = User::find($request->user_id);
            dispatch(new ProcessReportMail(Auth::user(), $user, "absent-reject", $request->content));
            $absent = AbsentApplication::find($id);
            $absent->state = AbsentApplication::getAbsentDraw();
            $absent->save();
        }

        return response()->json(['message' => 'rejected']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
