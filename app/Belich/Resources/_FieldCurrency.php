<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Currency;
use Daguilarm\Belich\Fields\Types\ID;
use Illuminate\Http\Request;

class _FieldCurrency extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Currency';

    /** @var string */
    public static string $pluralLabel = 'Fields Currency';

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
            ID::make('ID', 'id'),
            Currency::make('Currency', 'test_decimal')
                ->setLocale('es_ES')
                ->currency('DKK'),
            Currency::make('Currency euro', 'test_decimal')
                ->setLocale('es_ES')
                ->euro(),
            Currency::make('Currency dollar', 'test_decimal')
                ->setLocale('es_ES')
                ->dollar(),
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
