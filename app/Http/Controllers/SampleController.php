<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use Illuminate\Http\Request;
use DB;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Sample Get Successfully',
            'data' => Sample::select('id', 'title', 'description', 'model_no', 'finish', 'client', 'client_rep', 'architech', 'service_consult', 'esd', 'bca', 'sample_url', 'overall_status', 'comments')->get()
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
        $statement = DB::select("SHOW TABLE STATUS LIKE 'samples'");
        $nextId = $statement[0]->Auto_increment;
        Sample::create([
            'title' => 'SAMP-00'.$nextId,
            'project_id' => $request->project_id
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
        if($sample->client_sign) {
            $sample->client_sign = $baseUrl.$sample->client_sign;
        }
        if($sample->client_rep_sign) {
            $sample->client_rep_sign = $baseUrl.$sample->client_rep_sign;
        }
        if($sample->architect_sign) {
            $sample->architect_sign = $baseUrl.$sample->architect_sign;
        }
        if($sample->service_consult_sign) {
            $sample->service_consult_sign = $baseUrl.$sample->service_consult_sign;
        }
        if($sample->structural_consult_sign) {
            $sample->structural_consult_sign = $baseUrl.$sample->structural_consult_sign;
        }
        if($sample->esd_sign) {
            $sample->esd_sign = url('images').'/'.$sample->esd_sign;
        }
        if($sample->bca_sign) {
            $sample->bca_sign = url('images').'/'.$sample->bca_sign;
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
        $allRequest = $request->except(['sample_type_photo','tech_data_photo','id','_method', 'updated_at', 'client_sign', 'client_rep_sign', 'architect_sign', 'service_consult_sign', 'structural_consult_sign', 'esd_sign', 'bca_sign', 'project', 'clientSignatureComment', 'clientRepSignatureComment', 'architectSignatureComment', 'serviceRepoSignatureComment', 'structuralRepoSignatureComment', 'esdRepoSignatureComment', 'bcaRepoSignatureComment']);
        $allRequest['created_at'] = date('Y-m-d H:i:s', strtotime($request->created_at));
        Sample::where('id', $id)->update($allRequest);
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
        $name = "";
        if($request->hasFile('sign')) {
            $image = $request->file('sign');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        $key = $request->key;
        $commentKey = $request->commentKey;
        $sample = Sample::where('id', $id)->first();
        $sample->$key = $name;
        $sample->$commentKey = $request->commentValue;
        $sample->save();
        return response()->json([
            'status' => true,
            'message' => 'Signature Uploaded Successfully'
        ]);
    }

    /**
     * deleteSignature
     */
    public function deleteSignature(Request $request, $id) {
        $key = $request->key;
        $commentKey = $request->commentKey;
        $sample = Sample::where('id', $id)->first();
        $sample->$key = NULL;
        $sample->$commentKey = NULL;
        $sample->save();
        return response()->json([
            'status' => true,
            'message' => 'Deleted Signature Successfully'
        ]);
    }
}
