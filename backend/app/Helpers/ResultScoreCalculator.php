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
        $score = $this->skillScore();

        $score += $this->ir35Score();
        $score += $this->remoteScore();
        $score += $this->rateScore();

        return $score > 0 ? $score : 0;
    }

    private function ir35Score()
    {
        $ir35 = $this->data['ir35'];

        if ($ir35 === false) {
            return -2;
        }

        return 0;
    }

    private function remoteScore()
    {
        $remote = $this->data['remote'];

        if ($remote === false) {
            return -2;
        }

        return 0;
    }

    private function rateScore()
    {
        $maxRate = $this->data['max_rate'];

        if ($maxRate <= 200) {
            return -2;
        }

        return 0;
    }

    private function skillScore()
    {
        $total = 0;
        $matched = 0;

        $badSkills = [
            "c#", "c++", "magento", "java ", "java\.", "python", "\.net", "ruby"
        ];

        $neutralSkills = [
            "redux", "react native", "kubernetes", "angular", "next.js", "aws", "angular", "shopify"
        ];

        $goodSkills = [
            "laravel", "wordpress", "php", "javascript", "docker", "vue", "react", "sql", "mongo"
        ];

        $text = new Text($this->data['title'] . $this->data['description']);

        foreach ($badSkills as $skill) {
            if ($text->contains($skill)) {
                $total -= 10;
                $matched++;
                $test[] = $skill;
            }
        }

        foreach ($neutralSkills as $skill) {
            if ($text->contains($skill)) {
                $matched++;
                $test[] = $skill;
            }
        }

        foreach ($goodSkills as $skill) {
            if ($text->contains($skill)) {
                $total += 10;
                $matched++;
                $test[] = $skill;
            }
        }

        if ($matched === 0) {
            return 0;
        }

        return ceil($total / $matched);
    }
}
