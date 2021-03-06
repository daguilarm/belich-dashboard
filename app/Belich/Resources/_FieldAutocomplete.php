<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Autocomplete;
use Illuminate\Http\Request;

class _FieldAutocomplete extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $label = 'Field Autocomplete';

    /** @var string */
    public static string $pluralLabel = 'Fields Autocomplete';

    /**
     * Build the query for the given resource.
     */
    public function indexQuery()
    {
        return $this->model();
    }

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(Request $request): array
    {
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
            Autocomplete::make('Testing authorization', 'test_creditcard')
                ->name('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Autocomplete::make('Testing autofocus', 'test_autofocus')
                ->autofocus(),
        ];
    }

    /**
     * Set the custom metric cards
     */
    public static function metrics(Request $request): array
    {
        return [];
    }

    /**
     * Set the custom cards
     */
    public static function cards(Request $request): array
    {
        return [];
    }
}
