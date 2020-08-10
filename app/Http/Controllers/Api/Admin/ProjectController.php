<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Project;
use App\Location;
use App\User;
use App\ProjectUser;

use \App\Http\Resources\Project\ProjectResource;
use \App\Http\Resources\Project\ProjectCollection;

use \App\Http\Resources\User\UserResource;
use \App\Http\Resources\User\UserCollection;

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
        return new ProjectCollection(Project::all());
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

        $project = new Project();
        $project->project_name = $request->project_name;
        $project->number_worker = $request->number_worker;
        $project->from_date = $request->from_date;
        $project->to_date = $request->to_date;
        $project->time_checkin = $request->time_checkin;
        $project->time_checkout = $request->time_checkout;

        //create location
        $location = new Location();
        $location->location_name = $request->location_name;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->place_id = $request->place_id;
        $location->save();

        // var_dump($location);
        $project->location_id = $location->id;
        $project->users()->attach($request->user_id);
        $project->save();

        return response()->json($project);
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
        return new ProjectResource(Project::find($id));
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
        $project->location->update([
            'location_name' => $request->location_name,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'place_id' => $request->place_id,
        ]);
        $project->users()->attach($request->user_id);
        $project->save();


        return response()->json($project);
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
        Project::find($id)->delete();

        return 204;
    }


    public function assign($id) {
        $project = Project::find($id) ;
        $managers = User::where('role', 'manager')->get();

        // $managers = new UserCollection($managers);

        $workers = User::with('projects')
            ->where('role', 'worker')
            ->whereNotIn('id', ProjectUser::select('user_id')
                ->where('project_id', $id)
                ->get()
                ->pluck('user_id'))
            ->get();
        // $workers = new UserCollection($workers);

        $admin = User::where('role', 'admin')->first();
        // $admin = new UserResource($admin);
        // dd(ProjectUser::select('user_id')->where('project_id', $id)->get()->pluck('user_id'));
        return response()->json([
            'project' => $project,
            'workers' => $workers,
            'managers' => $managers,
            'admin' => $admin,
        ]);
    }

    public function assigned($id) {
        $project = new ProjectResource( Project::find($id)) ;
        return new ProjectResource($project);
    }

    public function assignPost(Request $request, $id) {

        // dd($req->input());
        $project = Project::find($id);
        $project->managed = $request->manager;
        foreach ($request->workers as $worker) {
            $obj->users()->attach($worker);
        }


        $project->save();
        // dd($obj);
        // dd($user);
        return response()->json($project);
    }

    public function deleteAssigned(Request $request, $id) {
        // $project_id = $request->project_id;
        $user_id = $request->user_id;
        ProjectUser::where('user_id', $user_id)
            ->where('project_id', $id)
            ->get()
            ->first()
            ->delete();
        return 204;
    }


}
