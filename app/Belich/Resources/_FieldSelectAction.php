<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Select;
use Illuminate\Http\Request;

class _FieldSelectAction extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Action Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Select: action';

    /** @var string */
    public static string $pluralLabel = 'Fields Select: actions';

    /**
     * Generate constructor for the resource
     *
     * @return void
     */
    public function __construct()
    {
        //Getting data from storage to populate the field
        $this->selectNames = \App\User::pluck('name', 'id')->toArray();
    }

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
            //Testing options
            Select::make('Testing options', 'test_string')
                ->id('testing_options')
                ->firstOption()
                ->options([
                    1 => 'Admin',
                    2 => 'Manager',
                    3 => 'User'
                ]),
            //Testing default value
            Select::make('Testing default value', 'test_string')
                ->id('testing_default')
                ->firstOption('No select')
                ->options([
                    1 => 'Admin',
                    2 => 'Manager',
                    3 => 'User'
                ])
                ->defaultValue(2),
            //Testing from DB
            Select::make('Testing DB', 'id')
                ->id('testing_db')
                ->firstOption('default', 0)
                ->options($this->selectNames),
            //Testing display using labels
            Select::make('Role', 'id')
                ->id('testing_labels')
                ->options([
                    1 => 'Admin',
                    2 => 'Manager',
                    3 => 'User'
                ])
                ->displayUsingLabels()
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
