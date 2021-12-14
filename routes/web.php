<?php

use App\Models\Sample;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('exportSample', function() {
    // $client = Elasticsearch\ClientBuilder::create()->build();
    // echo "<pre>";
    // print_r($client);
    // die;
    
    // $pageurl = "localhost:9200/samples/_search?q=SAMP";
    // $ch = curl_init($pageurl);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    // curl_setopt($ch, CURL_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // $getInfo = json_decode($response, true);
    // echo $response;


    $url = "localhost:9200/samples/_search?q=SAMP";

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $getURL = curl_exec($ch);

    $getInfo = json_decode($getURL, true);

    curl_close($ch);
    $sampleIds = [];
    foreach ($getInfo['hits']['hits'] as $key => $value) {
        array_push($sampleIds, $value['_source']['id']);
    }
    print_r($sampleIds);
    die;


    // return Excel::download(new SampleExport("1"), 'samples.pdf');
    $pdf = PDF::loadView('exports.samples');
    return $pdf->download('invoice.pdf');
});

Route::get('/check', function() {
    Sample::reindex();
    // Sample::createIndex($shards = null, $replicas = null);
    // Sample::putMapping($ignoreConflicts = true);
    // Sample::addAllToIndex();
});

Route::get('/search', function() {
    $samples = Sample::searchByQuery(
        [
            'match' =>
                [
                    'manufacturer' => 'fds'
                ],
            'match' =>
                [
                    'title' => 'SAMP-002'
                ]
        ]
    );
    return $samples;
});

Route::get('projectExport', [App\Http\Controllers\Api\ProjectController::class, 'projectExport']);

Route::redirect('/', '/login');

Auth::routes();

// Route::get('/seeSampleStatus/{id}', [\App\Http\Controllers\SampleController::class, 'seeSampleStatus'])->name('seeSampleStatus');

Route::get('/admin/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*')->name('home');
