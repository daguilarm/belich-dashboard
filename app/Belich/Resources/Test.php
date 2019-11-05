<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class Test extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Test';

    /** @var string */
    public static $pluralLabel = 'Tests';

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
            //Testing for attributes
            Text::make('Testing attributes', 'test_name')
                ->addClass('testing-class1', 'testing-class2')
                ->id('testing_id')
                ->name('testing-name')
                ->data('test', 'testing-data')
                ->dusk('testing-dusk')
                ->defaultValue('testing-value')
                ->help('testing help'),
            Text::make('Testing disabled', 'test_string')
                ->addClass('testing-class')
                ->id('testing_id')
                ->name('testing-name')
                ->disabled(),
            Text::make('Testing readonly', 'test_lastname')
                ->addClass('testing-class')
                ->id('testing_id')
                ->name('testing-name')
                ->readonly(),
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
