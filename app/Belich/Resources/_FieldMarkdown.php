<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
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
            // Testing for visibility
            Markdown::make('Hide from index', 'test_markdown'),
            Markdown::make('Hide from show', 'test_markdown')
                ->hideFromShow(),
            Markdown::make('Hide when creating', 'test_markdown')
                ->hideWhenCreating(),
            Markdown::make('Hide when editing', 'test_markdown')
                ->hideWhenEditing(),
            Markdown::make('Only on index', 'test_markdown')
                ->onlyOnIndex(),
            Markdown::make('Only on show', 'test_markdown')
                ->onlyOnShow(),
            Markdown::make('Only on forms', 'test_markdown')
                ->onlyOnForms(),
            Markdown::make('Except on forms', 'test_markdown')
                ->exceptOnForms(),
            Markdown::make('Visible-on index', 'test_markdown')
                ->visibleOn('index'),
            Markdown::make('Hide-From index', 'test_markdown')
                ->hideFrom('index'),
            //Testing for html render
            Markdown::make('Testing attributes: html', 'test_html')
                ->id('testing_asHtml')
                ->asHtml(),
            //Testing for attributes
            Markdown::make('Testing attributes', 'test_name')
                ->addClass('testing-class')
                ->id('testing_id')
                ->name('testing-name')
                ->data('test', 'testing-data')
                ->disabled()
                ->readonly()
                ->dusk('testing-dusk')
                ->help('testing help'),
            //Testing authorization
            Markdown::make('Testing authorization', 'test_name')
                ->id('testing_can_see')
                ->addClass('class1', 'class2')
                ->textAlign('center')
                ->canSee(function($request) {
                    return true;
                }),
            Markdown::make('Testing authorization', 'test_name')
                ->id('testing_cannot_see')
                ->canSee(function($request) {
                    return false;
                }),
            //Testing autofocus
            Markdown::make('Testing autofocus', 'test_autofocus')
                ->id('test_autofocus')
                ->dusk('dusk-test_autofocus')
                ->autofocus(),
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
