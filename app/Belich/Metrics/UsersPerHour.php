<?php

declare(strict_types=1);

namespace App\Belich\Metrics;

use App\User;
use Daguilarm\Belich\Components\Metrics\Eloquent\Connection;
use Daguilarm\Belich\Components\Metrics\Graph;
use Daguilarm\Belich\Components\Metrics\Labels;
use Illuminate\Http\Request;

class UsersPerHour extends Graph {

    public string $color  = 'red';
    public bool $grid  = false;
    public string $legend_h = 'Users';
    public string $legend_v = 'Hours';
    public string $type = 'bars';
    public string $width = 'w-1/3';
    public bool $withArea = true;

    /**
     * Initialize the metric
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Set the displayable name of the metric.
     */
    public function name(Request $request)
    {
        return $this->name = 'Users per hour';
    }

    /**
     * Set the displayable labels
     */
    public function labels(Request $request) : array
    {
        return Labels::hoursOfTheday();
    }

    /**
     * Get the values from storage
     */
    public function calculate(Request $request) : array
    {
        return Connection::make(User::class)
            ->cacheForEver($this->uriKey())
            ->lastMonth()
            ->totalByHour();
    }

    /**
     * Get the URI key for the metric.
     */
    public function uriKey() : string
    {
        return 'users-per-hour';
    }
}
