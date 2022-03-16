<?php

namespace App\Contracts;

interface Transformer 
{
    public function transform(array $data): array;
}
