<?php

declare(strict_types=1);

namespace App\Belich\Metrics\Testing;

use App\User;
use Daguilarm\Belich\Components\Metrics\Eloquent\Connection;
use Daguilarm\Belich\Components\Metrics\Graph;
use Daguilarm\Belich\Components\Metrics\Labels;
use Illuminate\Http\Request;

class TestLegend extends Graph {

    /** @var string */
    public string $color  = 'teal';

    /** @var string */
    public string $legend_h = 'Text x';

    /** @var string */
    public string $legend_v = 'Text y';

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
        return $this->name = 'Testing legend';
    }

    /**
     * Get the values from storage
     *
     * @return string
     */
    public function labels(Request $request) : array
    {
        return Labels::daysOfTheMonth();
    }

    /**
     * Set the displayable labels
     *
     * @return string
     */
    public function calculate(Request $request) : array
    {
        return Connection::make(User::class)
            ->cacheInMinutes(10, $this->uriKey())
            ->lastMonth()
            ->totalByDay();
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey() : string
    {
        return 'test-metrics-legend';
    }
}
