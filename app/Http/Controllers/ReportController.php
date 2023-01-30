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

use App\Charts\Total;
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
        $totalDonation = DB::table('donations')->count();
        $totalStudent = DB::table('students')->count();
        $totalStaff = DB::table('staffs')->count();
        $totalUser = $totalStudent + $totalStaff;
        $totalRejected = DB::table('applications')->where('status', 'Rejected')->count();
        $totalApproved = DB::table('applications')->where('status', 'Approved')->count();
        $totalPending = DB::table('applications')->where('status', 'Pending')->count();

        //Student Chart
        $students = Student::select(DB::raw('COUNT(*) as totalStudent'),
                                    DB::raw('year as year'))
                                    ->groupBy('year')
                                    ->orderBy('year')
                                    ->pluck('totalStudent','year');

        $chart1 = new Users;
        $chart1->labels($students->keys());
        $chart1->dataset('Number of Student', 'pie', $students->values())
                ->backgroundcolor(['rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 232, 156)',
                'rgb(119, 252, 197)']);

        //Staff Chart
        $staffs = Staff::select(DB::raw('COUNT(*) as totalStaff'),
                                    DB::raw('rank as rank'))
                                    ->groupBy('rank')
                                    ->orderBy('rank')
                                    ->pluck('totalStaff','rank');

        $chart2 = new Users;
        $chart2->labels($staffs->keys());
        $chart2->dataset('Number of Staff', 'pie', $staffs->values())
                ->backgroundcolor(['rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 232, 156)',
                'rgb(119, 252, 197)']);

        //Line Chart
        $donations = Donation::select(DB::raw('SUM(amount) as total'),
                                    DB::raw('MONTHNAME(created_at) as month'))
                                    ->groupBy('month')
                                    ->orderBy('month')
                                    ->pluck('total','month');
        
        $applicationAmount = Application::select(DB::raw('SUM(amount) as total'),
                                    DB::raw('MONTHNAME(created_at) as month'))
                                    ->groupBy('month')
                                    ->orderBy('month')
                                    ->pluck('total','month');
        $chart3 = new Total;
        $chart3->labels($donations->keys());
        $chart3->dataset('Total Donation', 'line', $donations->values())
                ->backgroundcolor(['rgb(255, 99, 132, .5)']);
        $chart3->dataset('Total Application', 'line', $applicationAmount->values())
                ->backgroundcolor(['rgb(54, 162, 235, .5)']);

        //Return view
        return view('report.admin-report',compact('chart1','chart2','chart3'))
        ->with('reports', $reports)
        ->with('search',$search)
        ->with('totalApplication',$totalApplication)
        ->with('totalDonation',$totalDonation)
        ->with('totalRejected',$totalRejected)
        ->with('totalApproved',$totalApproved)
        ->with('totalPending',$totalPending)
        ->with('totalStudent',$totalStudent)
        ->with('totalStaff',$totalStaff)
        ->with('totalUser',$totalUser);
        
    }

    public function indexStaff(Request $request)
    {
        
        $lists = DB::table('students')
        ->leftJoin('applications','students.id','=','applications.student_id')
        ->select('students.id','students.matric_no','applications.*',
        DB::raw('SUM(applications.amount) as total'),
        DB::raw('COUNT(applications.id) as totalApplication'))
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
        $id = $report->id;
        $list =Report::find($id);
        //this->authorize('view', Report::class);
        $donation = Report::select('id','totalDonation')
        ->where('id','=',"{$id}")
        ->pluck('totalDonation','id');

        $application = Report::select('id','totalAmount')
        ->where('id','=',"{$id}")
        ->pluck('totalAmount','id');

        $donationChart= new Total;
        $donationChart->labels($donation->keys());
        $donationChart->dataset('Donation for This Report', 'bar', $donation->values())
        ->backgroundcolor("orange");

        $applicationAmountChart= new Total;
        $applicationAmountChart->labels($application->keys());
        $applicationAmountChart->dataset('Amount of Application Apply for This Report', 'bar', $application->values())
        ->backgroundcolor("red");
        

        return view('report.show-report',compact('donationChart','applicationAmountChart'))
        ->with('id', $id)
        ->with('list', $list);
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

