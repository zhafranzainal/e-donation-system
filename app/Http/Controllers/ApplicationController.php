<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Applciation;
use Spatie\Permission\Models\Permission;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('list', Application::class);

        $search = $request->get('search', '');
        $applications = Application::where('student_id', 'like', "%{$search}%")->paginate(10);

        return view('application.index')
            ->with('applications', $applications)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Application::class);

        return view('application.create-application');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $application = new Application();
        $application->student_id = Auth::id();
        $application->amount = $request->input('amount');
        $application->reason = $request->input('reason');
        $application->save();
        
        return redirect('/applications');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        // $this->authorize('view', Application::class);

        return view('application.show-application');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        return view('application.update-application')
            ->with('applications', $application);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        $this->authorize('update', $application);
        $application->amount = $request->input('amount');
        $application->reason = $request->input('reason');
        $application->update();

        return redirect()
            ->route('applications.edit', $application->id)
            ->withSuccess(__('crud.common.saved'));
    }

    public function approve(Request $request, Application $application)
    {

        // $this->authorize('approve', $application);

        $this->authorize('approve', $application);
        $application->status = 'approved';
        $application->approved_at = now();

        $application->update();

        return redirect('/applications');
    }

    public function reject(Request $request, Application $application)
    {
        // $this->authorize('update', $application);

        $this->authorize('reject', $application);
        $application->status = 'rejected';

        $application->update();

        return redirect('/applications');    
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        // $this->authorize('delete', $application);

        $application->delete();

        return redirect('/applications');
    }

    public function payment(Application $application)
    {
        $application->status = 'completed';
        return view('application.index')
            ->with('applications', $application);
        
    }

}
