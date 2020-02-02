<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Boolean;
use Daguilarm\Belich\Fields\Types\Conditional;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Panels;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Fields\Types\TextArea;
use Illuminate\Http\Request;

class _Conditional extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var string */
    public static string $group = 'Components';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Conditional';

    /** @var string */
    public static string $pluralLabel = 'Conditionals';

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
            Boolean::make('Boolean', 'test_boolean'),
            Conditional::make(function() {
                return [
                    Text::make('Boolean test', 'test_email')
                        ->sortable()
                        ->autocompleteOn()
                        ->rules('required'),
                ];
            })->dependsOn('test_boolean', true),
            Select::make('Status', 'test_status')
                ->options(['0' => 'False', '1' => 'True']),
            Conditional::make(function() {
                return [
                    Text::make('Status test', 'test_address')
                        ->sortable()
                        ->rules('required'),
                ];
            })->dependsOn('test_status', true),
            Text::make('Status', 'test_house'),
            Conditional::make(function() {
                return [
                    Text::make('Status test', 'test_address')
                        ->rules('required'),
                ];
            })->dependsOn('test_house', true),
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
