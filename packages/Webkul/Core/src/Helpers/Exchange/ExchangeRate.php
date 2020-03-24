<?php

namespace Swim\Core\Helpers\Exchange;

abstract class ExchangeRate
{
    abstract public function fetchRates();

    abstract public function UpdateRates();
}