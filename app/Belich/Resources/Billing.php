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
    public static $icon = 'file-alt';

    /** @var string */
    public static $label = 'Invoice';

    /** @var string */
    public static $pluralLabel = 'Invoices';

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
                ->sortable()
                ->rules('required'),
            Text::make('Billing name', 'billing_name')
                ->sortable()
                ->rules('required'),
            Text::make('N.I.F.', 'billing_nif')
                ->sortable()
                ->rules('required'),
            Text::make('Address', 'billing_address')
                ->sortable()
                ->rules('required'),
            Text::make('Telephone', 'billing_telephone')
                ->sortable()
                ->rules('required'),
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
