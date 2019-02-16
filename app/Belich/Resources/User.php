<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Fields\Types\Password;
use Daguilarm\Belich\Fields\Types\PasswordConfirmation;
use Daguilarm\Belich\Resources;
use Illuminate\Http\Request;

class User extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Models\User';

    /** @var array */
    public static $relationships = ['billing'];

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
        $this->selectNames = \App\Models\User::pluck('name', 'name')->toArray();
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
    public function fields(Request $request) {
        return [
            ID::make('Id'),
            Text::make('Name', 'name')
                ->sortable()
                ->rules('required'),
            Text::make('Billing name', 'billing_name')
                ->withRelationship('billing'),
            Text::make('Email', 'email')
                ->rules('required', 'email', 'unique:users,email')
                ->sortable(),
            Password::make('Password', 'password')
                ->creationRules('required', 'required_with:password_confirmation', 'confirmed', 'min:6')
                ->updateRules('nullable', 'required_with:password_confirmation', 'same:password_confirmation', 'min:6')
                ->onlyOnForms(),
            PasswordConfirmation::make('Password confirmation'),
            Text::make('Telephone', 'billing_telephone')
                ->withRelationship('billing'),
            Text::make('Address', 'billing_address')
                ->withRelationship('billing'),
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
