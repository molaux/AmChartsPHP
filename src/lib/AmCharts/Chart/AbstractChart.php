<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Manager;
use AmCharts\Chart\Setting;
use AmCharts\Chart\Exception;

abstract class AbstractChart
{
    /**
     * @var string
     */
    private $id;
    
    /**
     * @var string 
     */
    protected $type;

    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var integer|string
     */
    protected $width = '100%';
    
    /**
     * @var integer|string
     */
    protected $height = '400px';
    
    /**
     * @var Setting\Text 
     */
    protected $text;
    
    /**
     * @var array
     */
    protected $colors = array();

    /**
     * @var array
     */
    protected $labels = array();
    
    /**
     * @var Legend 
     */
    protected $legend;
    
    /**
     * @var Setting\Formatter\AbstractFormatter 
     */
    protected $numberFormatter;
    
    /**
     * @var Setting\Formatter\AbstractFormatter 
     */
    protected $percentFormatter;
    
    /**
     * @var DataProvider
     */
    protected $dataProvider;

    /**
     * Constructor can only be called from derived class because AmChart
     * is abstract.
     *
     * @param string $id
     */
    public function __construct($id = null)
    {
        if (null !== $id) {
            $this->id = (string) $id;
        } else {
            $this->id = 'chart_' . substr(md5(uniqid() . microtime()), 3, 5);
        }
        
        $this->init();
    }
    
    /**
     * Initialize chart 
     */
    public function init()
    {
        
    }
    
    /**
     * Returns chart id
     * 
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Returns chart type
     * 
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets chart title
     * 
     * @param string $title 
     * @return AbstractChart
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;

        return $this;
    }
    
    /**
     * Returns chart title
     * 
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets width
     * 
     * @param string $width 
     * @return AbstractChart
     */
    public function setWidth($width)
    {
        if (is_numeric($width)) {
            $width .= 'px';
        } elseif (!preg_match('/([\d].*)(px|\%)/', $width)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected integer or value suffixed by pixel or percent unit; Received %s.',
                $width
            ));
        }
        
        $this->width = (string) $width;

        return $this;
    }
    
    /**
     * Returns width
     * 
     * @return string 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets height
     * 
     * @param string $height 
     * @return AbstractChart
     */
    public function setHeight($height)
    {
        if (is_numeric($height)) {
            $height .= 'px';
        } elseif (!preg_match('/([\d].*)(px|\%)/', $height)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected integer or value suffixed by pixel or percent unit; Received %s.',
                $height
            ));
        }
        
        $this->height = (string) $height;

        return $this;
    }
    
    /**
     * Returns height
     * 
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }
        
    /**
     * Sets and returns text object
     *
     * @param array $params
     * @return Setting\Text
     */
    public function text($params = array())
    {
        if (!isset($this->text)) {
            $this->text = new Setting\Text();
        }
        
        $this->text->setParams($params);

        return $this->text;
    }
    
    /**
     * Sets colors
     * 
     * @param array $colors
     * @return AbstractChart
     */
    public function setColors(array $colors)
    {
        $this->colors = array();
        foreach ($colors as $color) {
            $this->addColor($color);
        }
        
        return $this;
    }
    
    /**
     * Add color
     * 
     * @param string|array|Setting\Color $color
     * @return AbstractChart 
     */
    public function addColor($color)
    {
        if ($color instanceof Setting\Color) {
            $this->colors[] = $color;
        } else {
            $this->colors[] = new Setting\Color($color);
        }
        
        return $this;
    }

    /**
     * Add label
     * 
     * @param string|Setting\Label $label
     * @param array $params
     * @return AbstractChart
     */
    public function addLabel($label, $params = array())
    {
        if ($label instanceof Setting\Label) {
            $this->labels[] = $label;
        } else {
            $this->labels[] = new Setting\Label($label, $params);
        }

        return $this;
    }
    
    /**
     * Sets and returns legend
     * 
     * @param array $params
     * @return Legend 
     */
    public function legend($params = array())
    {
        if (!isset($this->legend)) {
            $this->legend = new Legend();
        }
        
        $this->legend->setParams($params);

        return $this->legend;
    }
        
    /**
     * Sets and returns number formatter
     *
     * @param array $params
     * @return Setting\Formatter\Number
     */
    public function numberFormatter($params = array())
    {
        if (!isset($this->numberFormatter)) {
            $this->numberFormatter = new Setting\Formatter\Number();
        }
        
        $this->numberFormatter->setParams($params);

        return $this->numberFormatter;
    }
        
    /**
     * Sets and returns percent formatter
     *
     * @param array $params
     * @return Setting\Formatter\Percent
     */
    public function percentFormatter($params = array())
    {
        if (!isset($this->percentFormatter)) {
            $this->percentFormatter = new Setting\Formatter\Percent();
        }
        
        $this->percentFormatter->setParams($params);

        return $this->percentFormatter;
    }

    /**
     * Sets data provider
     * 
     * @param array|DataProvider $provider 
     * @return AbstractChart
     */
    public function setDataProvider($provider)
    {
        if (is_array($provider)) {
            $provider = new DataProvider($provider);
        }
        else if (!($provider instanceof DataProvider)) {
            throw new Exception\InvalidArgumentException(
                'Data provider must be an instance of '
                . 'AmCharts\Chart\DataProvider class.'
            );
        }
        
        $this->dataProvider = $provider;

        return $this;
    }
    
    /**
     * Returns data provider
     * 
     * @return array 
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }
    
    /**
     * Returns params
     * 
     * @return array 
     */
    protected function getParams()
    {
        $params = array();
        
        $dataProvider = $this->getDataProvider();
        if (null !== $dataProvider) {
            $params['dataProvider'] = json_encode($dataProvider->getData());
        }
        
        return $params;
    }
    
    /**
     * Returns attributes
     * 
     * @return array 
     */
    protected function getAttributes()
    {        
        $attribProperties = array(
            'legend', 'valueAxis', 'graphs', 'cursor', 'scrollbar'
        );
        
        $attributes = array();
        foreach ($attribProperties as $property) {
            if (isset($this->{$property})) {
                $attributes[$property] = $this->{$property};
            }
        }
        
        return $attributes;
    }

    /**
     * Returns the HTML code to insert on the page
     *
     * @return	string
     */
    public function render()
    {
        $renderer = new Renderer();
        
        return $renderer->render($this, $this->getParams(), $this->getAttributes());
    }
}