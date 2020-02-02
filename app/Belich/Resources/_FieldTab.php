<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Boolean;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Tabs;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Fields\Types\TextArea;
use Illuminate\Http\Request;

class _FieldTab extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Components';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Tab';

    /** @var string */
    public static string $pluralLabel = 'Tabs';

    /** @var bool */
    public static bool $tabs = true;

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
            Tabs::create('Panel 1', function() {
                return [
                    ID::make('Id'),
                    Text::make('Name', 'test_name')
                        ->sortable()
                        ->rules('required'),
                    Boolean::make('Status', 'test_boolean')
                        ->sortable(),
                    Text::make('Email', 'test_email')
                        ->sortable()
                        ->rules('required'),
                ];
            }),
            Tabs::create('Panel 2', function() {
                return [
                    TextArea::make('Address', 'test_address'),
                    Text::make('Zip', 'test_zip')
                        ->sortable()
                        ->rules('required'),
                ];
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
