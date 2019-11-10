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
        'coordenates' => ['prefix', 'resolve', 'display'],
        'countries' => ['dusk', 'autofocus', 'prefix', 'display'],
        'dates' => ['asHtml', 'display', 'prefix', 'resolve'],
        'decimals' => ['display'],
        'files' => ['asHtml', 'autofocus', 'defaultValue', 'display', 'prefix', 'resolve'],
        'texts' => [],
    ];

    /**
     * The table name used by each field
     * @var array
     */
    protected $tableName = [
        'decimals' => 'test_decimal',
        'coordenates' => 'lat_test_coordenate',
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
