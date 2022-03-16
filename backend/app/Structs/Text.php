<?php

namespace App\Structs;

class Text
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getFirstMatch(array $patterns)
    {
        foreach ($patterns as $pattern) {
            preg_match("/$pattern/i", $this->text, $matches);
            
            if (isset($matches[1])) {
                return $matches[1];
            }
        }
    
        return null;
    }

    public function matches($pattern)
    {
        return preg_match("/$pattern/i", $this->text);
    }
    
    public function matchesAny(array $patterns)
    {
        foreach ($patterns as $pattern) {
            if (preg_match("/$pattern/i", $this->text)) {
                return true;
            }
        }

        return false;
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
