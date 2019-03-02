<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Fields\Types\Boolean;
use Daguilarm\Belich\Fields\Types\ID;
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
            Text::make('Billing name', 'billing_name')
                ->sortable()
                ->rules('required'),
            Boolean::make('Status', 'billing_status')
                ->sortable(),
            Text::make('N.I.F.', 'billing_nif')
                ->sortable()
                ->rules('required'),
            Text::make('Telephone', 'billing_telephone')
                ->sortable()
                ->rules('required'),
            Text::make('Address', 'billing_address')
                ->sortable()
                ->rules('required'),
            TextArea::make('Telephone2', 'billing_telephone')
                ->count(200)
                ->rules('required')
                ->addClass('testing-class')
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
