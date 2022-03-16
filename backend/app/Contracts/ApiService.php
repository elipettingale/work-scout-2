<?php

namespace App\Contracts;

interface ApiService
{
    public function getSearchResults(array $terms): array;
    public function getResultDetails(string $id): array;
}
