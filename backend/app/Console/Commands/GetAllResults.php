<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GetResultsForTerms;

class GetAllResults extends Command
{
    protected $signature = 'app:get-all-results';

    public function handle()
    {
        foreach (config('jobsites') as $jobSite => $config) {
            foreach (config('search.terms') as $terms) {
                $service = new $config['service'];
                $transformer = new $config['transformer'];
    
                dispatch(new GetResultsForTerms($service, $transformer, $terms));
            }
        }
    }
}
