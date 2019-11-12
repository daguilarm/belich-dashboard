<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\TextArea;
use Illuminate\Http\Request;

class _FieldTextAreaAction extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field TextArea: action';

    /** @var string */
    public static $pluralLabel = 'Fields TextArea: actions';

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
