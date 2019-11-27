<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Illuminate\Http\Request;
use \App\Belich\Components\MyField\MyField;

class _FieldCustom extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Custom field';

    /** @var string */
    public static $pluralLabel = 'Custom fields';

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
            //Testing attributes in text
            MyField::make('My custom class', 'test_name', MyField::class),
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
