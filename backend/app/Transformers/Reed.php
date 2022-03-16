<?php

namespace App\Transformers;

use App\Contracts\Transformer;
use App\Enums\JobSite;

class Reed implements Transformer 
{
    public function getReference(array $data): string
    {
        return $data['jobId'];
    }

    public function getData(array $data): array 
    {
        return [
            'job_site' => JobSite::REED,
            'reference' => $data['jobId'],
            'title' => $data['jobTitle'],
            'rate' => null,
            'length' => null,
            'ir35' => null,
            'remote' => null,
            'description' => null
        ];
    }
}

// todo: use clever text lookups to confirm data integrity
