<?php
/**
 * WeatherJSON
 */
class WeatherJSON implements WeatherInterface
{
    private $data;

    public function __construct() {
        $this->data = file_get_contents('data/today.json');
    }

    public function getWeather() {
        return $this->data;
    }
}
