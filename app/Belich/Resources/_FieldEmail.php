<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Email;
use Illuminate\Http\Request;

class _FieldEmail extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Email';

    /** @var string */
    public static $pluralLabel = 'Fields Email';

    /** @var string */
    public static $tableTextAlign = 'center';

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
            //Testing email
            Email::make('Testing email', 'test_email')
                ->id('test_email')
                ->dusk('dusk-test_email'),
            //Testing multiple
            Email::make('Testing email multiple', 'test_email')
                ->id('test_email_multiple')
                ->dusk('dusk-test_email_multiple')
                ->multiple(),
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
