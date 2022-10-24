<?php

namespace App\Http\Controllers\Web\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function projects(Project $project)
    {
        menuSubmenu('projects', 'list');
        $projects = $project->paginate(20);
        return view('admin.projects.projectList', [
            'projects' => $projects,
        ]);
    }
    public function projectNew()
    {
        return view('admin.projects.createProject');
    }
    public function projectSave(Project $project, Request $request)
    {
        $project->name = json_encode($request->name);
        $project->description = json_encode($request->description);
        $project->save();
        return redirect()->route('admin.projects')->with('success', 'New Project added.');
    }
}
