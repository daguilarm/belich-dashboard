<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Pattern;
use Illuminate\Http\Request;

class _FieldPatternAction extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Pattern action';

    /** @var string */
    public static $pluralLabel = 'Fields Pattern action';

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
            //Testing Pattern: date
            Pattern::make('Testing pattern: date', 'test_mask')
                ->id('test_mask_date')
                ->mask('99/99/9999'),
            //Testing Pattern: telephone
            Pattern::make('Testing pattern: telephone', 'test_mask')
                ->id('test_mask_telephone')
                ->mask('(99) 9999-9999'),
            //Testing Pattern: ID (Spain model)
            Pattern::make('Testing pattern: id', 'test_mask')
                ->id('test_mask_id')
                ->mask('999999999-A'),
            //Testing Pattern: serial number
            Pattern::make('Testing pattern: serial number', 'test_mask')
                ->id('test_mask_serial')
                ->mask('SS-SS-SSSS-SS'),
        ];
    }

    /**
     * Set the custom metric cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function metrics(Request $request): array
    {
        return [];
    }

    /**
     * Set the custom cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function cards(Request $request): array
    {
        return [];
    }
}
