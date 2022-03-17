<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Result;
use App\Events\ResultCreated;

class BroadcastResultCreated extends Command
{
    protected $signature = 'app:broadcast-result-created {id}';

    public function handle()
    {
        $id = $this->argument('id');
        $result = Result::findOrFail($id);

        event(new ResultCreated($result));

        return 0;
    }
}
