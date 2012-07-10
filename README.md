AmChartsPHP, a library to create AmCharts HTML5 charts.
========================================================

AmChartsPHP is a library of PHP classes to generate AmCharts HTML5 charts.

AmChartsPHP provide an API to create easily different charts in your application from your data.

[![Build Status](https://secure.travis-ci.org/neeckeloo/AmChartsPHP.png?branch=master)](http://travis-ci.org/neeckeloo/AmChartsPHP)

Requirements
------------

AmChartsPHP works with PHP 5.3 or later.

Usage
-----

### Setup AmCharts library

```php
<?php
$manager = \AmCharts\Manager::getInstance();
$manager->setAmChartsPath('./amcharts.js');
```

### Create basic pie chart

```php
<?php
$pie = new \AmCharts\Chart\Pie();
$pie->setDataProvider(array(
    array(
        'name' => 'Foo',
        'value' => 1
    ),
    array(
        'name' => 'Bar',
        'value' => 3
    ),
    array(
        'name' => 'Baz',
        'value' => 2
    )
));
$pie->fields()->setTitleField('name')
    ->setValueField('value');

echo $pie->render();
```

Running tests
-------------

The tests use PHPUnit