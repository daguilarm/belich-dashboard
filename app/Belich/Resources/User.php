<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Hidden;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Password;
use Daguilarm\Belich\Fields\Types\PasswordConfirmation;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class User extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\User';

    /** @var array */
    public static $relationships = ['profile'];

    /** @var bool */
    public static $displayInNavigation = true;

    /** @var string */
    public static $group = 'Personal';

    /** @var string */
    public static $icon = 'user-friends';

    /** @var string */
    public static $label = 'User';

    /** @var string */
    public static $pluralLabel = 'Users';

    /** @var bool */
    public static $downloable = true;

    /** @var array */
    public static  $search = ['id', 'name', 'email'];

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
            ID::make('Id')
                ->sortable(),
            Text::make('Name', 'name')
                ->sortable()
                ->rules('required'),
            Hidden::make('HiddenFieldExample', 'name_hidden')
                ->defaultValue(10),
            Text::make('Email', 'email')
                ->autofocus()
                ->rules('required', 'email', Rule::unique('users')->ignore($request->user()->id))
                ->sortable(),
            Text::make('Avatar', 'profile_avatar')
                ->withRelationship('profile'),
            Select::make('Role', 'role')
                ->options(static::roles())
                ->displayUsingLabels(),
            Password::make('Password', 'password')
                ->creationRules('required', 'required_with:password_confirmation', 'confirmed', 'min:6')
                ->updateRules('nullable', 'required_with:password_confirmation', 'same:password_confirmation', 'min:6')
                ->autocompleteOn(),
            PasswordConfirmation::make('Password confirmation')
                ->autocompleteOn(),
        ];
    }

    /**
     * Set the custom cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function cards(Request $request): array
    {
        return [
            (new \App\Belich\Cards\UserCard($request)),
        ];
    }

    /**
     * Set the custom metrics cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function metrics(Request $request): array
    {
        return [
            new \App\Belich\Metrics\UsersPerMonth($request),
            new \App\Belich\Metrics\UsersPerDay($request),
            new \App\Belich\Metrics\UsersPerHour($request),
        ];
    }

    /**
     * Set the custom metrics cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function filters(Request $request): array
    {
        return [
            Select::make('By Role', 'role')
                ->options(static::roles()),
            Select::make('By ID', 'id')
                ->filter('operations')
                ->options([
                    '0-10' => '0-10',
                    '11-30' => '11-30',
                    '31-50' => '31-50',
                    '>50' => '>50',
                ]),
        ];
    }

    /**
     * Set the roles
     *
     * @return array
     */
    private static function roles(): array
    {
        return [
            'user' => 'user',
            'manager' => 'manager',
            'admin' => 'admin'
        ];
    }
}
