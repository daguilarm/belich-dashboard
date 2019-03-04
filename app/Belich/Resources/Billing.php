<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\Boolean;
use Daguilarm\Belich\Fields\Types\Coordenates;
use Daguilarm\Belich\Fields\Types\Decimal;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Number;
use Daguilarm\Belich\Fields\Types\Panels;
use Daguilarm\Belich\Fields\Types\RedirectToAction;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Fields\Types\TextArea;
use Daguilarm\Belich\Resources;
use Illuminate\Http\Request;

class Billing extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Billing';

    /** @var bool */
    public static $accessToResource = true;

    /** @var bool */
    public static $displayInNavigation = true;

    /** @var bool */
    public static $downloable = true;

    /** @var string */
    public static $icon = 'file-alt';

    /** @var string */
    public static $label = 'Invoice';

    /** @var string */
    public static $pluralLabel = 'Invoices';

    /** @var string */
    public static $redirectTo = 'index';

    /** @var bool */
    public static $tabs = true;

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
            Panels::create('Billing Info', function() {
                return [
                    ID::make('Id'),
                    Text::make('Billing name', 'billing_name')
                        ->sortable()
                        ->rules('required'),
                ];
            }),
            Panels::create('Billing Info 2', function() {
                return [
                    Boolean::make('Status 2', 'billing_status')
                        ->sortable(),
                    Number::make('N.I.F. 2', 'billing_nif')
                        ->sortable()
                        ->toString(),
                ];
            }),
            Panels::create('Billing Info 3', function() {
                return [
                    Coordenates::make('Position', 'position')
                        ->sortable(),
                ];
            }),
        ];
    }

    /**
     * Set the custom metric cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function metrics(Request $request) {
        return;
    }

    /**
     * Set the custom cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function cards(Request $request) {
        return;
    }
}
