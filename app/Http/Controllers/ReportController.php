<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Application;
use App\Models\Donation;
use App\Models\Student;
use App\Models\Staff;
use App\Models\User;
use App\Models\Role;
use PDF;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;

use App\Charts\TotalApplication;
use App\Charts\Users;

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
        $reports = Report::where('id', 'like', "%{$search}%")->paginate(10);
        $totalApplication = DB::table('applications')->count();

        $students = Student::orderBy('year')->pluck('id','year');
        
        $chart = new Users;
        $chart->labels($students->keys());
        $chart->dataset('Student', 'pie', $students->values());

        return view('report.admin-report',compact('chart'))
        ->with('reports', $reports)
        ->with('search',$search)
        ->with('totalApplication',$totalApplication);
        
    }

    public function indexStaff(Request $request)
    {
        
        $lists = DB::table('students')
        ->leftJoin('applications','students.id','=','applications.student_id')
        ->select('students.id','students.matric_no','applications.*',
        DB::raw('SUM(applications.amount) as total'),
        DB::raw('COUNT(applications.id) as totalApplication')
        )
        ->groupBy('applications.student_id')
        ->get();
        return view('report.staff-report')
        ->with('lists',$lists);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //this->authorize('create',Report::class);
        $totalAmount = DB::table('applications')->sum('amount');
        $totalDonation = DB::table('donations')->sum('amount');
        $totalApplication = DB::table('applications')->count();

        $remainingAmount = $totalAmount - $totalDonation;
        $remainingDonation = $totalDonation - $totalAmount;

        return view('report.create-report')
        ->with('totalAmount', $totalAmount)
        ->with('totalDonation', $totalDonation)
        ->with('totalApplication', $totalApplication)
        ->with('remainingAmount', $remainingAmount)
        ->with('remainingDonation', $remainingDonation);
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
        $report->totalAmount = $request->input('totalAmount');
        $report->totalDonation = $request->input('totalDonation');
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
        $test = Report::all();

        $chart= new TotalApplication;
        $chart->labels(['January', 'February', 'March', ' April']);
        $chart->dataset('My dataset', 'line', [10, 25, 13]);

        // download PDF file with download method

        return view('report.show-report',compact('chart'));
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
        $report->totalAmount = $request->input('totalAmount');
        $report->totalDonation = $request->input('totalDonation');
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


}

