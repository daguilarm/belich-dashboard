<?php

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
    public static $model = '\App\Test';

    /** @var string */
    public static $group = 'Components';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Conditional';

    /** @var string */
    public static $pluralLabel = 'Conditionals';

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
            Boolean::make('Boolean', 'test_boolean'),
            Conditional::make('test_boolean', true, function() {
                return [
                    Text::make('Boolean test', 'test_email')
                        ->sortable()
                        ->autocompleteOn()
                        ->rules('required'),
                ];
            }),
            Select::make('Status', 'test_status')
                ->options(['0' => 'False', '1' => 'True']),
            Conditional::make('test_status', true, function() {
                return [
                    Text::make('Status test', 'test_email')
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
