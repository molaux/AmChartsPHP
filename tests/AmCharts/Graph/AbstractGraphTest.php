<?php

namespace AmCharts\Graph;

class AbstractGraphTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var AmCharts\Graph\AbstractGraph
     */
    protected $graph;
    
    public function setUp()
    {
        $class = 'AmCharts\Graph\AbstractGraph';
        $this->graph = $this->getMockForAbstractClass($class);
    }
    
    public function testSetTitle()
    {
        $this->graph->setTitle('Foo');
        $this->assertEquals('Foo', $this->graph->getTitle());
    }
    
    public function testSetType()
    {
        $this->graph->setType('Foo');
        $this->assertEquals('Foo', $this->graph->getType());
    }
    
    public function testGetFields()
    {
        $this->assertInstanceOf('AmCharts\Graph\Fields', $this->graph->fields());
    }
    
    public function testSetFillAlphas()
    {
        $this->graph->setFillAlphas(50);        
        $this->assertEquals(50, $this->graph->getFillAlphas());
    }
    
    public function testSetFillColors()
    {
        $this->graph->setFillColors(array('#ff0000', '#00ff00', '#0000ff'));
        
        $fillColors = $this->graph->getFillColors();
        $this->assertCount(3, $fillColors);
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $fillColors[0]);
        
        $this->graph->setFillColors('#ff0000');
        $fillColors = $this->graph->getFillColors();
        $this->assertCount(1, $fillColors);
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $fillColors[0]);
    }
    
    public function testToArray()
    {
        $options = $this->graph->toArray();
        $this->assertCount(2, $options);
    }
}