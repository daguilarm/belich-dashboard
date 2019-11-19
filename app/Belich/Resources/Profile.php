<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Image;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class Profile extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Profile';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Personal';

    /** @var string */
    public static $icon = 'cogs';

    /** @var string */
    public static $label = 'Profile';

    /** @var string */
    public static $pluralLabel = 'Profiles';

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
                ->withRelationship('user'),
            Text::make('Email', 'email')
                ->withRelationship('user'),
            Text::make('Address', 'profile_address')
                ->rules('required'),
            Image::make('Avatar', 'profile_avatar')
                ->alt('Testing alt'),
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
