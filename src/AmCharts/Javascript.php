<?php

namespace AmCharts;

class Javascript {

  protected $data;
  
  public function __construct($args, $code) {
    $this->data = 'function('.join(',', $args).'){'.$code.'}';
  }
  public function __toString() {
    return $this->data;
  }
}
