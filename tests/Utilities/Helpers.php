<?php

namespace Tests\Utilities;

trait Helpers {

    /**
     * Formating text for visibility test
     *
     * @param string $text
     * @param string $action
     * @return void
     */
    public function visibilityText(string $text, string $action) : string
    {
        if($action === 'index') {
            return strtoupper($text);
        }

        if($action === 'show') {
            return ucwords($text);
        }

        if($action === 'edit') {
            return ucwords($text);
        }

        if($action === 'create') {
            return ucwords($text);
        }
    }
}
