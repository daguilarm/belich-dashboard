<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Resources;
use Illuminate\Http\Request;

class Profile extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Profile';

    /** @var array */
    public static $relationships = ['user'];

    /** @var bool */
    public static $displayInNavigation = true;

    /** @var string */
    public static $group = 'Personal';

    /** @var string */
    public static $icon = 'cogs';

    /** @var string */
    public static $label = 'Profile';

    /** @var string */
    public static $pluralLabel = 'Profiles';

    /** @var array */
    protected $selectNames;

    /**
     * Generate constructor for the resource
     *
     * @return void
     */
    public function __construct()
    {
        //Getting data from storage to populate the field
        $this->selectNames = \App\User::pluck('name', 'name')->toArray();
    }

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
    public function fields(Request $request) {
        return [
            ID::make('Id'),
            Text::make('User', 'name')
                ->withRelationship('user')
                ->data('link', 'http://my.link.com'),
            Text::make('Nick', 'profile_nick')
                ->displayUsing(function($value) {
                    return strtoupper($value);
                })
                ->sortable(),
            Text::make('Avatar', 'profile_avatar')
                ->resolveUsing(function($model) {
                    return $model->id . '-' . $model->profile_avatar;
                }),
            Text::make('Age', 'profile_age')
                ->sortable(),
            Text::make('Locale', 'profile_locale')
                ->sortable(),
        ];
    }

    /**
     * Set the custom metric cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public function metrics(Request $request) {
        return;
    }

    /**
     * Set the custom cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public function cards(Request $request) {
        return;
    }
}
