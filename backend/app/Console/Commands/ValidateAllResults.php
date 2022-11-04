<?php

namespace App\Console\Commands;

use App\Helpers\ResultValidator;
use App\Models\Result;
use Illuminate\Console\Command;

class ValidateAllResults extends Command
{
    protected $signature = 'app:validate-all-results';

    public function handle()
    {
        $results = Result::all();

        foreach ($results as $result) {
            if (!ResultValidator::isValid($result)) {
                $result->read_at = now();
            } else {
                $result->read_at = null;
            }

            $result->save();
        }

        return 0;
    }
}
