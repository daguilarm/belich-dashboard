<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\TextArea;
use Illuminate\Http\Request;

class _FieldTextAreaAction extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Action Fields';

    /** @var string */
    public static string $icon = 'vial';

    /** @var string */
    public static string $label = 'Field TextArea: action';

    /** @var string */
    public static string $pluralLabel = 'Fields TextArea: actions';

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
            // On index and show
            // Testing for full limit text
            TextArea::make('Limit text', 'test_description')
                ->id('limit-text'),
            // Testing for full text
            TextArea::make('Full text', 'test_description')
                ->id('full-text')
                ->FullText(),
            // Testing for full text on show
            TextArea::make('Full text on show', 'test_description')
                ->id('full-text-show')
                ->FullTextOnShow(),
            // Testing for full text on index
            TextArea::make('Full text on index', 'test_description')
                ->id('full-text-index')
                ->FullTextOnIndex(),
            // On Create
            // Testing attributes
            TextArea::make('Full text', 'test_description')
                ->id('full-attributes')
                ->maxlength(100)
                ->count(100)
                ->rows(10),
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
