<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        return response()->json([
            'status' => true,
            'message' => 'Project List Get Successfully',
            'data' => Project::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(Request $request) {
        $project = Project::create($request->except('add_user_to_project', 'delete_user_to_project', 'project_users'));
        foreach($request->project_users as $project_user) {
            UserProject::create([
                'user_id' => $project_user['id'],
                'project_id' => $project->id
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Project Add Get Successfully',
            'data' => []
        ]);
    }

    public function update(Request $request, $id) {
        $project = Project::where('id', $id)->update($request->except('add_user_to_project', 'delete_user_to_project', 'project_users'));
        UserProject::where('project_id', $id)->delete();
        foreach($request->project_users as $project_user) {
            UserProject::create([
                'user_id' => $project_user['id'],
                'project_id' => $project->id
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Project Updated Successfully',
            'data' => []
        ]);
    }

    public function show($id) {
        $project = Project::find($id);
        $project->project_users = UserProject::where('project_id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Project Get Successfully',
            'data' => [$project]
        ]);
    }

    public function destroy($id) {
        Project::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Project Deleted Successfully',
            'data' => []
        ]);
    }

    public function export() {

    }
}
