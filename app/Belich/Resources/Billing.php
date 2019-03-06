<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\Autocomplete;
use Daguilarm\Belich\Fields\Types\Boolean;
use Daguilarm\Belich\Fields\Types\Countries;
use Daguilarm\Belich\Fields\Types\Date;
use Daguilarm\Belich\Fields\Types\Header;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Panels;
use Daguilarm\Belich\Fields\Types\RedirectToAction;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Fields\Types\Year;
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
                    ID::make('Id')
                        ->prefix('nº', $space = true),
                    Text::make('Billing name', 'billing_name')
                        ->sortable()
                        ->rules('required'),
                ];
            }),
            Panels::create('Billing Info 2', function() {
                return [
                    Boolean::make('Status 2', 'billing_status')
                        ->sortable(),
                    Text::make('N.I.F. 2', 'billing_nif')
                        ->sortable()
                        ->prefix('nº', $space = true)
                        ->suffix('€', $space = true),
                ];
            }),
            Panels::create('Dates', function() {
                return [
                    Date::make('Date', 'billing_date')
                        ->sortable(),
                    Header::make('Hellow world')
                        ->background('bg-blue')
                        ->color('text-white')
                        ->size('text-lg')
                        ->icon('edit'),
                    Year::make('Year', 'billing_year')
                        ->sortable(),
                ];
            }),
            Panels::create('Country', function() {
                return [
                    Countries::make('Country', 'billing_country')
                        ->sortable(),
                    Autocomplete::make('User name', 'billing_user')
                        ->dataFrom(route('dashboard.ajax.example'))
                        ->addVars(['id' => 2093], ['name' => 'MyName'])
                        ->minChars(3),
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
