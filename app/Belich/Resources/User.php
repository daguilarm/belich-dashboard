<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Filter;
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
            Text::make('Created', 'created_at'),
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
            Filter::make('By Role', 'role')
                ->filterAs('equal')
                ->options(static::roles()),
            Filter::make('By ID', 'id')
                ->filterAs('operations')
                ->options([
                    '0-10' => 'Between 0-10',
                    '11-30' => 'Between 11-30',
                    '31-50' => 'Between 31-50',
                    '>50' => 'Greater than 50',
                    '<15' => 'Minor than 15',
                ]),
            Filter::make('By Name', 'name')
                ->filterAs('like')
                ->options([
                    'a%' => 'Start with a',
                    'd%' => 'Start with d',
                    'm%' => 'Start with m',
                ]),
            Filter::make('By Creation date', 'created_at')
                ->filterAs('date')
                ->format('d/m/Y')
                ->mask('99/99/9999'),
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
            'user' => 'User',
            'manager' => 'Manager',
            'admin' => 'Admin'
        ];
    }
}
