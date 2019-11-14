<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Url;
use Illuminate\Http\Request;

class _FieldUrl extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Url';

    /** @var string */
    public static $pluralLabel = 'Fields Url';

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
            //Testing url
            Url::make('Testing url', 'test_url')
                ->id('test_url')
                ->dusk('dusk-test_url'),
            //Testing url with options
            Url::make('Testing url options', 'test_url')
                ->id('test_url_options')
                ->dusk('dusk-test_url_options')
                ->defaultValue('http://www.laravel.com'),
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
