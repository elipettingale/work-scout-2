<?php

namespace App\Transformers;

use App\Contracts\Transformer;
use App\Enums\JobSite;
use App\Helpers\ResultParser;

class Reed implements Transformer 
{
    public function getReference(array $data): string
    {
        return $data['jobId'];
    }

    public function getData(array $data): array 
    {
        $rawDescription = html_entity_decode($data['jobDescription']);
        $parser = new ResultParser($rawDescription);

        return [
            'job_site' => JobSite::REED,
            'reference' => $data['jobId'],
            'title' => $data['jobTitle'],
            'rate' => $parser->getRate(),
            'length' => $parser->getLength(),
            'ir35' => $parser->getIr35(),
            'remote' => $parser->getRemote(),
            'description' => $rawDescription,
            'url' => $data['jobUrl']
        ];
    }
}
