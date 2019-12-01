<?php

namespace Tests\Browser\Fields;

trait Setup {
    /**
     * Field => [except attributes to tests in \Test\Browser\Fields\Attributes\AttributesTest.php]
     * @var array
     */
    protected $fields = [
        'autocompletes' => ['dusk', 'autofocus', 'prefix', 'display'],
        'booleans' => ['addClass', 'autofocus', 'prefix', 'resolve', 'display'],
        'coordenates' => ['prefix', 'resolve', 'display'],
        'countries' => ['dusk', 'autofocus', 'prefix', 'display'],
        'dates' => ['asHtml', 'display', 'prefix', 'resolve'],
        'decimals' => ['display', 'prefix'],
        'files' => ['asHtml', 'autofocus', 'defaultValue', 'display', 'prefix', 'resolve'],
        'numbers' => [],
        'patterns' => [],
        'selects' => ['defaultValue'],
        'texts' => [],
        'textareas' => ['defaultValue', 'prefix', 'resolve', 'display'],
        'years' => [],
    ];

    /**
     * The table name used by each field
     * @var array
     */
    protected $tableName = [
        'numbers' => 'test_number',
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

    /**
     * Set relationship to be evaluated
     *
     * @param string $relationship
     *
     * @return string
     */
    protected static function setRelationship(string $relationship): string
    {
        return '_relationship' . strtolower($relationship) . 's';
    }
}
