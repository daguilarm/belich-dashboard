<?php

namespace Tests\Browser\Fields;

trait Setup {
    /**
     * Field => [except attributes to tests in \Test\Browser\Fields\Attributes\AttributesTest.php]
     * @var array
     */
    protected $fields = [
        'autocompletes' => ['dusk', 'autofocus'],
        'booleans' => ['addClass', 'autofocus', 'prefix', 'resolve', 'display'],
        'coordenates' => [],
        'countries' => ['dusk', 'autofocus', 'prefix', 'display'],
        'texts' => [],
    ];

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
