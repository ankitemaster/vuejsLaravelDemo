<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Sample;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SampleExport implements FromView
{
    private $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    public function view(): View
    {
        $projectName = Project::where('id', $this->projectId)->first()->title;
        $samples = Sample::where('project_id', $this->projectId)->get();
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
        }
        return view('exports.samples', [
            'samples' => $samples,
            'projectName' => $projectName
        ]);
    }
}
