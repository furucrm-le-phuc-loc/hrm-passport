<?php

namespace App\Http\Controllers\Api\Worker;

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
    public function index()
    {
        //
        $reports = User::find(Auth::user()->id)->reports()->get();
        $user = User::with(['reports', 'projects'])->find(Auth::user()->id);
        // dd($user);
        return respone()->json([
            'user' => $user,
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
        // dd($request->input());
        //check report is already exist
        // dd(User::find(Auth::user()->id)->reports()->whereDate('reports.created_at', "=", Carbon::now())->get());
        if (count(User::find(Auth::user()->id)
            ->reports()
            ->whereDate('reports.created_at', "=", Carbon::now())
            ->get()
            ) <= 0) {
            if(isset($request->project_id)) {
                $report = new Report();
                $report->project_user_id = ProjectUser::where('user_id', Auth::user()->id)
                    ->where('project_id', $request->project_id)->first()->id;
                $report->state = Report::getReportCreated();
                $report->save();
            }
        }


        return response()->json($report, 200);
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
        ]);
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
    public function sendOrDraw(Request $request, $id)
    {
        switch ($request->input('action')) {
            case 'send':
                $report = Report::find($id);
                $report->content = $request->content;
                $report->state = Report::getReportDraw();
                $report->save();
                return response()->json([
                    'message' => 'send successfull!!!',
                ]);
            break;

            case 'draw':
                $report = Report::find($id);
                $report->content = $request->content;
                $report->state = Report::getReportWaitting();
                $report->save();
                return response()->json([
                    'message' => 'save but not send!!!',
                ]);
            break;
        }

        return respone()->json([
            'message' => 'something wrong!!!',
        ]);

    }

    public function checkin(Request $request, $id) {
        // dd(Carbon::now()->format('H:i'));
        $report = Report::find($id);

        $report->time_checkin = Carbon::now()->format('H:i');
        $location_name = $request->lat."+".$request->lng;
        $location = Location::create([
            'location_name' => $location_name,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        $report->location_check_in = $location->id;
        $report->state = Report::getReportCheckin();

        $report->save();
        return response()->json(['success'=>'Checkin successful!!']);
    }

    public function checkout(Request $request, $id) {
        // dd(Carbon::now()->format('H:i'));
        $report = Report::find($id);

        $report->time_checkout = Carbon::now()->format('H:i');
        $location_name = $request->lat."+".$request->lng;
        $location = Location::create([
            'location_name' => $location_name,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        $report->location_check_out = $location->id;
        $report->state = Report::getReportDraw();

        $report->save();
        return response()->json(['success'=>'Checkout successful!!']);
    }
}
