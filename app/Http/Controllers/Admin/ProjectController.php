<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $rules = [
        'title' => ['required', 'min:3', 'string', 'max:255'],
        'type_id' => ['exists:types,id'],
        'technologies' => ['exists:technologies,id'],
        'project_url' => ['url:https', 'required'],
        'description' => ['min:15', 'required'],
        'used_languages' => ['min:3', 'required'],
    ];

    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate($this->rules);
        $data['user_id'] = Auth::id();
        $project = Project::create($data);

        // Che cosa significa?
        $project->technologies()->sync($data['technologies']);



        return redirect()->route('admin.projects.show', $project)->with('message', $project->title . ' has been created succesfully!')->with('alert-class', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate($this->rules);
        $data['user_id'] = Auth::id();
        $project->update($data);
        $project->technologies()->sync($data['technologies']);

        return redirect()->route('admin.projects.show', $project)->with('message', $project->title . ' has been edited succesfully!')->with('alert-class', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', $project->title . ' has been deleted and moved to the deleted page!')->with('alert-class', 'warning');
    }

    public function deletedProjects()
    {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.deleted', compact('projects'));
    }

    public function restoreProject(string $id)
    {
        $project = Project::withTrashed()->where('id', $id)->first();
        $project->restore();

        return redirect()->route('admin.projects.show', $project)->with('message', $project->title . ' has been restored succesfully!')->with('alert-class', 'success');
    }

    public function destroyProject(string $id)
    {
        $project = Project::withTrashed()->where('id', $id)->first();
        $project->technologies()->detach();
        $project->forceDelete();

        return redirect()->route('admin.projects.deleted')->with('message', $project->title . ' has been definitively
        deleted!')->with('alert-class', 'danger');
    }
}
