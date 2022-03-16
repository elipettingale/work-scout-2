<?php

namespace App\Helpers;

use App\Structs\Text;

class ResultParser
{
    private $text;

    public function __construct($text)
    {
        $this->text = new Text($text);
    }

    public function getMinRate()
    {
        if ($this->text->matchesAny(['£\d*k ?- ?£\d*k', '£\d*k', '£\d\d,\d\d\d'])) {
            return null;
        }

        $minRate = $this->text->getFirstMatch([
            '£(\d*) ?- ?£\d*', '£(\d*) ?pd ?- ?£\d* ?pd', '£(\d*)'
        ]);

        return $minRate ? (int) $minRate : null;
    }

    public function getMaxRate()
    {
        if ($this->text->matchesAny(['£\d*k ?- ?£\d*k', '£\d*k', '£\d\d,\d\d\d'])) {
            return null;
        }

        $maxRate = $this->text->getFirstMatch([
            '£\d* ?- ?£(\d*)', '£\d* ?pd ?- ?£(\d*) ?pd', '£(\d*)'
        ]);

        return $maxRate ? (int) $maxRate : null;
    }

    public function getLength()
    {
        $length = $this->text->getFirstMatch([
            '(\d*) ?- ?\d* ?months?', '(\d*) ?months?'
        ]);

        return $length ? (int) $length : null;
    }

    public function getIr35()
    {
        if ($this->text->containsAny(['outside ir35', 'outside of ir35', 'outside of the ir35'])) {
            return true;
        }

        if ($this->text->containsAny(['inside ir35', 'inside of ir35', 'inside of the ir35'])) {
            return false;
        }

        return null;
    }

    public function getRemote()
    {
        if ($this->text->containsAny(['part remote', 'partially remote', 'hybrid working'])) {
            return false;
        }

        if ($this->text->contains('remote')) {
            return true;
        }

        return null;
    }
}
