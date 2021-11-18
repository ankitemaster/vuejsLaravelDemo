<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {

        if(auth()->user()->hasRole('Super Admin')) {
            $projects = Project::orderBy('id', 'desc')->get();
        } else if(auth()->user()->hasRole('Admin')) {
            $projects = Project::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        } else {
            $projectIds = UserProject::where('user_id', auth()->user()->id)->pluck('project_id');
            $projects = Project::whereIn('id', $projectIds)->orderBy('id', 'desc')->get();
        }
        return response()->json([
            'status' => true,
            'message' => 'Project List Get Successfully',
            'data' => $projects
        ]);
    }

    public function store(Request $request) {
        $project = Project::create($request->except('add_user_to_project', 'delete_user_to_project', 'project_users', 'inputs'));
        foreach($request->project_users as $project_user) {
            $userProject = UserProject::where('user_id' , $project_user['id'])->where('project_id' , $project->id)->first();
            if(!isset($userProject->id)) {
                UserProject::create([
                    'user_id' => $project_user['id'],
                    'project_id' => $project->id
                ]);
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Project Add Get Successfully',
            'data' => []
        ]);
    }

    public function update(Request $request, $id) {
        $project = Project::where('id', $id)->update($request->except('add_user_to_project', 'delete_user_to_project', 'project_users', 'inputs'));
        UserProject::where('project_id', $id)->delete();
        foreach($request->project_users as $project_user) {
            $userProject = UserProject::where('user_id' , $project_user['id'])->where('project_id' , $project->id)->first();
            if(!isset($userProject->id)) {
                UserProject::create([
                    'user_id' => $project_user['id'],
                    'project_id' => $project->id
                ]);
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Project Updated Successfully',
            'data' => []
        ]);
    }

    public function show($id) {
        $project = Project::find($id);
        $project_users = UserProject::with('user')->where('project_id', $id)->get();
        $project_users_array = array();
        foreach($project_users as $project_user) {
            array_push($project_users_array, $project_user->user);
        }
        $project->project_users = $project_users_array;
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
