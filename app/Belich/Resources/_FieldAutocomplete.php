<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Autocomplete;
use Daguilarm\Belich\Resources;
use Illuminate\Http\Request;

class _FieldAutocomplete extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Autocomplete';

    /** @var string */
    public static $pluralLabel = 'Fields Autocomplete';

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
    public function fields(Request $request) {
        return [
            // Testing for visibility
            Autocomplete::make('Hide from index', 'test_name')
                ->hideFromIndex(),
            Autocomplete::make('Hide from show', 'test_name')
                ->hideFromShow(),
            Autocomplete::make('Hide when creating', 'test_name')
                ->hideWhenCreating(),
            Autocomplete::make('Hide when editing', 'test_name')
                ->hideWhenEditing(),
            Autocomplete::make('Only on index', 'test_name')
                ->onlyOnIndex(),
            Autocomplete::make('Only on show', 'test_name')
                ->onlyOnShow(),
            Autocomplete::make('Only on forms', 'test_name')
                ->onlyOnForms(),
            Autocomplete::make('Except on forms', 'test_name')
                ->exceptOnForms(),
            Autocomplete::make('Visible-on index', 'test_name')
                ->visibleOn('index'),
            Autocomplete::make('Hide-From index', 'test_name')
                ->hideFrom('index'),
            //Testing for html render
            Autocomplete::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Autocomplete::make('Testing attributes', 'test_name')
                ->addClass('testing-class')
                ->id('testing_id')
                ->name('testing-name')
                ->data('test', 'testing-data')
                ->readonly()
                ->disabled()
                ->dusk('testing-dusk')
                ->defaultValue('testing-value')
                ->help('testing help'),
            //Testing prefix
            Autocomplete::make('Testing prefix', 'test_name')
                ->id('testing_focus')
                ->prefix('***')
                ->suffix('***'),
            //Testing model manipulation
            Autocomplete::make('Testing model manipulation', 'test_name')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Autocomplete::make('Testing result manipulation', 'test_name')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                }),
            //Testing authorization
            Autocomplete::make('Testing authorization', 'test_name')
                ->name('testing_can_see')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Autocomplete::make('Testing authorization', 'test_name')
                ->name('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autocomplete
            Autocomplete::make('Testing autocomplete', 'test_string')
                ->dataFrom(route('dashboard.ajax.example')),
            //Testing autofocus
            Autocomplete::make('Testing autofocus', 'test_autofocus')
                ->dusk('test_autofocus')
                ->autofocus(),
        ];
    }

    /**
     * Set the custom metric cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function metrics(Request $request) {
        return;
    }

    /**
     * Set the custom cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function cards(Request $request) {
        return;
    }
}
