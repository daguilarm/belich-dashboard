<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Password;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class _FieldPassword extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Password';

    /** @var string */
    public static string $pluralLabel = 'Fields Password';

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
            //Testing for name
            Text::make('Testing attributes', 'test_name'),
            //Testing email
            Text::make('email', 'test_email'),
            //Testing password
            Password::make('Password', 'test_password')
                ->autocompleteOn(),
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
