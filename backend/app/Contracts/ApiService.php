<?php

namespace App\Contracts;

interface ApiService
{
    public function getResults(array $terms): array;
    public function getFullResult(string $reference): array;
}
