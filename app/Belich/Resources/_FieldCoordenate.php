<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Coordenates;
use Daguilarm\Belich\Resources;
use Illuminate\Http\Request;

class _FieldCoordenate extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Coordenates';

    /** @var string */
    public static $pluralLabel = 'Fields Coordenates';

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
            Coordenates::make('Hide from index', 'test_coordenate')
                ->hideFromIndex(),
            Coordenates::make('Hide from show', 'test_coordenate')
                ->hideFromShow(),
            Coordenates::make('Hide when creating', 'test_coordenate')
                ->hideWhenCreating(),
            Coordenates::make('Hide when editing', 'test_coordenate')
                ->hideWhenEditing(),
            Coordenates::make('Only on index', 'test_coordenate')
                ->onlyOnIndex(),
            Coordenates::make('Only on show', 'test_coordenate')
                ->onlyOnShow(),
            Coordenates::make('Only on forms', 'test_coordenate')
                ->onlyOnForms(),
            Coordenates::make('Except on forms', 'test_coordenate')
                ->exceptOnForms(),
            Coordenates::make('Visible-on index', 'test_coordenate')
                ->visibleOn('index'),
            Coordenates::make('Hide-From index', 'test_coordenate')
                ->hideFrom('index'),
            //Testing for html render
            Coordenates::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Coordenates::make('Testing attributes', 'test_coordenate')
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
            Coordenates::make('Testing prefix', 'test_coordenate')
                ->id('testing_focus')
                ->prefix('***')
                ->suffix('***'),
            //Testing model manipulation
            Coordenates::make('Testing model manipulation', 'test_coordenate')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Coordenates::make('Testing result manipulation', 'test_coordenate')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                }),
            //Testing authorization
            Coordenates::make('Testing authorization', 'test_coordenate')
                ->id('testing_can_see')
                ->canSee(function($request) {
                    return true;
                }),
            Coordenates::make('Testing authorization', 'test_coordenate')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Coordenates::make('Testing autofocus', 'test_autofocus')
                ->id('test_autofocus')
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
