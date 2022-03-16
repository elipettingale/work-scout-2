<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Result;

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

    function getIr35($item) {
        if ($item->ir35 === null) {
            return '-';
        }

        return $item->ir35 ? 'Outside' : 'Inside';
    }
    
    function getLength($item) {
        if ($item->length === null) {
            return '-';
        }

        return "{$item->length} Months";
    }

    function getRate($item) {
        if ($item->min_rate === null) {
            return '-';
        }

        if ($item->min_rate === $item->max_rate) {
            return "£{$item->min_rate}";
        }

        return "£{$item->min_rate} - £{$item->max_rate}";
    }

    foreach ($data as $item) {
        

        $results[] = [
            'id' => $item->id,
            'title' => $item->title,
            'score' => $item->score,
            'rate' => getRate($item),
            'length' => getLength($item),
            'ir35' => getIr35($item),
            'remote' => $item->remote ? 'Yes' : 'No'
        ];
    }

    return $results;
});
