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
    public static $label = 'Usuario';

    /** @var string */
    public static $pluralLabel = 'Usuarios';

    /** @var string */
    public static $actions = 'default';

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
            Text::make('Facturación', 'billing_name')
                ->withRelationship('billing')
                ->help('this is a help text')
                ->rules('required')
                ->displayUsing(function($value) {
                    return strtolower($value);
                }),
            Text::make('id', 'id')
                ->addClass('text-blue')
                ->dusk('dusk-example')
                ->id('my_example')
                ->rules('required')
                ->data('value', 1)
                ->data('text', 'text')
                ->resolveUsing(function($model) {
                    return $model->id . ' - ' . $model->name;
                }),
            Select::make('Tipo', 'parent_id')
                ->addClass('text-blue')
                ->options([1 => 1, 2 => 2]),
            Text::make('Nombre', 'name')
                ->disabled()
                ->sortable()
                ->help('this is a help text')
                ->rules('required'),
            Text::make('email', 'email')
                ->rules('required', 'email')
                ->defaultValue('damian@damian.com')
                ->sortable()
                ->help('this is a help text'),
            Text::make('Idioma', 'locale')
                ->rules('required')
                ->defaultValue('esT'),
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
