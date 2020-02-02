<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Illuminate\Http\Request;
use \App\Belich\Components\MyField\MyField;

class _FieldCustom extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Custom field';

    /** @var string */
    public static string $pluralLabel = 'Custom fields';

    /** @var string */
    public static array $search = ['id', 'test_name'];

    /**
     * Build the query for the given resource.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery()
    {
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
            //Testing attributes in text
            MyField::make('My custom class', 'test_name', MyField::class),
            // Testing for visibility
            MyField::make('Hide from index', 'test_name', MyField::class)
                ->hideFromIndex(),
            MyField::make('Hide from show', 'test_name', MyField::class)
                ->hideFromShow(),
            MyField::make('Hide when creating', 'test_name', MyField::class)
                ->hideWhenCreating(),
            MyField::make('Hide when editing', 'test_name', MyField::class)
                ->hideWhenEditing(),
            MyField::make('Only on index', 'test_name', MyField::class)
                ->onlyOnIndex(),
            MyField::make('Only on show', 'test_name', MyField::class)
                ->onlyOnShow(),
            MyField::make('Only on forms', 'test_name', MyField::class)
                ->onlyOnForms(),
            MyField::make('Except on forms', 'test_name', MyField::class)
                ->exceptOnForms(),
            MyField::make('Visible-on index', 'test_name', MyField::class)
                ->visibleOn('index'),
            MyField::make('Hide-From index', 'test_name', MyField::class)
                ->hideFrom('index'),
            MyField::make('Attributes', 'test_name', MyField::class)
                ->id('testing-id')
                ->dusk('testing-dusk')
                ->help('testing-help'),
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
