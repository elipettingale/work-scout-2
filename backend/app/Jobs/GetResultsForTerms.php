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
        // todo: use service to get all results
        // todo: for each result use service to get details
        // todo: use transformer to transform details
        // todo: calculate ratings for result
        // todo: if rating is not 0 save result in db
    }
}
