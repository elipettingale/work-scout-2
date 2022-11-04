<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Result;
use App\Helpers\ResultScoreCalculator;

class ScoreResult extends Command
{
    protected $signature = 'app:score-result {id}';

    public function handle()
    {
        $id = $this->argument('id');
        $result = Result::findOrFail($id);

        $scoreCalculator = new ResultScoreCalculator($result->toArray());
        $score = $scoreCalculator->getScore();
        $result->score = $score;

        $this->info($score);

        $result->save();

        return 0;
    }
}
