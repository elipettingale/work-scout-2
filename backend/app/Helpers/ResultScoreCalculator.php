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
            return -3;
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
            return -3;
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

    private function skillScore()
    {
        $skills = [
            'laravel',
            'wordpress',
            'vue',
            'php',
            'developer',
            'backend',
            'react',
            'frontend',
            'mysql'
        ];

        $text = new Text($this->data['title'] . $this->data['description']);

        if ($text->containsAny(['c#', 'c++', 'magento'])) {
            return -5;
        }

        if ($text->containsAtLeast($skills, 3)) {
            return 0;
        }

        return -3;
    }
}
