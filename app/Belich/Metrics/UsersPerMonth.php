<?php

declare(strict_types=1);

namespace App\Belich\Metrics;

use App\User;
use Daguilarm\Belich\Components\Metrics\Eloquent\Connection;
use Daguilarm\Belich\Components\Metrics\Graph;
use Daguilarm\Belich\Components\Metrics\Labels;
use Illuminate\Http\Request;

class UsersPerMonth extends Graph {

    public string $color = 'orange';
    public string $type = 'pie';
    public string $legend_h = 'Users';
    public string $legend_v = 'Days';
    public string $width = 'w-1/3';
    public bool $withArea = true;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Set the displayable name of the metric.
     */
    public function name(Request $request)
    {
        return $this->name = 'Users per month';
    }

    /**
     * Set the displayable labels
     */
    public function labels(Request $request) : array
    {
        return Labels::monthsOfTheYearMin('title');
    }

    /**
     * Get the values from storage
     */
    public function calculate(Request $request) : array
    {
        return Connection::make(User::class)
            ->cacheInMinutes(10, $this->uriKey())
            ->lastYear()
            ->totalByMonth();
    }

    /**
     * Get the URI key for the metric.
     */
    public function uriKey() : string
    {
        return 'users-per-month';
    }
}
