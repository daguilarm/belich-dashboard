<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Resources;
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
            Text::make('visible-On index', 'test_name')
                ->visibleOn('index'),
            Text::make('hide-From index', 'test_name')
                ->hideFrom('index'),
            // Testing for attributes
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
