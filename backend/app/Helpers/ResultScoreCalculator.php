<?php

namespace App\Helpers;

class ResultScoreCalculator
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getScore()
    {
        $score = 10;

        $score += $this->ir35Score();
        $score += $this->remoteScore();
        $score += $this->rateScore();

        return $score;
    }

    private function ir35Score()
    {
        $ir35 = $this->data['ir35'];

        if ($ir35 === null) {
            return -5;
        }

        if ($ir35 === false) {
            return -3;
        }

        return 0;
    }

    private function remoteScore()
    {
        $remote = $this->data['remote'];

        if ($remote === null) {
            return -5;
        }

        if ($remote === false) {
            return -3;
        }

        return 0;
    }

    private function rateScore()
    {
        $minRate = $this->data['min_rate'];

        if ($minRate === null) {
            return -5;
        }

        if ($minRate <= 200) {
            return -3;
        }

        if ($minRate <= 300) {
            return -1;
        }

        return 0;
    }
}
