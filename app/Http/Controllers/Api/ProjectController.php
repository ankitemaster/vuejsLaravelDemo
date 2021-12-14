<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Sample;
use App\Models\UserProject;
use Illuminate\Http\Request;
use Elasticsearch;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Http;
use PhpParser\Builder\Function_;

class ProjectController extends Controller
{
    public function getElasticData($searhValue) {
        $url = "localhost:9200/samples/_search?q=".$searhValue;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $getURL = curl_exec($ch);
        $getInfo = json_decode($getURL, true);
        curl_close($ch);
        return $getInfo;
    }


    public function index(Request $request) {
        if(auth()->user()->hasRole('Super Admin')) {
            $projectIds = Project::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->pluck('id');
        } else if(auth()->user()->hasRole('Admin')) {
            $projectIds = Project::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->pluck('id');
        } else {
            $projectIds = UserProject::where('user_id', auth()->user()->id)->pluck('project_id');
        }
        if($request->search_value == '' && $request->filter_value == '') {
            $projects = Project::whereIn('id', $projectIds)->get();
        } else if($request->search_value != '' && $request->filter_value == '') {
            // $response = Http::get('http://localhost:9200/samples/_search?q='.$request->search_value);
            $response = $this->getElasticData($request->search_value);
            if(count($response['hits']['hits']) > 0) {
                $sampleIds = [];
                foreach($response['hits']['hits'] as $value) {
                    array_push($sampleIds, $value['_source']['id']);
                }
                $projectIds = Sample::whereIn('id', $sampleIds)->whereIn('project_id', $projectIds);
                $projectIds = $projectIds->pluck('id')->toArray();
                $projects = Project::whereIn('id', $projectIds)->get();
            }else {
                $projects = [];
            }
        } else if($request->search_value == '' && $request->filter_value != '') {
            $projectIds = Sample::where('manufacturer', 'like', '%'.$request->filter_value.'%')->whereIn('project_id', $projectIds);
            $projectIds = $projectIds->pluck('id')->toArray();
            $projects = Project::whereIn('id', $projectIds)->get();
        } else {
            // $response = Http::get('http://localhost:9200/samples/_search?q='.$request->search_value);
            $response = $this->getElasticData($request->search_value);
            if(count($response->hits->hits) > 0) {
                $sampleIds = [];
                foreach($response['hits']['hits'] as $value) {
                    array_push($sampleIds, $value['_source']['id']);
                }
                $projectIds = Sample::whereIn('id', $sampleIds)->where('manufacturer', 'like', '%'.$request->filter_value.'%')->whereIn('project_id', $projectIds);
                $projectIds = $projectIds->pluck('id')->toArray();
                $projects = Project::whereIn('id', $projectIds)->get();
            }else {
                $projects = [];
            }
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
        foreach($request->project_users as $key=>$project_user) {
            $userProject = UserProject::where('user_id' , $request->project_users[$key]['id'])->where('project_id' , $id)->first();
            if(!isset($userProject->id)) {
                UserProject::create([
                    'user_id' => $request->project_users[$key]['id'],
                    'project_id' => $id
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

    public function manufacturesList()
    {
        return response()->json([
            'status' => true,
            'message' => 'Manufacturer get Successfully',
            'data' => Sample::whereNotNull('manufacturer')->orderBy('id', 'desc')->pluck('manufacturer')
        ]);
    }

    public function projectExport(Request $request) {
        if($request->type == 'project') {
            $projectId = $request->id;
            $samples = Sample::where('project_id', $projectId)->get();
        } else {
            $sampleId = $request->id;
            $samples = Sample::where('id', $sampleId)->get();
        }
        foreach($samples as $key=>$sample) {
            $total_signature = json_decode($sample->signatureValues);
            $signed_signature_count = 0;
            $unsigned_signature_count = 0;
            $approved_signature_count = 0;
            $rejected_signature_count = 0;
            foreach($total_signature as $val) {
                if($val->signature != '') {
                    $signed_signature_count = $signed_signature_count + 1;
                }
                if($val->signature == '') {
                    $unsigned_signature_count = $unsigned_signature_count + 1;
                }
                if($val->status == 1) {
                    $approved_signature_count = $approved_signature_count + 1;
                }
                if($val->status == 2) {
                    $rejected_signature_count = $rejected_signature_count + 1;
                }
            }
            $sample->total_signature = count($total_signature);
            $sample->signed_signature = $signed_signature_count;
            $sample->unsigned_signature = $unsigned_signature_count;
            $sample->approved_signature = $approved_signature_count;
            $sample->rejected_signature = $rejected_signature_count;
            $baseUrl = url('images').'/';
            if($sample->sample_type_photo) {
                if(count(json_decode($sample->sample_type_photo)) > 0) {
                    $sampleTypePhoto = json_decode($sample->sample_type_photo);
                    foreach($sampleTypePhoto as $key=>$value) {
                        $sampleTypePhoto[$key] = $baseUrl.$value;
                    }
                    $sample->sample_type_photo = $sampleTypePhoto;
                } else {
                    $sample->sample_type_photo = [];
                }
            } else {
                $sample->sample_type_photo = [];
            }
            if($sample->tech_data_photo) {
                if(count(json_decode($sample->tech_data_photo)) > 0) {
                    $techDataPhoto = json_decode($sample->tech_data_photo);
                    foreach($techDataPhoto as $key=>$value) {
                        $techDataPhoto[$key] = $baseUrl.$value;
                    }
                    $sample->tech_data_photo = $techDataPhoto;
                } else {
                    $sample->tech_data_photo = [];
                }
            } else {
                $sample->tech_data_photo = [];
            }
        }
        $data['samples'] = $samples;
        $pdf = \PDF::loadView('exports.samples', $data);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->download('invoice.pdf');
    }
}
