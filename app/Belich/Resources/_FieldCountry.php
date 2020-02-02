<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Countries;
use Illuminate\Http\Request;

class _FieldCountry extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Country';

    /** @var string */
    public static string $pluralLabel = 'Fields Countries';

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
            Countries::make('Hide from index', 'test_country')
                ->hideFromIndex(),
            Countries::make('Hide from show', 'test_country')
                ->hideFromShow(),
            Countries::make('Hide when creating', 'test_country')
                ->hideWhenCreating(),
            Countries::make('Hide when editing', 'test_country')
                ->hideWhenEditing(),
            Countries::make('Only on index', 'test_country')
                ->onlyOnIndex(),
            Countries::make('Only on show', 'test_country')
                ->onlyOnShow(),
            Countries::make('Only on forms', 'test_country')
                ->onlyOnForms(),
            Countries::make('Except on forms', 'test_country')
                ->exceptOnForms(),
            Countries::make('Visible-on index', 'test_country')
                ->visibleOn('index'),
            Countries::make('Hide-From index', 'test_country')
                ->hideFrom('index'),
            //Testing for html render
            Countries::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Countries::make('Testing attributes', 'test_country')
                ->addClass('testing-class')
                ->id('testing_id')
                ->name('testing-name')
                ->data('test', 'testing-data')
                ->disabled()
                ->readonly()
                ->defaultValue('testing-value')
                ->help('testing help'),
            //Testing model manipulation
            Countries::make('Testing model manipulation', 'test_country')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Countries::make('Testing result manipulation', 'test_country')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                }),
            //Testing authorization
            Countries::make('Testing authorization', 'test_country')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Countries::make('Testing authorization', 'test_country')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
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
