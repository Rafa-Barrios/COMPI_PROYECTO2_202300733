<?php

namespace Visitor;


/*
========================
BREAK SIGNAL
========================
*/
class BreakSignal extends \Exception
{
}


/*
========================
CONTINUE SIGNAL
========================
*/
class ContinueSignal extends \Exception
{
}


/*
========================
RETURN SIGNAL
========================
*/
class ReturnSignal extends \Exception {

    public $value;

    public function __construct($value) {
        parent::__construct();
        $this->value = $value;
    }

}