<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objs = Project::where('managed', Auth::user()->id)
            ->where('to_date', '>=', Carbon::now())
            ->where('from_date', '<=', Carbon::now())
            ->get();
        // dd(Auth::user()->id);
        return response()->json([
            'projects' => $objs,
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

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'number_worker' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|after:from_date',
            'time_checkin' => 'required',
            'time_checkout' => 'required|after:time_checkin'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }

        $project = Project::find($id);
        $project->project_name = $request->project_name;
        $project->number_worker = $request->number_worker;
        $project->from_date = $request->from_date;
        $project->to_date = $request->to_date;
        $project->time_checkin = $request->time_checkin;
        $project->time_checkout = $request->time_checkout;

        // $obj->location
        $project->location->update([
            'location_name' => $request->location_name,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'place_id' => $request->place_id,
        ]);

        $project->users()->attach($request->user_id);
        $project->save();

        return response()->json([
            'project' => $project,
        ], 200);
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
