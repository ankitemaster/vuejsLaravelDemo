<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Sample;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class SampleController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Sample::select('id', 'manufacturer','title', 'description', 'model_no', 'finish', 'client', 'client_rep', 'architech', 'service_consult', 'esd', 'bca', 'sample_url', 'overall_status', 'comments');
        if($request->filter_value  != '') {
            $filter_value = $request->filter_value;
            $query = $query->where(function($query) use($filter_value){
                $query->where('manufacturer', 'like', '%'.trim($filter_value).'%');
            });
        }
        if($request->sub_filter_value  != '') {
            $sub_filter_value = $request->sub_filter_value;
            $query = $query->where(function($query) use($sub_filter_value){
                $query->where('subcontractor', 'like', '%'.trim($sub_filter_value).'%');
            });
        }
        if($request->search_value != '') {
            $search_value = trim($request->search_value);
            $query->where(function ($query) use ($search_value) {
                $columns = ['id', 'manufacturer','title', 'description', 'model_no', 'finish', 'client', 'client_rep', 'architech', 'service_consult', 'esd', 'bca', 'sample_url', 'overall_status', 'comments'];
                foreach($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $search_value . '%');
                }
            });
        }
        $samples = $query->where('project_id', $request->id)->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Sample Get Successfully',
            'data' => $samples
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sample = Sample::where('project_id', $request->project_id)->orderBy('id', 'DESC')->first();
        if(isset($sample->id)) {
            $sampleTitle = $sample->title;
            $nextId = (int) (substr($sampleTitle, -1)) + 1;
        } else {
            $nextId = 1;
        }
        Sample::create([
            'title' => 'SAMP-00'.$nextId,
            'project_id' => $request->project_id,
            'signatureValues' => json_encode([])
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Sample Created Successfully',
            'data' => []
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sample = Sample::with('project')->where('id', $id)->first();
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

        $signatureValues = json_decode($sample->signatureValues);
        $signatureValuesArray = [];
        if(is_array($signatureValues) && count($signatureValues) > 0) {
            foreach($signatureValues as $key=>$value) {
                if($signatureValues[$key]->signature != '')
                {
                    $signatureValues[$key]->signature = $signatureValues[$key]->signature;
                } else {
                    $signatureValues[$key]->signature = '';
                }
                array_push($signatureValuesArray, $signatureValues[$key]);
            }
            $sample->signatureValues = $signatureValuesArray;
        }
        return response()->json([
            'status' => true,
            'message' => 'Sample Get Successfully',
            'data' => $sample
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $allRequest = $request->except(['sample_type_photo','tech_data_photo','id','_method', 'updated_at', 'client_sign', 'client_rep_sign', 'architect_sign', 'service_consult_sign', 'structural_consult_sign', 'esd_sign', 'bca_sign', 'project', 'clientSignatureComment', 'clientRepSignatureComment', 'architectSignatureComment', 'serviceRepoSignatureComment', 'structuralRepoSignatureComment', 'esdRepoSignatureComment', 'bcaRepoSignatureComment', 'signatureValues']);
        $allRequest['created_at'] = date('Y-m-d H:i:s', strtotime($request->created_at));
        $allRequest['signatureValues'] = $request->signatureValues;
        Sample::where('id', $id)->update($allRequest);

        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $allRequest])
            ->log('Some Sample Fields Updated');
        // end
        return response()->json([
            'status' => true,
            'message' => 'Sample Updated Successfully',
            'data' => $request->all()
        ]);
    }

    /**
     * deleteSampleTypePhotoUpload
     */
    public function deleteSampleTypePhotoUpload(Request $request, $id)
    {
        $name = $request->name;
        $sample = Sample::where('id', $id)->first();
        if($sample->sample_type_photo) {
            $sampleTypePhoto =  json_decode($sample->sample_type_photo);
            foreach($sampleTypePhoto as $key=>$value) {
                if($value == $name) {
                    unset($sampleTypePhoto[$key]);
                }
            }
            $sampleTypePhoto = array_values($sampleTypePhoto);
        } else {
            $sampleTypePhoto = [];
        }
        $allRequest['sample_type_photo'] = $sampleTypePhoto;
        Sample::where('id', $id)->update($allRequest);
        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $allRequest])
            ->log('Sample Type File Deleted Successfully');
        // end
        return response()->json([
            'status' => true,
            'message' => 'Files Deleted Successfully',
            'date' => []
        ]);
    }

    /**
     * sampleTypePhoto Upload
     */
    public function sampleTypePhotoUpload(Request $request, $id)
    {
        $sample = Sample::where('id', $id)->first();
        if($sample->sample_type_photo) {
            $sampleTypePhoto =  json_decode($sample->sample_type_photo);
        } else {
            $sampleTypePhoto = [];
        }
        $allRequest = [];
        if($request->hasFile('file')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            array_push($sampleTypePhoto, $name);
            $allRequest['sample_type_photo'] = json_encode($sampleTypePhoto);
        }
        $allRequest['sample_type'] = 1;
        Sample::where('id', $id)->update($allRequest);
        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $allRequest])
            ->log('Sample Type File Uploaded Successfully');
        // end
        return response()->json([
            'status' => true,
            'message' => 'Files Upload Successfully',
            'date' => []
        ]);
    }

    /**
     * deleteSampleTypePhotoUpload
     */
    public function deleteTechDataPhotoUpload(Request $request, $id)
    {
        $name = $request->name;
        $sample = Sample::where('id', $id)->first();
        if($sample->tech_data_photo) {
            $techDataPhoto =  json_decode($sample->tech_data_photo);
            foreach($techDataPhoto as $key=>$value) {
                if($value == $name) {
                    unset($techDataPhoto[$key]);
                }
            }
            $techDataPhoto = array_values($techDataPhoto);
        } else {
            $techDataPhoto = [];
        }
        $allRequest['tech_data_photo'] = $techDataPhoto;
        Sample::where('id', $id)->update($allRequest);
        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $allRequest])
            ->log('Tech Date File Deleted Successfully');
        // end
        return response()->json([
            'status' => true,
            'message' => 'Files Deleted Successfully',
            'date' => []
        ]);
    }

    /**
     * sampleTypePhoto Upload
     */
    public function techDataPhotoUpload(Request $request, $id)
    {
        $sample = Sample::where('id', $id)->first();
        if($sample->tech_data_photo) {
            $techDataPhoto =  json_decode($sample->tech_data_photo);
        } else {
            $techDataPhoto = [];
        }
        $allRequest = [];
        if($request->hasFile('file')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            array_push($techDataPhoto, $name);
            $allRequest['tech_data_photo'] = json_encode($techDataPhoto);
        }
        $allRequest['data_period'] = 1;
        Sample::where('id', $id)->update($allRequest);
        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $allRequest])
            ->log('Tech Date File Uploaded Successfully');
        // end
        return response()->json([
            'status' => true,
            'message' => 'Files Upload Successfully',
            'date' => []
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * signatureUpload
     */
    public function signatureUpload(Request $request, $id)
    {
        $baseUrl = url('images').'/';
        $name = "";
        $key = $request->key;
        if($request->hasFile('sign')) {
            $image = $request->file('sign');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        $labelName = '';
        $sample = Sample::where('id', $id)->first();
        $signatureValues = json_decode($sample->signatureValues);
        $signatureValues[$key]->signature = $baseUrl.$name;
        // $signatureValues[$key]->comment = $request->commentValue;
        $sample->signatureValues = json_encode($signatureValues);
        $sample->save();

        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $signatureValues])
            ->log('Signature Signed Successfully For '.$labelName);
        // end

        return response()->json([
            'status' => true,
            'message' => 'Signature Uploaded Successfully',
            'data' => $signatureValues
        ]);
    }

    /**
     * update signature
     */
    public function updateSignature(Request $request, $id)
    {
        $key = $request->key;
        $sample = Sample::where('id', $id)->first();
        $signatureValues = json_decode($sample->signatureValues);
        $signatureValues[$key]->comment = $request->comment;
        $signatureValues[$key]->status = $request->status;
        $sample->signatureValues = json_encode($signatureValues);
        $labelName = $sample->label_name;
        $sample->save();
        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $signatureValues])
            ->log('Signature Signed Successfully For '.$labelName);
        // end
        return response()->json([
            'status' => true,
            'message' => 'Updated Signature Successfully'
        ]);
    }

    /**
     * deleteSignature
     */
    public function deleteSignature(Request $request, $id) {

        $name = "";
        $key = $request->key;
        if($request->hasFile('sign')) {
            $image = $request->file('sign');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        $sample = Sample::where('id', $id)->first();
        $signatureValues = json_decode($sample->signatureValues);
        $signatureValuesArray = [];
        foreach($signatureValues as $key1=>$value) {
            if($key != $key1) {
                array_push($signatureValuesArray, $signatureValues[$key1]);
            } else {
                $signatureValues[$key]->signature = '';
                $signatureValues[$key]->comment = '';
                $signatureValues[$key]->status = 0;
                array_push($signatureValuesArray, $signatureValues[$key1]);
            }
        }
        $sample->signatureValues = json_encode($signatureValuesArray);
        $labelName = $sample->label_name;
        $sample->save();
        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $signatureValues])
            ->log('Signature Signed Successfully For '.$labelName);
        // end
        return response()->json([
            'status' => true,
            'message' => 'Signature Deleted Successfully'
        ]);
    }

    public function seeSampleStatus($id) {
        $projectName = Project::where('id', $id)->first()->title;
        $samples = Sample::where('project_id', $id)->get();

        $allFieldArray = array();
        foreach($samples as $key=>$sample) {
            if(count(json_decode($sample->signatureValues)) > 0){
                $tempArray = json_decode($sample->signatureValues);
                foreach($tempArray as $key1=>$value1) {
                    $tempArray[$key1]->label_name = isset($tempArray[$key1]->label_name) ? strtolower($tempArray[$key1]->label_name) : '';
                }
                $allFieldArray = array_merge($allFieldArray, $tempArray);
            }
        }

        $dynamicFields = collect($allFieldArray)->map(function ($name) {
            return isset($name->label_name) ? strtolower($name->label_name) : '';
        })->reject(function ($name) {
            return empty($name);
        })->toArray();

        $dynamicFields = array_unique($dynamicFields, SORT_REGULAR);

        $headers = ['Sample Title', 'Description', 'Manufacturer', 'Model No', 'Finish'];
        $headers = array_merge($headers, $dynamicFields);
        $headers = array_merge($headers, ['Sample Url', 'Overall Status', 'Comments']);

        $samplesArray = array();
        foreach($samples as $key=>$sample) {
            $object = new \stdClass();
            $object->title = $sample->title;
            $object->description = $sample->description;
            $object->manufacturer = $sample->manufacturer;
            $object->model_no = $sample->model_no;
            $object->finish = $sample->finish;

            $dynamicFieldsValueArray = array();
            $signatureValues = json_decode($sample->signatureValues);

            $comments = collect($signatureValues)->map(function ($name) {
                return isset($name->comment) ? $name->comment : '';
            })->reject(function ($name) {
                return empty($name);
            });

            $comments = $comments->toArray();
            $comments = implode(",", $comments);
            foreach($dynamicFields as $val) {
                $fieldValue = 'NA';
                foreach($signatureValues as $val1) {
                    if(strtolower(trim($val)) == isset($val1->label_name) ? strtolower(trim($val1->label_name)) : '') {
                        if($val1->signature == '') {
                            $fieldValue = 'No';
                        } else {
                            if($val1->status == 1) {
                                $fieldValue = 'Approved';
                            } else if($val1->status == 2) {
                                $fieldValue = 'Rejected';
                            }else {
                                $fieldValue = 'Yes';
                            }
                        }
                    }
                }
                array_push($dynamicFieldsValueArray, $fieldValue);
            }

            $object->dynamic_fields = $dynamicFieldsValueArray;
            $object->sample_url = '';
            $object->overall_status = '';
            $object->comments = $comments;
            array_push($samplesArray, $object);
        }
        return response()->json([
            'status' => true,
            'message' => 'data',
            'data' => [
                'samples' => $samplesArray,
                'projectName' => $projectName,
                'dynamicFields'=> $dynamicFields
            ]
        ]);
        // $fileName = 'public/samples'.strtotime(date('Y-m-d H:i:s')).'.pdf';
        // Excel::store(new SampleExport($id), $fileName);
        // $url = env('APP_URL').'/storage/'.$fileName;
        // $url = str_replace('/public', '', $url);
        // echo "<iframe style='width:100%; height:100vh;' src='".$url."'></iframe>";
    }

    public function changeSampleStatus(Request $request, $id) {
        $sample = Sample::where('id', $id)->first();
        $sample->status = $request->status;
        $sample->save();
        // activity log
        $anEloquentModel = Sample::find($id);
        activity()
            ->performedOn($anEloquentModel)
            ->causedBy(auth()->user())
            ->withProperties(['customProperty' => $request->all()])
            ->log('Sample Status Changed Successfully');
        // end
        return response()->json([
            'status' => true,
            'message' => 'change sample status successfully',
            'data' => []
        ]);
    }

    public function seeSampleActivityLogs($id) {
        $sampleActivityLogs = Activity::with('causer')->where('subject_id', $id)->get();
        foreach($sampleActivityLogs as $key=>$activity) {
            $sampleActivityLogs[$key]->time_ago = ($sampleActivityLogs[$key]->created_at)->diffForHumans();
        }
        return response()->json([
            'status' => true,
            'message' => 'activity logs successfully',
            'data' => $sampleActivityLogs
        ]);
    }

}
