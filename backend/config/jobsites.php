<?php

use App\Enums\JobSite;

return [

    JobSite::REED => [
        'service' => App\Services\Reed::class,
        'transformer' => App\Transformers\Reed::class
    ]

];
