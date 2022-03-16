<?php

namespace App\Services;

use App\Contracts\ApiService;

class Reed implements ApiService
{
    private const BASE_URL = 'https://www.reed.co.uk/api/1.0/';

    public function getResults(array $terms): array
    {
        $results = [];

        $page = 1;
        $done = false;
       
        while (!$done) {
            $data = $this->getResultsByPage($terms, $page);
            $results = array_merge($results, $data);

            if (count($data) < 100) {
                $done = true;
            }

            $page++;
        }

        return $results;
    }

    private function getResultsByPage(array $terms, $page)
    {
        $keywords = implode('+', $terms);
        $resultsToSkip = ($page * 100) - 100;

        $response = $this->get("search?keywords={$keywords}&contract=true&resultsToSkip={$resultsToSkip}");
        
        return json_decode($response, true)['results'];
    }

    public function getFullResult(string $reference): array
    {
        $response =  $this->get("jobs/$reference");

        return json_decode($response, true);
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
