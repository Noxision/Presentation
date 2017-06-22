<?php
require('databaseConf/dbConf.php');
require('databaseConf/DatabaseConnection.php');
require('interfaces/WeatherInterface.php');
require('strategies/WeatherDatabase.php');
require('strategies/WeatherJSON.php');
require('strategies/WeatherAPI.php');

class WeatherModel {
    private $sourceModel = NULL;

    // source is not instantiated at construct time
    public function __construct($source) {
        switch ($source) {
            case 'DATABASE':
                $this->sourceModel = new WeatherDatabase();
            break;
            case 'JSON':
                $this->sourceModel = new WeatherJSON();
            break;
            case 'API':
                $this->sourceModel = new WeatherAPI();
            break;
        }
    }

    public function getWeather() {
        return $this->sourceModel->getWeather();
    }
}
