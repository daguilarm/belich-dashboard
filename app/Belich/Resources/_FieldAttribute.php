<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Email;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class _FieldAttribute extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Attributes';

    /** @var string */
    public static $pluralLabel = 'Fields Attributes';

    /** @var string */
    public static $tableTextAlign = 'center';

    /** @var array */
    public static  $search = ['test_name'];

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
            //Testing attributes in text
            Text::make('Testing text', 'test_string')
                ->dusk('testing-text')
                ->placeholder('testing placeholder in text')
                ->pattern('[a-z]{1,15}'),
            //Testing attributes in text
            Email::make('Testing email', 'test_email')
                ->dusk('testing-email')
                ->placeholder('testing placeholder in email')
                ->pattern('[a-z]{1,15}'),
            //Testing attributes in select
            Select::make('Testing select', 'test_string')
                ->dusk('testing-select')
                ->options([])
                ->placeholder('testing placeholder in select')
                ->pattern('[a-z]{1,15}'),
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
