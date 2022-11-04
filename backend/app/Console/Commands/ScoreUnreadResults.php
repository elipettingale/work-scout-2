<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Result;
use App\Helpers\ResultScoreCalculator;
use Carbon\Carbon;

class ScoreUnreadResults extends Command
{
    protected $signature = 'app:score-unread-results';

    public function handle()
    {
        $results = Result::query()
            ->get();

        foreach ($results as $result) {
            $scoreCalculator = new ResultScoreCalculator($result->toArray());
            $score = $scoreCalculator->getScore();
            $result->score = $score;

            $this->info($score);

            $result->save();
        }

        return 0;
    }

}
