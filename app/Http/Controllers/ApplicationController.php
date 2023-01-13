<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Applciation;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('list', Application::class);

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
        $this->authorize('create', Application::class);

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
        anctum::actingAs(request()->user(), [], 'web');

        $this->authorize('create', Application::class);

        $data = $this->validate($request, [
            'student_id' => 'required|unique:roles|max:32',
        ]);

        return redirect()
            ->route('application.update-application')
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        $this->authorize('view', Application::class);

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
        $this->authorize('update', $application);

        return view('application.update-application')
            ->with('application', $application);
        $status = DB::table('applications')
            ->groupBy('status')
            ->get();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $this->authorize('delete', $application);

        $application->delete();

        return redirect()
            ->route('application.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
