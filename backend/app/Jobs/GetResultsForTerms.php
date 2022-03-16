<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Contracts\ApiService;
use App\Contracts\Transformer;
use App\Models\Result;

class GetResultsForTerms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $service;
    private $transformer;
    private $terms;

    public function __construct(ApiService $service, Transformer $transformer, array $terms)
    {
        $this->service = $service;
        $this->transformer = $transformer;
        $this->terms = $terms;
    }

    public function handle()
    {
        $results = $this->service->getResults($this->terms);

        foreach ($results as $data) {
            $this->handleResult($data);
        }
    }

    public function handleResult(array $data)
    {
        $reference = $this->transformer->getReference($data);

        $exists = Result::query()
            ->where('reference', $reference)
            ->exists();

        if ($exists) {
            return false;
        }

        $data = $this->service->getFullResult($reference);
        $transformedData = $this->transformer->getData($data);

        dd($transformedData);

        $score = 0; // todo: calculate score using $data

        if ($score === 0) {
            return false;
        }

        return true;
    }
}
