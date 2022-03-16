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
        $parser = new ResultParser($data['jobTitle'] . $rawDescription);

        return [
            'job_site' => JobSite::REED,
            'reference' => $data['jobId'],
            'title' => $data['jobTitle'],
            'min_rate' => $parser->getMinRate(),
            'max_rate' => $parser->getMaxRate(),
            'length' => $parser->getLength(),
            'ir35' => $parser->getIr35(),
            'remote' => $parser->getRemote(),
            'description' => $rawDescription,
            'url' => $data['jobUrl']
        ];
    }
}
