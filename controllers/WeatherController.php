<?php

class WeatherController
{
    private $source;

    public function __construct($source) {
        $this->source = $source;
    }

    public function getWeather() {
        return (new WeatherModel($this->source))->getWeather();
    }
}
