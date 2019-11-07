<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Date;
use Illuminate\Http\Request;

class _FieldDate extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Date';

    /** @var string */
    public static $pluralLabel = 'Fields Date';

    /** @var string */
    public static $tableTextAlign = 'center';

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
            Date::make('Hide from index', 'test_date')
                ->hideFromIndex(),
            Date::make('Hide from show', 'test_date')
                ->hideFromShow(),
            Date::make('Hide when creating', 'test_date')
                ->hideWhenCreating(),
            Date::make('Hide when editing', 'test_date')
                ->hideWhenEditing(),
            Date::make('Only on index', 'test_date')
                ->onlyOnIndex(),
            Date::make('Only on show', 'test_date')
                ->onlyOnShow(),
            Date::make('Only on forms', 'test_date')
                ->onlyOnForms(),
            Date::make('Except on forms', 'test_date')
                ->exceptOnForms(),
            Date::make('Visible-on index', 'test_date')
                ->visibleOn('index'),
            Date::make('Hide-From index', 'test_date')
                ->hideFrom('index'),
            //Testing for attributes
            Date::make('Testing attributes', 'test_date')
                ->addClass('testing-class')
                ->id('testing_id')
                ->name('testing-name')
                ->data('test', 'testing-data')
                ->disabled()
                ->readonly()
                ->dusk('testing-dusk')
                ->defaultValue('testing-value')
                ->help('testing help'),
            //Testing model manipulation
            Date::make('Testing model manipulation', 'test_date')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing authorization
            Date::make('Testing authorization', 'test_date')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Date::make('Testing authorization', 'test_date')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Date::make('Testing autofocus', 'test_date')
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
