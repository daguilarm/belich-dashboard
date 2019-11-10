<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Facades\Helper;
use Daguilarm\Belich\Fields\Types\Header;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Daguilarm\Belich\Fields\Types\TextArea;
use Illuminate\Http\Request;

class _FieldHeader extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Header';

    /** @var string */
    public static $pluralLabel = 'Fields Header';

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
            // Testing for visibility
            Id::make('Id', 'id'),
            Header::make('Header 1'),
            Text::make('Name', 'test_name'),
            Select::make('Age', 'test_name')
                ->options([]),
            Text::make('Last name', 'test_lastname'),
            Header::make('<h1 class="bg-gray-200 text-gray-700 p-5">' . Helper::icon('envelope-open-text') . ' Header 2</h1>')
                ->asHtml(),
            Text::make('Email', 'test_email'),
            Header::make('Header 3')
                ->color('green'),
            TextArea::make('Address', 'test_address'),
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
