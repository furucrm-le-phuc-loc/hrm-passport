<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        // Report::whereIn('project_user_id', ProjectUser::whereIn('project_id',
        // User::find(Auth::user()->id)
        //     ->projects()
        //     ->get()
        //     ->pluck('id'))
        //     ->get()->pluck('id'))
        //     ->get();
        // dd(Report::whereIn('project_user_id', ProjectUser::whereIn('project_id',
        // User::find(Auth::user()->id)
        //     ->projects()
        //     ->get()
        //     ->pluck('id'))
        //     ->get()->pluck('id'))
        //     ->get());
        // dd(Report::whereIn('id', User::find(Auth::user()->id)
        //     ));
        if(isset($request->project_id)) {
            $reports = Project::find($request->project_id)
                ->reports()
                ->get();
        }
        else if (isset($request->user_id)) {
            $reports = User::find($request->user_id)
                ->reports()
                ->get();
        }
        else {
            $reports =  Report::whereIn('project_user_id',
            ProjectUser::whereIn('project_id',
            User::find(Auth::user()->id)
                ->manage()
                ->get()
                ->pluck('id'))
                ->get()->pluck('id'))
                ->where('state', Report::getReportWaitting())
                ->get();
            // dd(Project::find($request->project_id)->reports()->get());

            // dd($reports->first()->project_user->user);
        }


        $projects = Project::where('managed', Auth::user()->id)->get();
        return response()->json([
            'reports' => $reports,
            'projects' => $projects,
        ], 200);
        // return view("role/manager/report/index");
    }

    public function approve(Request $request, $id) {
        if (!isset($request->user_id)) {
            return response()->json([
                'message' => 'do not have user id',
            ]);
        }
        else {
            $user = User::find($request->user_id);
            dispatch(new ProcessReportMail(Auth::user(), $user, "report-allow"));
            $report = Report::find($id);
            $report->state = Report::getReportAllow();
            $report->save();
        }

        return response()->json([
            'message' => 'approved',
        ]);
    }

    public function reject(Request $request, $id) {
        if (!isset($request->user_id)) {
            return response()->json([
                'message' => 'do not have user id',
            ]);
        }
        else {
            $user = User::find($request->user_id);
            dispatch(new ProcessReportMail(Auth::user(), $user, "report-reject", $request->content));
            $report = Report::find($id);
            $report->state = Report::getReportDraw();
            $report->save();
        }

        return response()->json([
            'message' => 'rejected',
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
        $report = Report::find($id);

        return response()->json([
            'report' => $report,
        ], 200);
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
