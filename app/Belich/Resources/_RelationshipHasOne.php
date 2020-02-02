<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Password;
use Daguilarm\Belich\Fields\Types\Relationships\HasOne;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class _RelationshipHasOne extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\User';

    /** @var array */
    public static array $relationships = ['profile'];

    /** @var string */
    public static string $group = 'Relationships';

    /** @var string */
    public static string $icon = 'cogs';

    /** @var string */
    public static string $label = 'HasOne';

    /** @var string */
    public static string $pluralLabel = 'HasOne (plural)';

    // /** @var string */
    public static string $column = 'profile_address';

    /**
     * Build the query for the given resource.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery() {
        return $this->model();
        // return $this->model()
        //     ->whereId(request()->user()->id);
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
            ID::make('Id'),
            Text::make('User', 'name')
                ->rules('required'),
            Text::make('Email', 'email')
                ->rules('required', 'email'),
            Password::make('Password', 'password')
                ->rules('required'),
            HasOne::make('Profile avatar', 'Profile', 'profile_avatar')
                ->help('Helper test')
                ->rules('required'),
            HasOne::make('Profile address', 'Profile')
                ->rules('required')
                ->searchable()
                ->query(function($query) {
                    return $query
                        ->where('user_id', '>', 10)
                        ->pluck(static::$column, static::$column)
                        ->toArray();
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
