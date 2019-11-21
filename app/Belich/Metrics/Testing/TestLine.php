<?php

namespace App\Belich\Metrics\Testing;

use App\User;
use Daguilarm\Belich\Components\Metrics\Eloquent\Connection;
use Daguilarm\Belich\Components\Metrics\Graph;
use Daguilarm\Belich\Components\Metrics\Labels;
use Illuminate\Http\Request;

class TestLine extends Graph {

    /** @var string */
    public $color  = 'red';

    /** @var string */
    public $legend_h = 'Legend x';

    /** @var string */
    public $legend_v = 'legend y';

    /** @var string */
    public $type = 'line';

    /** @var string */
    public $width = 'w-1/3';

    /** @var bool */
    public $withArea = true;

    /** @var string ['butt', 'square', 'round'] */
    public $marker = 'round';

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
        return $this->name = 'Testing line graph';
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
        return 'test-metrics-line';
    }
}
