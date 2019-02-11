<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
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
    public static $label = 'User';

    /** @var string */
    public static $pluralLabel = 'Users';

    /**
     * List of emails from users
     *
     * @var array
     */
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
            Text::make('id', 'id')
                ->rules('required'),
            Text::make('Name', 'name')
                ->sortable()
                ->rules('required'),
            Text::make('Billing name', 'billing_name')
                ->withRelationship('billing'),
            Text::make('email', 'email')
                ->rules('required', 'email')
                ->sortable(),
            Text::make('Telephone', 'billing_telephone')
                ->withRelationship('billing'),
            Text::make('Address', 'billing_address')
                ->withRelationship('billing'),
        ];
    }

    // /**
    //  * Rewriting the default action buttons
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return Illuminate\Support\Collection
    //  */
    // public static function actions(Request $request) {
    //     return;
    // }

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
