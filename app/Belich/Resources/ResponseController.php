<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Image;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class responseController extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\Test';

    /** @var string */
    public static string $group = 'System';

    /** @var string */
    public static string $icon = 'cogs';

    /** @var string */
    public static string $label = 'Response Controller';

    /** @var string */
    public static string $pluralLabel = 'Response Controllers';

    /**
     * @var string
     */
    public static string $controllerAction = '\App\Http\Controllers\TestController';

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
            ID::make('Id'),
            Text::make('User', 'name')
                ->withRelationship('user'),
            Text::make('Email', 'email')
                ->withRelationship('user'),
            Text::make('Address', 'profile_address')
                ->rules('required'),
            Image::make('Avatar', 'profile_avatar')
                ->alt('Testing alt'),
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
