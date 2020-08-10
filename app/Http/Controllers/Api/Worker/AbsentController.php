<?php

namespace App\Http\Controllers\Api\Worker;

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
        $absents = User::find(Auth::user()->id)->absentApplication()->get();
        // dd($absents);

        return response()->json([
            'absents' => $absents,
        ], 200);
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
        $obj = AbsentApplication::with(['user'])->find($id);
        return response()->json(['absent' => $obj], 200);
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
        // $validatedData = $request->validate( [
        //     'project_name' => 'required',
        //     'project_from_date' => 'date',
        //     'project_to_date' => 'date|after:project_from_date',
        //     'time_checkin' => 'date_format:H:i',
        //     'time_checkout' => 'date_format:H:i|after:time_checkin',
        // ]);

        $validator = Validator::make($request->all(), [
            'date_off' => 'required',
            'number_off' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }

        $absent = AbsentApplication::find($id);
        $absent->content = $request->content;
        $absent->date_off = $request->date_off;
        $absent->number_off = $request->number_off;
        $absent->user_id = Auth::user()->id;
        $absent->state = AbsentApplication::getAbsentWaitting();
        $absent->save();

        return response()->json($absent, 200);
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
        AbsentApplication::find($id)->delete();

        return 204;
    }
}
