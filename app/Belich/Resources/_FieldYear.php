<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Year;
use Illuminate\Http\Request;

class _FieldYear extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Year';

    /** @var string */
    public static $pluralLabel = 'Fields Year';

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
            Year::make('Hide from index', 'test_name')
                ->hideFromIndex(),
            Year::make('Hide from show', 'test_name')
                ->hideFromShow(),
            Year::make('Hide when creating', 'test_name')
                ->hideWhenCreating(),
            Year::make('Hide when editing', 'test_name')
                ->hideWhenEditing(),
            Year::make('Only on index', 'test_name')
                ->onlyOnIndex(),
            Year::make('Only on show', 'test_name')
                ->onlyOnShow(),
            Year::make('Only on forms', 'test_name')
                ->onlyOnForms(),
            Year::make('Except on forms', 'test_name')
                ->exceptOnForms(),
            Year::make('Visible-on index', 'test_name')
                ->visibleOn('index'),
            Year::make('Hide-From index', 'test_name')
                ->hideFrom('index'),
            //Testing for html render
            Year::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Year::make('Testing attributes', 'test_name')
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
            Year::make('Testing prefix', 'test_name')
                ->id('testing_focus')
                ->prefix('***')
                ->suffix('***'),
            //Testing model manipulation
            Year::make('Testing model manipulation', 'test_name')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Year::make('Testing result manipulation', 'test_name')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                }),
            //Testing authorization
            Year::make('Testing authorization', 'test_name')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Year::make('Testing authorization', 'test_name')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Year::make('Testing autofocus', 'test_autofocus')
                ->id('test_autofocus')
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
