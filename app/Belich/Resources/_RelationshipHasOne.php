<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Password;
use Daguilarm\Belich\Fields\Types\Relationships\HasOne;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class _RelationshipHasOne extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\User';

    /** @var array */
    public static $relationships = ['profile'];

    /** @var string */
    public static $group = 'Relationships';

    /** @var string */
    public static $icon = 'cogs';

    /** @var string */
    public static $label = 'HasOne';

    /** @var string */
    public static $pluralLabel = 'HasOne (plural)';

    // /** @var string */
    public static $column = 'profile_address';

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
            HasOne::make('Profile avatar', 'Profile', '\App\Profile', 'profile_avatar')
                ->editable()
                ->help('Helper test')
                ->rules('required'),
            HasOne::make('Profile address', 'Profile', '\App\Profile')
                ->rules('required')
                ->editable()
                ->searchable()
                ->query(function($query) {
                    return $query
                        ->where('user_id', '>', 10)
                        ->pluck(static::$column, static::$column)
                        ->toArray();
                }),
            HasOne::make('Profile no editable', 'Profile', '\App\Profile', 'profile_avatar')
                ->id('profile-no-editable')
                ->help('Helper test')
                ->rules('required'),
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
