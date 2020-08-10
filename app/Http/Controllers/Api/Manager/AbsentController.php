<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $absents = AbsentApplication::whereIn('user_id',
                User::whereIn('id',
                ProjectUser::whereIn('project_id',
                Project::where('managed',
                Auth::user()->id)->get()->pluck('id'))
                    ->get()->pluck('user_id'))
                    ->get()->pluck('id'))
                ->where('state', AbsentApplication::getAbsentWaitting())->get();


        return response()->json([
            'absents' => $absents,
        ], 200);
    }

    public function approve(Request $request, $id) {
        // dd($request);
        if (!isset($request->user_id)) {
            return response()->json([
                'message' => 'do not have user id',
            ]);
        }
        else {
            $user = User::find($request->user_id);
            dispatch(new ProcessReportMail(Auth::user(), $user, "absent-allow"));
            $absent = AbsentApplication::find($id);
            $absent->state = AbsentApplication::getAbsentAllow();
            $absent->save();
        }

        return response()->json([
            'message' => 'approved',
        ]);
    }



    public function reject(Request $request, $id) {
        if (!isset($request->user_id)) {
            return response()->json([
                'message' => 'do not have user id',
            ]);        }
        else {
            $user = User::find($request->user_id);
            dispatch(new ProcessReportMail(Auth::user(), $user, "absent-reject", $request->content));
            $absent = AbsentApplication::find($id);
            $absent->state = AbsentApplication::getAbsentDraw();
            $absent->save();
        }

        return response()->json([
            'message' => 'rejected',
        ]);    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'date_off' => 'required',
            'number_off' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }

        $absent = new AbsentApplication();
        $absent->content = $request->content;
        $absent->date_off = $request->date_off;
        $absent->number_off = $request->number_off;
        $absent->user_id = Auth::user()->id;
        $absent->state = AbsentApplication::getAbsentWaitting();

        $absent->save();
        return response()->json($absent, 200);
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
