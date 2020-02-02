<?php

declare(strict_types=1);

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
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Header';

    /** @var string */
    public static string $pluralLabel = 'Fields Header';

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
            Header::make('<h1 class="bg-gray-800 text-white p-5">' . Helper::icon('envelope-open-text', '', 'icon') . ' Header 2</h1>')
                ->asHtml(),
            Text::make('Email', 'test_email'),
            Header::make('Header 3')
                ->background('green-200')
                ->color('green-500'),
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
