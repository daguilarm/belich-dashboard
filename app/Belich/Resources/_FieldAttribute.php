<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Email;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class _FieldAttribute extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field Attributes';

    /** @var string */
    public static string $pluralLabel = 'Fields Attributes';

    /** @var string */
    public static string $tableTextAlign = 'center';

    /** @var array */
    public static  array $search = ['test_name'];

    /**
     * Build the query for the given resource.
     */
    public function indexQuery()
    {
        return $this->model();
    }

    /**
     * Get the fields displayed by the resource.
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
     */
    public static function metrics(Request $request): array
    {
        return [];
    }

    /**
     * Set the custom cards
     */
    public static function cards(Request $request): array
    {
        return [];
    }
}
