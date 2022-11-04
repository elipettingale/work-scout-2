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
use App\Events\ResultCreated;
use App\Helpers\ResultValidator;

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

        $raw = $this->service->getFullResult($reference);
        $data = $this->transformer->getData($raw);

        $result = new Result();
        $result->fill($data);
        $result->raw = $raw;

        if (!ResultValidator::isValid($result)) {
            $result->read_at = now();
        }

        $result->save();

        event(new ResultCreated($result));

        return true;
    }
}
