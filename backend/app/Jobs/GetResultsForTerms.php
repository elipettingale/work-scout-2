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
use App\Helpers\ResultScoreCalculator;

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

        $scoreCalculator = new ResultScoreCalculator($data);
        $score = $scoreCalculator->getScore();

        // todo: rate skills

        dd($score);

        // todo: save result, scan for keywords
        // todo: if score is 0, then mark as read (and don't broadcast event)
        // todo: broadcast new result

        return true;
    }
}
