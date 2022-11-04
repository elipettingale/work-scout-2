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
        $text = new Text($this->data['title'] . $this->data['description']);
        $score = 0;

        $badSkills = [
            "c#", "c++", "magento", "java ", "java\.", "python", "\.net", "ruby"
        ];

        $neutralSkills = [
            "redux", "react native", "kubernetes", "angular", "next.js", "aws", "angular", "shopify", "typescript"
        ];

        $goodSkills = [
            "laravel", "wordpress", "php", "javascript", "docker", "vue", "react", "sql", "mongo", "html", "css", "rest api", " git "
        ];

        if ($text->contains("react") && $this->getTotalMatchingSkills($text, $goodSkills) === 1) {
            return 0;
        }

        $score += (2 * $this->getTotalMatchingSkills($text, $goodSkills));
        $score += (1 * $this->getTotalMatchingSkills($text, $neutralSkills));
        $score -= (2 * $this->getTotalMatchingSkills($text, $badSkills));

        if ($score > 10) {
            return 10;
        }

        if ($score < 0) {
            return 0;
        }

        return $score;
    }

    private function getTotalMatchingSkills($text, $skills)
    {
        $total = 0;
        $matches = [];

        foreach ($skills as $skill) {
            if ($text->contains($skill)) {
                $matches[] = $skill;
                $total++;
            }
        }

        // dd($matches);

        return $total;
    }
}
