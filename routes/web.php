<?php

use App\Models\Sample;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('exportSample', function() {
    // return Excel::download(new SampleExport("1"), 'samples.pdf');
    $pdf = PDF::loadView('exports.samples');
    return $pdf->download('invoice.pdf');
});

Route::get('/check', function() {
    Sample::createIndex($shards = null, $replicas = null);
    Sample::putMapping($ignoreConflicts = true);
    Sample::addAllToIndex();
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
