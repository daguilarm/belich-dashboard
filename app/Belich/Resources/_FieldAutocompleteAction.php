<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Autocomplete;
use Illuminate\Http\Request;

class _FieldAutocompleteAction extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Action Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field: Autocomplete action';

    /** @var string */
    public static string $pluralLabel = 'Fields: Autocomplete actions';

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
            //Testing autocomplete with data store as value
            Autocomplete::make('Testing from ajax', 'test_name')
                ->dataFrom(route('dashboard.ajax.test.name'))
                ->minChars(2),
            //Testing autocomplete with data store as id
            Autocomplete::make('Testing from ajax ID', 'test_string')
                ->dataFrom(route('dashboard.ajax.test.string'))
                ->storeId()
                ->minChars(2),
            //Testing autocomplete
            // Not possible to deal with datalist > option
            // Autocomplete::make('Testing from array', 'test_language')
            //     ->dataFrom([
            //         'c++' => 'C++',
            //         'cobol' => 'Cobol',
            //         'java' => 'Java',
            //         'js' => 'Javascript',
            //         'php' => 'Php',
            //         'python' => 'Python',
            //     ]),
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
