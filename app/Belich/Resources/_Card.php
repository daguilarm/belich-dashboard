<?php

declare(strict_types=1);

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\Hidden;
use Daguilarm\Belich\Fields\Types\ID;
use Daguilarm\Belich\Fields\Types\Password;
use Daguilarm\Belich\Fields\Types\PasswordConfirmation;
use Daguilarm\Belich\Fields\Types\Select;
use Daguilarm\Belich\Fields\Types\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class _Card extends Resources {

    /** @var string */
    public static string $model = '\App\User';

    /** @var bool */
    public static bool $displayInNavigation = true;

    /** @var string */
    public static string $group = 'Components';

    /** @var string */
    public static string $icon = 'user-friends';

    /** @var string */
    public static string $label = 'Card';

    /** @var string */
    public static string $pluralLabel = 'Cards';

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
     */
    public function fields(Request $request): array
    {
        return [
            ID::make('Id')
                ->sortable(),
            Text::make('Name', 'name')
                ->sortable()
                ->rules('required'),
            Text::make('Email', 'email')
                ->autofocus()
                ->rules('required', 'email', Rule::unique('users')->ignore($request->user()->id))
                ->sortable(),
        ];
    }

    /**
     * Set the custom cards
     */
    public static function cards(Request $request): array
    {
        return [
            (new \App\Belich\Cards\Card1Card($request))->width('w-1/3'),
            (new \App\Belich\Cards\Card2Card($request))->width('w-2/3'),
            (new \App\Belich\Cards\Card3Card($request))->width('w-full'),
        ];
    }

    /**
     * Set the custom metrics cards
     */
    public static function metrics(Request $request): array
    {
        return [
            // (new \App\Belich\Metrics\UsersPerMonth($request))->width('w-full'),
            // new \App\Belich\Metrics\UsersPerDay($request),
            // new \App\Belich\Metrics\UsersPerHour($request),
        ];
    }
}
