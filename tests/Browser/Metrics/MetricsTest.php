<?php

namespace Tests\Browser\IndexTable;

use App\Test;
use App\User;
use Daguilarm\Belich\Facades\Helper;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter MetricsTest
class MetricsTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 15)->create();
        $this->field = '_graphs';
    }

    /**
     * Testing default configuration for a metrics
     *
     * dusk --filter test_metric_default
     * @return void
     */
    public function test_metric_default()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                // Assert title
                ->assertSeeIn('@metrics-header-test-metrics-default', 'Testing default values')
                // Assert text-gray-600 is the default color for title
                ->assertSourceHas('<h4 dusk="metrics-header-test-metrics-default" class="text-gray-600 mt-2 px-4 ml-2">Testing default values</h4>')
                // Assert graph default value for type is line
                ->assertSourceHas('graph-line-1ae3ad00de7477db4942ba268ccf314b')
                // Assert not see legend
                ->assertSourceMissing('legend-test-metrics-default')
                // Assert default width is w-1/3
                ->assertSourceHas('<div id="metrics-test-metrics-default" dusk="metrics-test-metrics-default" class="w-1/3');
        });
    }

    /**
     * Testing legend for a metric
     *
     * dusk --filter test_metric_legend
     * @return void
     */
    public function test_metric_legend()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                // Assert title
                ->assertSeeIn('@metrics-header-test-metrics-legend', 'Testing legend')
                // Assert color is teal
                ->assertSourceHas('<h4 dusk="metrics-header-test-metrics-legend" class="text-teal-600 mt-2 px-4 ml-2">Testing legend</h4>')
                // Assert legend is visible
                ->assertSeeIn('@legend-test-metrics-legend', 'Text x')
                ->assertSeeIn('@legend-test-metrics-legend', 'Text y');
        });
    }

    /**
     * Testing area for a line metric
     *
     * dusk --filter test_metric_line_area
     * @return void
     */
    public function test_metric_line_area()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                // Assert metric line has area
                ->assertSourceHas("new Chartist.Line('.test-metrics-line', data_f4ea2d919ab5535c01f2bb68c12b129c, {showArea:true,low:0,});");
        });
    }

    /**
     * Testing width for a metric
     *
     * dusk --filter test_metric_width
     * @return void
     */
    public function test_metric_width()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                // Assert full width from method ->width('w-full')
                ->assertSourceHas('<div id="metrics-test-metrics-line" dusk="metrics-test-metrics-line" class="w-full')
                // Assert default width: w-1/3
                ->assertSourceHas('<div id="metrics-test-metrics-default" dusk="metrics-test-metrics-default" class="w-1/3')
                // Assert width: w-2/3
                ->assertSourceHas('<div id="metrics-test-metrics-bar" dusk="metrics-test-metrics-bar" class="w-2/3');
        });
    }

    /**
     * Testing metric type: line, bars and pie
     *
     * dusk --filter test_metric_type
     * @return void
     */
    public function test_metric_type()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                // Assert chart line
                ->assertSourceHas('<svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line"')
                // Assert chart bars
                ->assertSourceHas('<svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar"')
                // Assert chart pie
                ->assertSourceHas('<svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-pie"');
        });
    }

    /**
     * Testing metric color and markers
     *
     * dusk --filter test_metric_color
     * @return void
     */
    public function test_metric_color()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                // Assert default: gray
                ->assertSourceHas('{stroke:gray; stroke-linecap:butt;}')
                // Assert teal
                ->assertSourceHas('{stroke:teal; stroke-linecap:butt;}')
                // Assert blue
                ->assertSourceHas('{stroke:blue; stroke-linecap:butt;}')
                // Assert red and custom marker
                ->assertSourceHas('{stroke:red; stroke-linecap:round;}');
        });
    }
}
