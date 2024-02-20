<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('technologies', 'type')->get();
        return response()->json(
            [
                "success" => true,
                "results" => $projects
            ]
        );
    }

    public function show(Project $project)
    {
        // dd($project);
        return response()->json(
            [
                "success" => true,
                "results" => $project
            ]
        );
    }

    public function search(Request $request)
    {
        $data = $request->all();

        if (isset($data['title'])) {
            $word = $data['title'];
            $projects = Project::where('title', 'LIKE', "%{$word}%")->get();
        } else {
            abort(404);
        }

        return response()->json([
            "success" => true,
            "results" => $projects,
            "matches" => count($projects)
        ]);
    }
}
