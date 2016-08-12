<?php

namespace Mbright\TreeExample\Test;

use Mbright\TreeExample\Answer;
use Mbright\TreeExample\Chart;
use Mbright\TreeExample\Decision;
use Mbright\TreeExample\Result;

class ChartTest extends \PHPUnit_Framework_TestCase
{
    protected $chart;

    public function setUp()
    {
        $this->chart = $this->getSimpleChart();
    }

    public function getSimpleChart()
    {
        $root = new Decision('Is the Lamp Working?');
        $root->addAnswer(new Answer('yes', new Result('What are you talking to me for?')));
        $root->addAnswer(new Answer('no', new Decision('Is The Lamp Plugged In?', [
            new Answer('no', new Result('Plug it in dummy!')),
            new Answer('yes', new Decision('is the bulb burned out', [
                new Answer('yes', new Result('Get a new bulb')),
                new Answer('no', new Result('Let me fix it for you'))
            ]))
        ])));

        return new Chart($root);
    }

    public function testSimpleFirstLevelYes()
    {
        $result = $this->chart->next('yes');
        $this->assertInstanceOf(Result::class, $result);
        $this->assertEquals('What are you talking to me for?', $result->getDisplayText());
        $this->assertEquals($result, $this->chart->current);
    }

    public function testSimpleFirstLevelNo()
    {
        $result = $this->chart->next('no');
        $this->assertInstanceOf(Decision::class, $result);
        $this->assertEquals('Is The Lamp Plugged In?', $result->getDisplayText());
        $this->assertEquals($result, $this->chart->current);
    }

    public function testSimpleSecondLevelNo()
    {
        $this->chart->next('no');
        $result = $this->chart->next('no');
        $this->assertInstanceOf(Result::class, $result);
        $this->assertEquals('Plug it in dummy!', $result->getDisplayText());
        $this->assertEquals($result, $this->chart->current);
    }
}
