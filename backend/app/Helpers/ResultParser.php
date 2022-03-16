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

    public function getRate()
    {
        return $this->text->firstMatch([
            '£\d* ?- ?£\d*', '£\d*k ?- ?£\d*k', '£\d*k', '£\d*'
        ]);
    }

    public function getLength()
    {
        return $this->text->firstMatch([
            '\d* ?- ?\d* ?months?', '\d* ?months?'
        ]);
    }

    public function getIr35()
    {
        if ($this->text->contains('outside ir35')) {
            return 'Outside';
        }

        if ($this->text->contains('inside ir35')) {
            return 'Inside';
        }

        return null;
    }

    public function getRemote()
    {
        if ($this->text->contains('fully remote')) {
            return 'Fully';
        }

        if ($this->text->containsAny(['part remote', 'partially remote', 'hybrid working'])) {
            return 'Partial';
        }

        return null;
    }
}
