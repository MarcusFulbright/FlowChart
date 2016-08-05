<?php

namespace Mbright\TreeExample\Test;

use Mbright\TreeExample\Chart;
use Mbright\TreeExample\Decision;
use Mbright\TreeExample\Result;

class ChartTest extends \PHPUnit_Framework_TestCase
{
    public function getSimpleChart()
    {
        $root = new Decision('Is the Lamp Working?');
        $root->addChild('yes', new Result('What are you talking to me for?'));
        $root->addChild('no', new Decision('Is the Lamp Plugged In?', [
            'no' => new Result('Plug it in dummy!'),
            'yes' => new Decision('is the bulb burned out?', [
                'yes' => new Result('Get a new bulb'),
                'no' => new Result('Let me fix it for you')
            ])
        ]));
        return new Chart($root);
    }

    public function testSimpleFirstLevelYes()
    {
        $chart = $this->getSimpleChart();
        $result = $chart->next('yes');
        $this->assertInstanceOf(Result::class, $result);
        $this->assertEquals('What are you talking to me for?', $result->result);
        $this->assertEquals($result, $chart->current);
    }

    public function testSimpleFirstLevelNo()
    {
        $chart = $this->getSimpleChart();
        $decision = $chart->next('no');
        $this->assertInstanceof(Decision::class, $decision);
        $this->assertEquals('Is the Lamp Plugged In?', $decision->getPrompt());
        $this->assertEquals($decision, $chart->current);
    }

    public function testSimpleSecondLevelYes()
    {
        $chart = $this->getSimpleChart();
        $chart->next('no');
        $decision = $chart->next('yes');
        $this->assertInstanceOf(Decision::class, $decision);
        $this->assertEquals('is the bulb burned out?', $decision->getPrompt());
        $this->assertEquals($decision, $chart->current);
    }

    public function testSimpleSecondLevelNo()
    {
        $chart = $this->getSimpleChart();
        $chart->next('no');
        $result = $chart->next('no');
        $this->assertInstanceOf(Result::class, $result);
        $this->assertEquals('Plug it in dummy!', $result->result);
        $this->assertEquals($result, $chart->current);
    }
}
