<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Image;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;

class Profile extends Resources {

    /** @var string */
    public static string $model = '\App\Profile';

    /** @var array */
    public static array $relationships = ['user'];

    /** @var string */
    public static string $group = 'Personal';

    /** @var string */
    public static string $icon = 'cogs';

    /** @var string */
    public static string $label = 'Profile';

    /** @var string */
    public static string $pluralLabel = 'Profiles';

    /**
     * Build the query for the given resource.
     */
    public function indexQuery()
    {
        return $this->model();
            // ->whereId(request()->user()->id);
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
