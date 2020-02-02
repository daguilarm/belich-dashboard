<?php

declare(strict_types=1);

namespace App\Belich\Metrics\Testing;

use App\User;
use Daguilarm\Belich\Components\Metrics\Eloquent\Connection;
use Daguilarm\Belich\Components\Metrics\Graph;
use Daguilarm\Belich\Components\Metrics\Labels;
use Illuminate\Http\Request;

class TestPie extends Graph {

    /** @var string */
    public string $color = 'orange';

    /** @var bool */
    public string $type = 'pie';

    /** @var string */
    public string $legend_h = 'Users';

    /** @var string */
    public string $legend_v = 'Days';

    /** @var string */
    public string $width = 'w-1/3';

    /** @var bool */
    public bool $withArea = true;

    /**
     * Initialize the metric
     *
     * @return string
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Set the displayable name of the metric.
     *
     * @return string
     */
    public function name(Request $request)
    {
        return $this->name = 'Users per month';
    }

    /**
     * Set the displayable labels
     *
     * @return string
     */
    public function labels(Request $request) : array
    {
        return Labels::monthsOfTheYearMin('title');
    }

    /**
     * Get the values from storage
     *
     * @return string
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
     *
     * @return string
     */
    public function uriKey() : string
    {
        return 'users-per-month';
    }
}
