<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Resources;
use Illuminate\Http\Request;

class Billing extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Models\Billing';

    /** @var bool */
    public static $displayInNavigation = true;

    /** @var string */
    public static $group = 'Facturación';

    /** @var string */
    public static $label = 'Factura';

    /** @var string */
    public static $pluralLabel = 'Facturas';

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
            Text::make('Facturación', 'name')
                ->withRelationship('billing')
                ->sortable()
                ->help('this is a help text')
                ->rules('required'),
            Text::make('id', 'id')
                ->addClass('text-blue')
                ->sortable()
                ->dusk('dusk-example')
                ->id('id-example')
                ->rules('required')
                ->data('value', 1)
                ->data('text', 'text'),
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
