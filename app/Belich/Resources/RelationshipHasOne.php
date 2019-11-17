<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Relationships\HasOne;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class RelationshipHasOne extends Resources {

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
    // public static $table = 'profile_address';

    /**
     * Build the query for the given resource.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery() {
        return $this->model()
            ->whereId(request()->user()->id);
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public function fields(Request $request): array
    {
        // ddd(HasOne::make('Profiles', 'Profile', '\App\Profile'));
        return [
            ID::make('Id'),
            Text::make('User', 'name'),
            Text::make('Email', 'email'),
            HasOne::make('Profiles', 'Profile', '\App\Profile')
                ->table('profile_address'),
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
