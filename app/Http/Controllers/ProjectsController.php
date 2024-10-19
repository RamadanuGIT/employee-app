<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('dashboard.agenda.project', [
            'title' => 'Projects',
            'projects' => Projects::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(' dashboard.agenda.create_project', [
            'title' => 'project',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

        ]);
        Projects::create($data);
        return redirect()->route('project')->with('success', 'sukses membuat project');
    }

    /**
     * Display the specified resource.
     */
    public function update(Request $request, $id)
    {
        $prj = Projects::findOrFail($id);
        $data = $request->validate([

        ]);

        $prj::update($data);
        return redirect()->back()->with('success', 'Update Projects');
    }

    public function destroy($id)
    {
        $prj = Projects::findOrFail($id);
        $prj->delete();
        return redirect()->back()->with('success', 'Delete Project');
    }

}
