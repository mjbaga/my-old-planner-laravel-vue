<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectPostRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = 'engagement')
    {
        return view('admin.projects.index', ['type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = 'engagement')
    {
        return view('admin.projects.create', ['type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectPostRequest $request)
    {
        $request->validated();

        $project = new Project([
            'type' => $request->get('type'),
            'engagement_code' => $request->get('engagement_code'),
            'project_name' => $request->get('project_name'),
            'client_name' => $request->get('client_name'),
            'abbreviation' => $request->get('abbreviation'),
            'status' => $request->get('status')
        ]);

        $project->save();

        return redirect()->route('admin.projects', $project->type)->with('success', 'A new project has been added.');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ecode = null)
    {
        $project = Project::where('engagement_code', $ecode)->first();
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectPostRequest $request, $id)
    {
        $request->validated();

        $project = Project::find($id);
        $project->engagement_code = $request->get('engagement_code');
        $project->project_name = $request->get('project_name');
        $project->client_name = $request->get('client_name');
        $project->abbreviation = $request->get('abbreviation');
        $project->status = $request->get('status');

        $project->save();

        return redirect()->route('project.edit', $project->engagement_code)->with('success', 'Project successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return back()->with('success', 'Successfully deleted project');
    }

    /**
     * Retrieve all titles through an API request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAuthorisedProjects(Request $request)
    {
        $projects = Project::where('type', 'authorised-project')->get();
        return response()->json($projects);
    }

    /**
     * Retrieve all titles through an API request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEngagements(Request $request)
    {
        $projects = Project::where('type', 'engagement')->get();
        return response()->json($projects);
    }
}
