<?php

namespace App\Contracts;

interface Transformer 
{
    public function getReference(array $data): string;
    public function getData(array $data): array;
}
