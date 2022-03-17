<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Result;
use App\Helpers\ResultScoreCalculator;

class ScoreUnreadResults extends Command
{
    protected $signature = 'app:score-unread-results';

    public function handle()
    {
        $results = Result::query()
            ->whereNull('read_at')
            ->get();

        foreach ($results as $result) {
            $scoreCalculator = new ResultScoreCalculator($result->toArray());
            $score = $scoreCalculator->getScore();
            $result->score = $score;

            if ($score === 0) {
                $result->read_at = now();
            }

            $result->save();
        }

        return 0;
    }
}
