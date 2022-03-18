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
            $date = Carbon::createFromFormat('d/m/Y', $result->raw['datePosted']);
            $result->created_at = $date;

            if ($date->format('Y-m-d') >= now()->subWeek()->format('Y-m-d')) {
                $result->read_at = null;
            }

            if ($result->score === 0) {
                $result->read_at = now();
            }

            $result->save();
        }

        return 0;
    }

}
