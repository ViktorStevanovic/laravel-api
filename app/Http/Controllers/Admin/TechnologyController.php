<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();

        return view('admin.technologies.create', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $technology = new Technology($data);
        $technology->save();
        $data['slug'] = Str::slug($technology->id . ' ' . $technology->name);
        $technology->update($data);
        return redirect()->route('admin.technologies.show', $technology)->with('message', $technology->name . ' has been created succesfully!')->with('alert-class', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        $technologies = Technology::all();
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->all();
        $technology->update($data);

        return redirect()->route('admin.technologies.show', $technology)->with('message', $technology->name . ' has been edited succesfully!')->with('alert-class', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('message', $technology->name . ' has been moved to the destroyed page!')->with('alert-class', 'warning');
    }
    public function deletedProjects()
    {
        $technologies = Technology::onlyTrashed()->get();
        return view('admin.technologies.deleted', compact('technologies'));
    }

    public function restoreTechnology(string $id)
    {
        $technology = Technology::withTrashed()->where('id', $id)->first();
        $technology->restore();

        return redirect()->route('admin.technologies.show', $technology)->with('message', $technology->name . ' has been restored succesfully!')->with('alert-class', 'success');
    }

    public function destroyTechnology(string $id)
    {
        $technology = Technology::withTrashed()->where('id', $id)->first();
        $technology->projects()->detach();
        $technology->forceDelete();

        return redirect()->route('admin.technologies.deleted')->with('message', $technology->name . ' has been definitively deleted!')->with('alert-class', 'danger');
    }
}
