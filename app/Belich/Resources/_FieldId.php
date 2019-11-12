<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Facades\Helper;
use Daguilarm\Belich\Fields\Types\ID;
use Illuminate\Http\Request;

class _FieldId extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field ID';

    /** @var string */
    public static $pluralLabel = 'Fields ID';

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
            Id::make('Id', 'id'),
            //Testing model manipulation
            Id::make('Testing model manipulation', 'id')
                ->resolveUsing(function($model) {
                    return 'resolved ' . $model->test_email;
                }),
            //Testing result manipulation
            Id::make('Testing result manipulation', 'id')
                ->displayUsing(function($value) {
                    return strtoupper($value);
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
