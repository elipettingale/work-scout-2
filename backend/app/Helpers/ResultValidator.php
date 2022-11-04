<?php

namespace App\Helpers;

use App\Models\Result;
use App\Structs\Text;

class ResultValidator
{
    public static function isValid(Result $result)
    {
        $title = new Text($result->title);

        $keySkills = [
            "developer", "software", "full-stack", "full stack", "fullstack", "backend", "back end", "back-end", "frontend", "front end", "front-end", "laravel", "php", "javascript", "react", "vue", "docker", "react", "mongo", "node"
        ];

        if ($title->containsAny($keySkills)) {
            return true;
        }

        return false;
    }
}
