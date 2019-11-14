<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Number;
use Illuminate\Http\Request;

class _FieldNumber extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field number';

    /** @var string */
    public static $pluralLabel = 'Fields number';

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
            Number::make('Hide from index', 'test_number')
                ->hideFromIndex(),
            Number::make('Hide from show', 'test_number')
                ->hideFromShow(),
            Number::make('Hide when creating', 'test_number')
                ->hideWhenCreating(),
            Number::make('Hide when editing', 'test_number')
                ->hideWhenEditing(),
            Number::make('Only on index', 'test_number')
                ->onlyOnIndex(),
            Number::make('Only on show', 'test_number')
                ->onlyOnShow(),
            Number::make('Only on forms', 'test_number')
                ->onlyOnForms(),
            Number::make('Except on forms', 'test_number')
                ->exceptOnForms(),
            Number::make('Visible-on index', 'test_number')
                ->visibleOn('index'),
            Number::make('Hide-From index', 'test_number')
                ->hideFrom('index'),
            //Testing for html render
            Number::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Number::make('Testing attributes', 'test_number')
                ->addClass('testing-class')
                ->id('testing_id')
                ->name('testing-name')
                ->data('test', 'testing-data')
                ->disabled()
                ->readonly()
                ->dusk('testing-dusk')
                ->defaultValue('testing-value')
                ->help('testing help'),
            //Testing prefix
            Number::make('Testing prefix', 'test_number')
                ->id('testing_focus')
                ->prefix('***')
                ->suffix('***'),
            //Testing model manipulation
            Number::make('Testing model manipulation', 'test_number')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Number::make('Testing result manipulation', 'test_name')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                }),
            //Testing authorization
            Number::make('Testing authorization', 'test_number')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Number::make('Testing authorization', 'test_number')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Number::make('Testing autofocus', 'test_number')
                ->id('test_autofocus')
                ->dusk('dusk-test_autofocus')
                ->min(1)
                ->max(10000)
                ->step(1)
                ->autofocus(),
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
