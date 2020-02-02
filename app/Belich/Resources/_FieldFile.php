<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\File;
use Illuminate\Http\Request;

class _FieldFile extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field File';

    /** @var string */
    public static string $pluralLabel = 'Fields File';

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
            File::make('Hide from index', 'test_name')
                ->hideFromIndex(),
            File::make('Hide from show', 'test_name')
                ->hideFromShow(),
            File::make('Hide when creating', 'test_name')
                ->hideWhenCreating(),
            File::make('Hide when editing', 'test_name')
                ->hideWhenEditing(),
            File::make('Only on index', 'test_name')
                ->onlyOnIndex(),
            File::make('Only on show', 'test_name')
                ->onlyOnShow(),
            File::make('Only on forms', 'test_name')
                ->onlyOnForms(),
            File::make('Except on forms', 'test_name')
                ->exceptOnForms(),
            File::make('Visible-on index', 'test_name')
                ->visibleOn('index'),
            File::make('Hide-From index', 'test_name')
                ->hideFrom('index'),
            //Testing methods
            File::make('File url', 'test_file')
                ->dusk('file-url'),
            File::make('File downloable', 'test_file')
                ->dusk('file-downloable')
                ->link(),
            //Testing for attributes
            File::make('Testing attributes', 'test_name')
                ->addClass('testing-class')
                ->id('testing_id')
                ->name('testing-name')
                ->data('test', 'testing-data')
                ->disabled()
                ->readonly()
                ->multiple()
                ->dusk('testing-dusk')
                ->help('testing help'),
            //Testing authorization
            File::make('Testing authorization', 'test_file')
                ->id('testing_can_see')
                ->canSee(function($request) {
                    return true;
                }),
            File::make('Testing authorization', 'test_file')
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
