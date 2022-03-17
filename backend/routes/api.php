<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Result;
use App\Transformers\Result as ResultTransformer;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('results', function() {
    $results = [];

    $data = Result::query()
        ->whereNull('read_at')
        ->whereNull('parent_id')
        ->orderBy('created_at')
        ->get();

    foreach ($data as $item) {
        $results[] = ResultTransformer::transform($item);
    }

    return $results;
});

Route::post('results/{result}/dismiss', function(Result $result) {
    return $result->markAsRead();
});
