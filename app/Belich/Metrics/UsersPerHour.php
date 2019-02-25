<?php

namespace App\Belich\Metrics;

use App\User;
use Daguilarm\Belich\Components\Metrics\Eloquent\Connection;
use Daguilarm\Belich\Components\Metrics\Graph;
use Daguilarm\Belich\Components\Metrics\Labels;
use Illuminate\Http\Request;

class UsersPerHour extends Graph {

    /** @var string */
    public $color  = 'red';

    /** @var string */
    public $grid  = false;

    /** @var string */
    public $legend_h = 'Users';

    /** @var string */
    public $legend_v = 'Hours';

    /** @var string */
    public $type = 'bars';

    /** @var string */
    public $width = 'w-1/3';

    /** @var bool */
    public $withArea = true;

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
        return $this->name = 'Users per hour';
    }

    /**
     * Set the displayable labels
     *
     * @return string
     */
    public function labels(Request $request) : array
    {
        return Labels::hoursOfTheday();
    }

    /**
     * Get the values from storage
     *
     * @return string
     */
    public function calculate(Request $request) : array
    {
        return Connection::make(User::class)
            ->thisMonth()
            ->totalByHour();
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'users-per-hour';
    }
}
