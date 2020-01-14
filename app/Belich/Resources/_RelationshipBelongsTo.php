<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Image;
use Daguilarm\Belich\Fields\Types\Relationships\BelongsTo;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class _RelationshipBelongsTo extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Profile';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Relationships';

    /** @var string */
    public static $icon = 'cogs';

    /** @var string */
    public static $label = 'BelongsTo';

    /** @var string */
    public static $pluralLabel = 'BelongsTo (plural)';

    /**
     * Build the query for the given resource.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery() {
        return $this->model();
            // ->whereId(request()->user()->id);
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
            ID::make('Id'),
            Text::make('Address', 'profile_address')
                ->rules('required'),
            BelongsTo::make('User', 'User', 'name'),
            // BelongsTo::make('User', 'User', 'name')
            //     ->searchable(),
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
