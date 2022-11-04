<?php

namespace App\Console\Commands;

use App\Helpers\ResultValidator;
use App\Models\Result;
use Illuminate\Console\Command;

class ValidateResult extends Command
{
    protected $signature = 'app:validate-result {id}';

    public function handle()
    {
        $result = Result::findOrFail($this->argument('id'));

        $isValid = ResultValidator::isValid($result);

        if (!$isValid) {
            $this->info("invalid");
            $result->read_at = now();
        } else {
            $this->info("valid");
            $result->read_at = null;
        }

        $result->save();

        return 0;
    }
}
