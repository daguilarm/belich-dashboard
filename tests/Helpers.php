<?php

namespace Tests;

trait Helpers {
    /**
     * Set field to be evaluated
     *
     * @param string $field
     *
     * @return string
     */
    protected static function setField(string $field): string
    {
        return '_field' . $field;
    }
}
