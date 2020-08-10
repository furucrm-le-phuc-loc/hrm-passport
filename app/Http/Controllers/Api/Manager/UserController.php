<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        // dd(Auth::user()->manage()->get()->pluck('id'));
        if(!isset($request->project_id)) {
            $users = User::whereIn('id',
                ProjectUser::whereIn('project_id',
                Auth::user()->manage()->get()->pluck('id'))
                ->get()->pluck('user_id'))->get();
        }
        else {

            $users = User::whereIn('id', ProjectUser::select('user_id')
                ->where('project_id', $request->project_id)
                ->get()
                ->pluck('user_id'))->get();

            // dd($users);
        }


        $projects = Project::where('managed', Auth::user()->id)->get();
        return response()->json([
            'users' => $users,
            'projects' => $projects,
        ]);
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
