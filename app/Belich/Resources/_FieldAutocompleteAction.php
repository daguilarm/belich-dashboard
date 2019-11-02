<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Autocomplete;
use Daguilarm\Belich\Resources;
use Illuminate\Http\Request;

class _FieldAutocompleteAction extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

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
    public function fields(Request $request) {
        return [
            //Testing autocomplete with ID
            Autocomplete::make('Testing from ajax', 'test_name')
                ->dataFrom(route('dashboard.ajax.example'))
                ->minChars(2),
            //Testing autocomplete with ID
            Autocomplete::make('Testing from ajax ID', 'test_lastname')
                ->dataFrom(route('dashboard.ajax.example'))
                ->storeId()
                ->minChars(2),
            //Testing autocomplete
            Autocomplete::make('Testing from array', 'test_string')
                ->dataFrom([
                    'c++' => 'C++',
                    'cobol' => 'Cobol',
                    'jave' => 'Java',
                    'js' => 'Javascript',
                    'php' => 'Php',
                    'python' => 'Python',
                ]),
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
