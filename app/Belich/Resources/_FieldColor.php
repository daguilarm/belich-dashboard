<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Color;
use Illuminate\Http\Request;

class _FieldColor extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Color';

    /** @var string */
    public static $pluralLabel = 'Fields Color';

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
            //Testing color
            Color::make('Testing color', 'test_color')
                ->id('test_color')
                ->dusk('dusk-test_color'),
            //Testing default color
            Color::make('Testing color multiple', 'test_name')
                ->id('test_color_multiple')
                ->dusk('dusk-test_color_multiple')
                ->defaultValue('#e66465'),
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
