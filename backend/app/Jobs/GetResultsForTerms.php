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
        $service = $this->service;

        $results = cache()->remember('reed:results', 3600, function() use ($service) {
            return $service->getResults($this->terms);
        });
        
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

        $service = $this->service;

        $rawData = cache()->remember("reed:{$reference}", 3600, function() use ($service, $reference) {
            return $service->getFullResult($reference);
        });

        $data = $this->transformer->getData($rawData);
        dd($data);

        $score = 0; // todo: calculate score using $data

        if ($score === 0) {
            return false;
        }

        // todo: save result, scan for keywords

        return true;
    }
}
