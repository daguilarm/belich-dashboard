<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Range;
use Illuminate\Http\Request;

class _FieldRange extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Range';

    /** @var string */
    public static $pluralLabel = 'Fields Range';

    /**
     * Build the query for the given resource.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery() {
        return $this->model();
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public function fields(Request $request): array
    {
        return [
            //Testing range
            Range::make('Testing range', 'test_name')
                ->id('test_range')
                ->dusk('dusk-test_range')
                ->min(1)
                ->max(100)
                ->step(10),
            //Testing range with options
            Range::make('Testing range options', 'test_name')
                ->id('test_range_options')
                ->dusk('dusk-test_range_options')
                ->step(10)
                ->options(['0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100']),
        ];
    }

    /**
     * Set the custom metric cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function metrics(Request $request): array
    {
        return [];
    }

    /**
     * Set the custom cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function cards(Request $request): array
    {
        return [];
    }
}
