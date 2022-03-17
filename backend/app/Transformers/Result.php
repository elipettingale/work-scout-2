<?php

namespace App\Transformers;

use App\Models\Result as ResultModel;

class Result
{
    public static function transform(ResultModel $result)
    {
        return [
            'id' => $result->id,
            'title' => $result->title,
            'score' => $result->score,
            'rate' => self::getRate($result),
            'length' => self::getLength($result),
            'ir35' => self::getIr35($result),
            'remote' => $result->remote ? 'Yes' : 'No',
            'description' => $result->description,
            'url' => $result->url
        ];
    }

    public static function getIr35(ResultModel $result) {
        if ($result->ir35 === null) {
            return '-';
        }

        return $result->ir35 ? 'Outside' : 'Inside';
    }
    
    public static function getLength(ResultModel $result) {
        if ($result->length === null) {
            return '-';
        }

        return "{$result->length} Months";
    }

    public static function getRate(ResultModel $result) {
        if ($result->min_rate === null) {
            return '-';
        }

        if ($result->min_rate === $result->max_rate) {
            return "£{$result->min_rate}";
        }

        return "£{$result->min_rate} - £{$result->max_rate}";
    }
}
