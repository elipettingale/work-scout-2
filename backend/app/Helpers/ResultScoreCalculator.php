<?php

namespace App\Helpers;

use App\Structs\Text;

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
        $score += $this->skillScore();

        return $score > 0 ? $score : 0;
    }

    private function ir35Score()
    {
        $ir35 = $this->data['ir35'];

        if ($ir35 === null) {
            return 0;
        }

        if ($ir35 === false) {
            return -10;
        }

        return 0;
    }

    private function remoteScore()
    {
        $remote = $this->data['remote'];

        if ($remote === null) {
            return 0;
        }

        if ($remote === false) {
            return -2;
        }

        return 0;
    }

    private function rateScore()
    {
        $maxRate = $this->data['max_rate'];

        if ($maxRate === null) {
            return 0;
        }

        if ($maxRate <= 200) {
            return -2;
        }

        return 0;
    }

    private function skillScore()
    {
        $text = new Text($this->data['title'] . $this->data['description']);

        if ($text->containsAny(['c#', 'c++', 'magento', 'python', 'java '])) {
            return -10;
        }

        if ($text->containsAny(['aws'])) {
            return -3;
        }

        if ($text->containsAny(['redux'])) {
            return -1;
        }

        return 0;
    }
}
