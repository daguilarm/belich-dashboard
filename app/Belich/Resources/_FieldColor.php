<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Color;
use Illuminate\Http\Request;

class _FieldColor extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Color';

    /** @var string */
    public static string $pluralLabel = 'Fields Color';

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
            //Testing color
            Color::make('Testing color', 'test_color')
                ->id('test_color')
                ->dusk('dusk-test_color'),
            //Testing default color
            Color::make('Testing color multiple', 'test_name')
                ->id('test_color_multiple')
                ->dusk('dusk-test_color_multiple')
                ->defaultValue('#e66465'),
            //Testing as color
            Color::make('Testing as color', 'test_color')
                ->id('test_asColor')
                ->dusk('dusk-test_asColor')
                ->asColor(),
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
