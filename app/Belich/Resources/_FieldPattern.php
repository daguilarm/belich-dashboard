<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Pattern;
use Illuminate\Http\Request;

class _FieldPattern extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Pattern';

    /** @var string */
    public static $pluralLabel = 'Fields Pattern';

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
            Pattern::make('Hide from index', 'test_name')
                ->hideFromIndex(),
            Pattern::make('Hide from show', 'test_name')
                ->hideFromShow(),
            Pattern::make('Hide when creating', 'test_name')
                ->hideWhenCreating(),
            Pattern::make('Hide when editing', 'test_name')
                ->hideWhenEditing(),
            Pattern::make('Only on index', 'test_name')
                ->onlyOnIndex(),
            Pattern::make('Only on show', 'test_name')
                ->onlyOnShow(),
            Pattern::make('Only on forms', 'test_name')
                ->onlyOnForms(),
            Pattern::make('Except on forms', 'test_name')
                ->exceptOnForms(),
            Pattern::make('Visible-on index', 'test_name')
                ->visibleOn('index'),
            Pattern::make('Hide-From index', 'test_name')
                ->hideFrom('index'),
            //Testing for html render
            Pattern::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Pattern::make('Testing attributes', 'test_name')
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
            Pattern::make('Testing prefix', 'test_name')
                ->id('testing_focus')
                ->prefix('***')
                ->suffix('***'),
            //Testing model manipulation
            Pattern::make('Testing model manipulation', 'test_name')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Pattern::make('Testing result manipulation', 'test_name')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                }),
            //Testing authorization
            Pattern::make('Testing authorization', 'test_name')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Pattern::make('Testing authorization', 'test_name')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Pattern::make('Testing autofocus', 'test_autofocus')
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
