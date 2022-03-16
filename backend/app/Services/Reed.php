<?php

namespace App\Services;

use App\Contracts\ApiService;

class Reed implements ApiService
{
    private const BASE_URL = 'https://www.reed.co.uk/api/1.0/';

    // todo: check both public classes return only result specific data

    public function getSearchResults(array $terms): array
    {
        // todo: perform per page loop until no results then return all at once

        $keywords = implode('+', $terms);
        $resultsToSkip = ($page * 100) - 100;

        return $this->get("search?keywords={$keywords}&resultsToSkip={$resultsToSkip}");
    }

    public function getResultDetails(string $id): array
    {
        return $this->get("jobs/$id");
    }

    private function get($url)
    {
        $curl = curl_init();
        $url = self::BASE_URL . $url;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic MTBlYWJiMjUtMjM4ZS00YjVhLTgyYTAtYjFhNDhmMjAxMTk1Og=='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
