<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Application;
use App\Models\Donation;
use App\Models\Student;
use App\Models\Staff;
use App\Models\User;
use App\Models\Role;

use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Permission;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->authorize('view-any', Report::class);
        //return view('report.admin-report');
        $search = $request->get('search', '');
        $reports = Report::where('user_id', 'like', "%{$search}%")->paginate(10);
        $data= Report::select('id', 'created_at')
                                        ->get()
                                        ->groupBy(function($data){
                                            return Carbon::parse($data->created_at)
                                            ->format('M');
                                        });
        
        $months=[];
        $monthCount=[];
        foreach($data as $month => $values){
            $months[]=$month;
            $monthCount[]=count($values);
        }
        return view('report.admin-report',['data'=>$data, 'months'=>$months, 'monthCount'=>$monthCount])
        ->with('reports', $reports)
        ->with('search',$search);
        
    }
    /*Chart <function>*/    
    // public function staffChart()
    // {
        
    //     // $userData = User::select(\DB::raw("COUNT(*) as count"))
    //     //             ->whereYear('created_at', date('Y'))
    //     //             ->groupBy(\DB::raw("Month(created_at)"))
    //     //             ->pluck('count'); 
    //     // return view('home', compact('userData'));
        

    //     return view('report.staff-report');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //this->authorize('create',Report::class);

        return view('report.create-report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = new Report();
        $report->user_id = Auth::id();
        $report->description = $request->input('description');
        $report->save();

        return redirect('/reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //this->authorize('view', Report::class);

        return view('report.show-report');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        return view('report.edit-report')
        ->with('reports', $report);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportRequest  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        this->authorize('update', $report);
        $report->description = $request->input('description');
        $report->update();

        return redirect()
        ->route('report.edit', $report->id)
        ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //this->authorize('delete', report);

        $report->delete();

        return redirect('/reports');
    }

    /*Chart <function>*/
    // public function staffChart()
    // {
        
    //     // $userData = User::select(\DB::raw("COUNT(*) as count"))
    //     //             ->whereYear('created_at', date('Y'))
    //     //             ->groupBy(\DB::raw("Month(created_at)"))
    //     //             ->pluck('count'); 
    //     // return view('home', compact('userData'));
        

    //     return view('report.staff-report');
    // }

}

