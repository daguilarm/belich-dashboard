<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Autocomplete;
use Illuminate\Http\Request;

class _FieldAutocompleteAction extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Action Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field: Autocomplete action';

    /** @var string */
    public static $pluralLabel = 'Fields: Autocomplete actions';

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
