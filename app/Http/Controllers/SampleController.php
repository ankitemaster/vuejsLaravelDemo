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
        $sample = Sample::find($id);
        $baseUrl = url('images').'/';
        if($sample->sample_type_photo) {
            $sample->sample_type_photo = $baseUrl.$sample->sample_type_photo;
        }
        if($sample->tech_data_photo) {
            $sample->tech_data_photo = $baseUrl.$sample->tech_data_photo;
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
        if($request->hasFile('sample_type_photo1')) {
            $image = $request->file('sample_type_photo1');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $request->merge(['sample_type_photo'=>$name]);
        }
        if($request->hasFile('tech_data_photo1')) {
            $image = $request->file('tech_data_photo1');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $request->merge(['tech_data_photo'=>$name]);
        }
        $request->merge(['created_at'=>date('Y-m-d H:i:s', strtotime($request->created_at))]);
        Sample::where('id', $id)->update(
            $request->except(['id','_method', 'updated_at', 'sample_type_photo1', 'tech_data_photo1'])
        );
        return response()->json([
            'status' => true,
            'message' => 'Sample Updated Successfully',
            'data' => $request->all()
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
        $sample = Sample::where('id', $id)->first();
        $sample->$key = $name;
        $sample->save();
        return response()->json([
            'status' => true,
            'message' => 'Signature Uploaded Successfully'
        ]);
    }
}
