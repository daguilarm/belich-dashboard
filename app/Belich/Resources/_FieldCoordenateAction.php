<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Coordenates;
use Illuminate\Http\Request;

class _FieldCoordenateAction extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var string */
    public static string $group = 'Action Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Coordenate: action';

    /** @var string */
    public static string $pluralLabel = 'Fields Coordenate: actions';

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
            //Testing for latitude
            Coordenates::make('Testing latitude', 'lat_test_coordenate')
                ->toDegrees('lat'),
            //Testing for longitude
            Coordenates::make('Testing longitude', 'lng_test_coordenate')
                ->toDegrees('lng'),
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
