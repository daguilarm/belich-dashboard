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

class _Graph extends Resources {

    /** @var string [Model path] */
    public static string $model = '\App\User';

    /** @var bool */
    public static bool $displayInNavigation = true;

    /** @var string */
    public static string $group = 'Metrics';

    /** @var string */
    public static string $icon = 'user-friends';

    /** @var string */
    public static string $label = 'Graph';

    /** @var string */
    public static string $pluralLabel = 'Graphs';

    /** @var array */
    public static array $search = ['id', 'name', 'email'];

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function cards(Request $request): array
    {
        return [
            // (new \App\Belich\Cards\UserCard($request)),
        ];
    }

    /**
     * Set the custom metrics cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function metrics(Request $request): array
    {
        return [
            new \App\Belich\Metrics\Testing\TestDefault($request),
            new \App\Belich\Metrics\Testing\TestLegend($request),
            new \App\Belich\Metrics\Testing\TestBarLegend($request),
            new \App\Belich\Metrics\Testing\TestPie($request),
            (new \App\Belich\Metrics\Testing\TestLine($request))->width('w-full'),
        ];
    }
}
