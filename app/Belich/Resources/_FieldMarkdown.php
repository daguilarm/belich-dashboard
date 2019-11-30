<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Id;
use Daguilarm\Belich\Fields\Types\Markdown;
use Illuminate\Http\Request;

class _FieldMarkdown extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Fields';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field Markdown';

    /** @var string */
    public static $pluralLabel = 'Fields Markdown';

    /**
     * Build the query for the given resource.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery()
    {
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
            Id::make('Id', 'id'),
            Markdown::make('Full text', 'test_markdown')
                ->id('full-text')
                ->FullText(),
            // Testing for full text on show
            Markdown::make('Full text on show', 'test_markdown')
                ->id('full-text-show')
                ->FullTextOnShow(),
            // Testing for full text on index
            Markdown::make('Full text on index', 'test_markdown')
                ->id('full-text-index')
                ->showOnIndex()
                ->FullTextOnIndex(),
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
