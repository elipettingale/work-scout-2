<?php

namespace App\Structs;

class Text
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function firstMatch(array $patterns)
    {
        foreach ($patterns as $pattern) {
            preg_match("/$pattern/i", $this->text, $matches);
            
            if (isset($matches[0])) {
                return $matches[0];
            }
        }
    
        return null;
    }

    public function contains(string $value, bool $strict = false): bool
    {
        if ($strict) {
            return str_contains($this->text, $value);
        }

        return str_contains(strtolower($this->text), strtolower($value));
    }

    public function containsAny(array $values, bool $strict = false): bool
    {
        foreach ($values as $value) {
            if ($this->contains($value, $strict)) {
                return true;
            }
        }

        return false;
    }

    public function containsAtLeast(array $values, $count, bool $strict = false): bool
    {
        $contains = 0;

        foreach ($values as $value) {
            if ($this->contains($value, $strict)) {
                $contains++;
            }
        }

        return $contains >= $count;
    }

    public function __toString(): string
    {
        return $this->text;
    }
}
