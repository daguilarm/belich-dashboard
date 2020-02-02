<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Coordenates;
use Illuminate\Http\Request;

class _FieldCoordenate extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Coordenates';

    /** @var string */
    public static string $pluralLabel = 'Fields Coordenates';

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
            Coordenates::make('Hide from index', 'test_name')
                ->hideFromIndex(),
            Coordenates::make('Hide from show', 'test_name')
                ->hideFromShow(),
            Coordenates::make('Hide when creating', 'test_name')
                ->hideWhenCreating(),
            Coordenates::make('Hide when editing', 'test_name')
                ->hideWhenEditing(),
            Coordenates::make('Only on index', 'test_name')
                ->onlyOnIndex(),
            Coordenates::make('Only on show', 'test_name')
                ->onlyOnShow(),
            Coordenates::make('Only on forms', 'test_name')
                ->onlyOnForms(),
            Coordenates::make('Except on forms', 'test_name')
                ->exceptOnForms(),
            Coordenates::make('Visible-on index', 'test_name')
                ->visibleOn('index'),
            Coordenates::make('Hide-From index', 'test_name')
                ->hideFrom('index'),
            //Testing for html render
            Coordenates::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Coordenates::make('Testing attributes', 'test_name')
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
            Coordenates::make('Testing prefix', 'lat_test_coordenate')
                ->id('testing_focus')
                ->prefix('***')
                ->suffix('***'),
            //Testing model manipulation
            Coordenates::make('Testing model manipulation', 'test_name')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Coordenates::make('Testing result manipulation', 'test_name')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                }),
            //Testing authorization
            Coordenates::make('Testing authorization', 'test_name')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Coordenates::make('Testing authorization', 'test_name')
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
