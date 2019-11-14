<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Boolean;
use Illuminate\Http\Request;

class _FieldBoolean extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var string */
    public static $group = 'Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Boolean';

    /** @var string */
    public static $pluralLabel = 'Fields Boolean';

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
            // Testing for visibility
            Boolean::make('Hide from index', 'test_name')
                ->hideFromIndex(),
            Boolean::make('Hide from show', 'test_name')
                ->hideFromShow(),
            Boolean::make('Hide when creating', 'test_name')
                ->hideWhenCreating(),
            Boolean::make('Hide when editing', 'test_name')
                ->hideWhenEditing(),
            Boolean::make('Only on index', 'test_name')
                ->onlyOnIndex(),
            Boolean::make('Only on show', 'test_name')
                ->onlyOnShow(),
            Boolean::make('Only on forms', 'test_name')
                ->onlyOnForms(),
            Boolean::make('Except on forms', 'test_name')
                ->exceptOnForms(),
            Boolean::make('Visible-on index', 'test_name')
                ->visibleOn('index'),
            Boolean::make('Hide-From index', 'test_name')
                ->hideFrom('index'),
            //Testing for attributes
            Boolean::make('Test boolean', 'test_boolean'),
            Boolean::make('Testing attributes', 'test_name')
                ->id('testing_id')
                ->name('testing-name')
                ->data('test', 'testing-data')
                ->disabled()
                ->readonly()
                ->dusk('testing-dusk')
                ->defaultValue('testing-value')
                ->help('testing help'),
            //Testing authorization
            Boolean::make('Testing authorization see', 'test_name')
                ->id('testing_can_see')
                ->canSee(function($request) {
                    return true;
                }),
            Boolean::make('Testing authorization not see', 'test_name')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            Boolean::make('Testing authorization', 'test_boolean')
                ->id('testing_custom_labels')
                ->trueValue('yes')
                ->falseValue('no'),
            Boolean::make('Test boolean red', 'test_name')
                ->id('boolean-color-red')
                ->color('red'),
            Boolean::make('Test boolean blue', 'test_name')
                ->id('boolean-color-blue')
                ->color('blue'),
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
        return[];
    }
}
