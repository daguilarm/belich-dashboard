<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Decimal;
use Illuminate\Http\Request;

class _FieldDecimal extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Decimal';

    /** @var string */
    public static $pluralLabel = 'Fields Decimal';

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
            Decimal::make('Hide from index', 'test_decimal')
                ->hideFromIndex(),
            Decimal::make('Hide from show', 'test_decimal')
                ->hideFromShow(),
            Decimal::make('Hide when creating', 'test_decimal')
                ->hideWhenCreating(),
            Decimal::make('Hide when editing', 'test_decimal')
                ->hideWhenEditing(),
            Decimal::make('Only on index', 'test_decimal')
                ->onlyOnIndex(),
            Decimal::make('Only on show', 'test_decimal')
                ->onlyOnShow(),
            Decimal::make('Only on forms', 'test_decimal')
                ->onlyOnForms(),
            Decimal::make('Except on forms', 'test_decimal')
                ->exceptOnForms(),
            Decimal::make('Visible-on index', 'test_decimal')
                ->visibleOn('index'),
            Decimal::make('Hide-From index', 'test_decimal')
                ->hideFrom('index'),
            //Testing for html render
            Decimal::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Decimal::make('Testing attributes', 'test_decimal')
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
            Decimal::make('Testing prefix', 'test_decimal')
                ->id('testing_focus')
                ->prefix('***')
                ->suffix('***'),
            //Testing model manipulation
            Decimal::make('Testing model manipulation', 'test_decimal')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing authorization
            Decimal::make('Testing authorization', 'test_decimal')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Decimal::make('Testing authorization', 'test_decimal')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Decimal::make('Testing autofocus', 'test_decimal')
                ->dusk('dusk-test_autofocus')
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
