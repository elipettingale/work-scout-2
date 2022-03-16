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
        if ($this->text->matchesAny(['£\d*k ?- ?£\d*k', '£\d*k'])) {
            return null;
        }

        $minRate = $this->text->getFirstMatch([
            '£(\d*) ?- ?£\d*', '£(\d*)'
        ]);

        return $minRate ? (int) $minRate : null;
    }

    public function getMaxRate()
    {
        if ($this->text->matchesAny(['£\d*k ?- ?£\d*k', '£\d*k'])) {
            return null;
        }

        $maxRate = $this->text->getFirstMatch([
            '£\d* ?- ?£(\d*)', '£(\d*)'
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
        if ($this->text->contains('outside ir35')) {
            return true;
        }

        if ($this->text->contains('inside ir35')) {
            return false;
        }

        return null;
    }

    public function getRemote()
    {
        if ($this->text->contains('fully remote')) {
            return true;
        }

        if ($this->text->containsAny(['part remote', 'partially remote', 'hybrid working'])) {
            return false;
        }

        return null;
    }
}
