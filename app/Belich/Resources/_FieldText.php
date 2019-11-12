<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class _FieldText extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Text';

    /** @var string */
    public static $pluralLabel = 'Fields Text';

    /** @var string */
    public static $tableTextAlign = 'center';

    /** @var array */
    public static  $search = ['test_name'];

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
            Text::make('Hide from index', 'test_name')
                ->hideFromIndex(),
            Text::make('Hide from show', 'test_name')
                ->hideFromShow(),
            Text::make('Hide when creating', 'test_name')
                ->hideWhenCreating(),
            Text::make('Hide when editing', 'test_name')
                ->hideWhenEditing(),
            Text::make('Only on index', 'test_name')
                ->onlyOnIndex(),
            Text::make('Only on show', 'test_name')
                ->onlyOnShow(),
            Text::make('Only on forms', 'test_name')
                ->onlyOnForms(),
            Text::make('Except on forms', 'test_name')
                ->exceptOnForms(),
            Text::make('Visible-on index', 'test_name')
                ->visibleOn('index'),
            Text::make('Hide-From index', 'test_name')
                ->hideFrom('index'),
            //Testing for html render
            Text::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Text::make('Testing attributes', 'test_name')
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
            Text::make('Testing prefix', 'test_name')
                ->id('testing_focus')
                ->prefix('***')
                ->suffix('***'),
            //Testing model manipulation
            Text::make('Testing model manipulation', 'test_name')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Text::make('Testing result manipulation', 'test_name')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                }),
            //Testing authorization
            Text::make('Testing authorization', 'test_name')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Text::make('Testing authorization', 'test_name')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Text::make('Testing autofocus', 'test_autofocus')
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
